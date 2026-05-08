# GitHub Secrets & Variables

Tambahkan di: **Settings → Secrets and variables → Actions**

## Secrets (wajib)

| Secret | Contoh nilai | Keterangan |
|--------|-------------|-----------|
| `SSH_PRIVATE_KEY` | `-----BEGIN OPENSSH PRIVATE KEY-----...` | Private key untuk SSH ke Proxmox |
| `SSH_HOST` | `192.168.1.100` atau IP publik | IP/hostname server Proxmox |
| `SSH_USER` | `deploy` | User SSH di server |
| `SSH_PORT` | `22` | Port SSH (default 22, opsional) |
| `DEPLOY_PATH` | `/var/www/invitation` | Path root aplikasi di server |

## Cara setup SSH key

```bash
# 1. Generate SSH key khusus deploy (di komputer lokal)
ssh-keygen -t ed25519 -C "github-deploy" -f ~/.ssh/github_deploy -N ""

# 2. Tambahkan public key ke server Proxmox
ssh-copy-id -i ~/.ssh/github_deploy.pub deploy@IP_SERVER
# atau manual:
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys  # di server

# 3. Salin isi private key ke GitHub Secret SSH_PRIVATE_KEY
cat ~/.ssh/github_deploy
```

## Struktur direktori di server

```
/var/www/invitation/
├── releases/
│   ├── 20240101_120000/   ← release terbaru
│   └── 20240101_110000/   ← release sebelumnya (untuk rollback)
├── shared/
│   ├── .env               ← file .env production (buat manual sekali)
│   ├── storage/           ← storage Laravel (upload, logs, dll)
│   └── bootstrap/cache/   ← cache Laravel
└── current -> releases/20240101_120000  ← symlink aktif
```

## Setup awal server (jalankan sekali)

```bash
# Di server Proxmox
sudo mkdir -p /var/www/invitation/{releases,shared}
sudo mkdir -p /var/www/invitation/shared/storage/{app/public,framework/{cache/data,sessions,views},logs}
sudo mkdir -p /var/www/invitation/shared/bootstrap/cache

# Buat .env production
sudo nano /var/www/invitation/shared/.env
# Isi dengan nilai production yang sebenarnya

# Set permission
sudo chown -R www-data:www-data /var/www/invitation
sudo chmod -R 775 /var/www/invitation/shared/storage
sudo chmod -R 775 /var/www/invitation/shared/bootstrap/cache

# Izinkan user deploy reload PHP-FPM tanpa password
echo "deploy ALL=(ALL) NOPASSWD: /bin/systemctl reload php8.1-fpm" | sudo tee /etc/sudoers.d/deploy-php
```

## Konfigurasi Nginx di server

```nginx
server {
    listen 80;
    server_name invitation.wahid-elektronik.online;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name invitation.wahid-elektronik.online;

    root /var/www/invitation/current/public;
    index index.php;

    ssl_certificate     /etc/letsencrypt/live/invitation.wahid-elektronik.online/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/invitation.wahid-elektronik.online/privkey.pem;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Alur CI/CD

```
Push ke main
    │
    ├─► CI (ci.yml)
    │     ├─ PHP Lint
    │     ├─ PHPUnit Tests
    │     └─ Code Style (Pint)
    │
    └─► CD (cd.yml)
          ├─ Pre-deploy checks
          ├─ Upload via rsync ke Proxmox
          ├─ composer install --no-dev
          ├─ php artisan migrate
          ├─ php artisan config:cache / route:cache / view:cache
          ├─ Atomic symlink swap (zero-downtime)
          ├─ php artisan up
          ├─ Reload PHP-FPM
          ├─ Cleanup release lama (simpan 3)
          └─ Health check HTTP
```

## Rollback manual

Buka GitHub → Actions → "Rollback" → Run workflow
- Kosongkan input = rollback ke release sebelumnya
- Isi nama release = rollback ke release spesifik
