# Setup Cloudflare R2 Storage

## 1. Buat Bucket R2

1. Login ke [Cloudflare Dashboard](https://dash.cloudflare.com)
2. Klik **R2 Object Storage** di sidebar kiri
3. Klik **Create bucket**
4. Beri nama bucket (contoh: `risa-digital-invitation`)
5. Pilih region terdekat (Asia Pacific)

## 2. Aktifkan Public Access

1. Buka bucket yang baru dibuat
2. Klik tab **Settings**
3. Di bagian **Public access**, klik **Allow Access**
4. Catat **Public bucket URL** (format: `https://pub-xxxx.r2.dev`)
   - Atau gunakan **Custom Domain** jika punya domain sendiri

## 3. Buat API Token

1. Di halaman R2, klik **Manage R2 API Tokens**
2. Klik **Create API token**
3. Beri nama token (contoh: `risa-app`)
4. Permissions: **Object Read & Write**
5. Specify bucket: pilih bucket yang dibuat tadi
6. Klik **Create API Token**
7. **Simpan credentials** (hanya tampil sekali):
   - Access Key ID
   - Secret Access Key

## 4. Dapatkan Account ID

1. Di Cloudflare Dashboard, klik nama akun di kanan atas
2. Atau buka URL: `https://dash.cloudflare.com` → lihat URL mengandung Account ID
3. Format endpoint: `https://<ACCOUNT_ID>.r2.cloudflarestorage.com`

## 5. Isi `.env`

```env
R2_ACCESS_KEY_ID=your_access_key_id
R2_SECRET_ACCESS_KEY=your_secret_access_key
R2_BUCKET=risa-digital-invitation
R2_ENDPOINT=https://abc123def456.r2.cloudflarestorage.com
R2_URL=https://pub-xxxx.r2.dev

FILESYSTEM_DISK=r2
```

## 6. Isi Vercel Environment Variables

Di Vercel Dashboard → Project → Settings → Environment Variables, tambahkan:

| Key | Value |
|-----|-------|
| `R2_ACCESS_KEY_ID` | dari step 3 |
| `R2_SECRET_ACCESS_KEY` | dari step 3 |
| `R2_BUCKET` | nama bucket |
| `R2_ENDPOINT` | `https://<account-id>.r2.cloudflarestorage.com` |
| `R2_URL` | `https://pub-xxxx.r2.dev` |
| `FILESYSTEM_DISK` | `r2` |

## 7. Test Upload

Setelah deploy, coba upload foto di menu Profil Pasangan atau Sampul Undangan.
File akan tersimpan di R2 dan URL-nya menggunakan `R2_URL`.

## Cara Kerja

Saat `FILESYSTEM_DISK=r2`:
- `Storage::disk('public')->put(...)` → otomatis simpan ke R2
- `url('storage/...')` di template → perlu diganti dengan `Storage::url(...)`
- Semua upload foto (profil, sampul, galeri, musik) → masuk ke R2 bucket

## Struktur Folder di R2

```
bucket/
├── xs/          ← thumbnail kecil (60px)
├── sm/          ← thumbnail sedang (280px)
├── md/          ← thumbnail besar (650px)
├── avatar/      ← foto avatar
├── frame/       ← bingkai foto
├── decoration/  ← dekorasi quote
├── audio/       ← file musik
└── *.jpg/png    ← file asli
```
