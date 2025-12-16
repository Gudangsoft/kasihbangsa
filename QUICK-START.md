# 🚀 Quick Start Guide - STP Dian Mandala Website

## Langkah Cepat untuk Memulai

### 1️⃣ Start Development Server

```bash
# Jalankan server Laravel
php artisan serve
```

Website akan berjalan di: **http://127.0.0.1:8000**

### 2️⃣ Jika Perlu Edit Styling (Opsional)

```bash
# Di terminal baru, jalankan Vite dev server untuk live reload
npm run dev
```

### 3️⃣ Clear Cache (Jika Ada Masalah)

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📍 Halaman yang Sudah Diperbarui

### Public Pages (Frontend Baru)
- ✅ **Homepage:** http://127.0.0.1:8000/
- ✅ **Berita:** http://127.0.0.1:8000/berita
- ✅ **Gallery:** http://127.0.0.1:8000/gallery
- ✅ **Detail Berita:** http://127.0.0.1:8000/read?slug=[slug]
- ✅ **Kerja Sama:** http://127.0.0.1:8000/kerjasama

### Admin Panel (Tidak Berubah)
- 🔐 **Login Admin:** http://127.0.0.1:8000/admin/login
- 🔐 **Dashboard:** http://127.0.0.1:8000/admin

## 🎨 Fitur Utama Website Baru

### ✨ Design Features
- Modern & Professional design dengan Tailwind CSS 3
- Fully responsive (Mobile, Tablet, Desktop)
- Smooth animations & transitions
- Fast loading & optimized

### 📱 Komponen Interaktif
- Hero slider dengan auto-play
- Dropdown navigation menu
- Mobile hamburger menu
- Back to top button
- Social media share buttons
- Smooth scroll navigation

### 🎯 Page Features

#### Homepage
- Hero slider dengan CTA buttons
- About section dengan quick links
- Statistics counter section
- Testimonial cards
- Latest news grid (3 items)
- Contact section dengan Google Maps

#### Berita Page
- Card-based news layout
- Category badges
- Author info dengan avatar
- Pagination
- Hover effects

#### Gallery Page
- Grid layout dengan overlay
- Category tags
- Smooth hover animations
- Lightbox ready

#### Detail Berita
- Hero header dengan breadcrumb
- Professional article layout
- Social share buttons (Facebook, Twitter, WhatsApp)
- Tags display
- Related articles (jika ada)

## 🔧 Customization Cepat

### Ubah Warna Tema
Edit file: `tailwind.config.js`
```javascript
primary: {
    600: '#0284c7',  // Ganti dengan warna Anda
    700: '#0369a1',  // Warna lebih gelap untuk hover
}
```

Kemudian rebuild:
```bash
npm run build
```

### Ubah Logo
1. Ganti logo di admin panel (Filament)
2. Logo akan otomatis update di seluruh website

### Edit Content
1. Login ke admin panel: http://127.0.0.1:8000/admin/login
2. Kelola content seperti biasa (Banner, Berita, Gallery, dll)
3. Refresh frontend untuk melihat perubahan

## 📦 File Penting

### Layout & Components
```
resources/views/
├── layouts/modern.blade.php       → Layout utama
├── components/
│   ├── navigation.blade.php       → Header & menu
│   ├── footer.blade.php           → Footer
│   └── about-section.blade.php    → About section
└── home-new.blade.php             → Homepage
```

### Livewire Components
```
resources/views/livewire/
├── slider-home.blade.php          → Hero slider
├── post-list.blade.php            → News cards
├── post-items.blade.php           → News page
├── gallery-items.blade.php        → Gallery page
├── testimonial-items.blade.php    → Testimonials
└── detail-post.blade.php          → Article detail
```

### Styling
```
resources/
├── css/app.css                    → Main CSS
├── js/app.js                      → JavaScript
└── tailwind.config.js             → Tailwind config
```

## ⚠️ Troubleshooting Cepat

### Masalah: Style tidak muncul
```bash
npm run build
php artisan view:clear
# Refresh browser dengan Ctrl+Shift+R (hard reload)
```

### Masalah: Menu dropdown tidak berfungsi
```bash
# Cek apakah Alpine.js ter-load di browser console
# Rebuild assets:
npm run build
```

### Masalah: Gambar tidak muncul
```bash
php artisan storage:link
# Pastikan folder storage/app/public exists
```

### Masalah: Error 500
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
# Cek file .env database configuration
```

## 🎓 Tips & Tricks

### 1. Live Reload saat Development
Jalankan `npm run dev` untuk auto-refresh saat edit CSS/JS

### 2. Production Build
Sebelum deploy:
```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Optimize Images
- Compress images sebelum upload
- Gunakan format WebP jika memungkinkan
- Maksimal ukuran: 1MB per image

### 4. SEO Optimization
- Isi meta description di setiap halaman
- Gunakan heading tags (H1, H2, H3) dengan benar
- Add alt text pada semua images

## 📞 Need Help?

### Documentation
- 📖 Full README: `FRONTEND-README.md`
- 📊 Rebuild Summary: `REBUILD-SUMMARY.md`

### Resources
- **Tailwind CSS:** https://tailwindcss.com/docs
- **Alpine.js:** https://alpinejs.dev/
- **Livewire:** https://livewire.laravel.com/docs
- **Laravel:** https://laravel.com/docs

## ✅ Checklist Sebelum Deploy

- [ ] Test di berbagai device (mobile, tablet, desktop)
- [ ] Test di berbagai browser (Chrome, Firefox, Safari, Edge)
- [ ] Periksa semua links berfungsi
- [ ] Periksa semua images ter-load
- [ ] Periksa contact form/maps
- [ ] Setup Google Analytics (opsional)
- [ ] Backup database
- [ ] Set APP_ENV=production di .env
- [ ] Set APP_DEBUG=false di .env
- [ ] Run production build: `npm run build`
- [ ] Cache optimization: `php artisan optimize`

---

## 🎉 Selamat!

Website STP Dian Mandala sudah berhasil di-rebuild dengan teknologi modern!

**Fitur Baru:**
✅ Design modern & profesional
✅ Fast loading & optimized
✅ Fully responsive
✅ Easy to maintain

**Ready to go live! 🚀**

---

**Last Updated:** December 10, 2025  
**Version:** 2.0 (Tailwind CSS 3 Edition)
