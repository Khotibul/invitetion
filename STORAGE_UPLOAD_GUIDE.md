# Panduan Upload Storage ke Hosting

## Mengapa gambar hilang di hosting?

File gambar yang diupload user tersimpan di `storage/app/public/` yang ada di `.gitignore`.
Artinya file ini **tidak masuk ke git** dan tidak otomatis ter-deploy ke hosting.

## Solusi: Upload Manual via FTP

### File yang perlu diupload ke server:

```
LOKAL                              → SERVER HOSTING
storage/app/public/avatar/         → storage/app/public/avatar/
storage/app/public/sm/             → storage/app/public/sm/
storage/app/public/xs/             → storage/app/public/xs/
storage/app/public/md/             → storage/app/public/md/
storage/app/public/frame/          → storage/app/public/frame/
storage/app/public/decoration/     → storage/app/public/decoration/
storage/app/public/audio/          → storage/app/public/audio/
```

### Cara upload via FileZilla / cPanel File Manager:

1. Buka FTP client (FileZilla) atau cPanel File Manager
2. Navigasi ke folder `storage/app/public/` di server
3. Upload semua subfolder dari lokal ke server
4. Pastikan permission folder = 775

### Setelah upload, jalankan di server:

```bash
# Via SSH atau cPanel Terminal
php artisan storage:link --force
php artisan config:clear
php artisan cache:clear
```

### Atau akses via browser:

```
https://undanganwedding.risa-achla-invitation.xyz/fix-storage.php
```

## Untuk upload gambar baru di masa depan

Setiap kali ada gambar baru yang diupload user di lokal, perlu di-sync ke server via FTP.

### Cara sync otomatis (opsional):

Gunakan rsync via SSH:
```bash
rsync -avz storage/app/public/ user@server:~/public_html/storage/app/public/
```

## Struktur folder yang harus ada di server

```
public_html/
├── public/
│   └── storage → ../storage/app/public  (symlink)
└── storage/
    └── app/
        └── public/
            ├── avatar/    ← foto avatar default
            ├── sm/        ← foto resize kecil (280px)
            ├── xs/        ← foto resize sangat kecil (60px)
            ├── md/        ← foto resize sedang (650px)
            ├── frame/     ← frame foto
            ├── decoration/ ← dekorasi
            └── audio/     ← musik
```
