# STP Dian Mandala - Website Kampus

Website resmi STP Dian Mandala Gunung Sitoli Nias Keuskupan Sibolga yang telah di-rebuild menggunakan **Laravel 11, Livewire 3, dan Tailwind CSS 3** untuk tampilan yang lebih modern, profesional, dan performa yang lebih cepat.

## 🎨 Fitur Utama

### Design Modern & Responsif
- ✅ Layout modern dengan Tailwind CSS 3
- ✅ Fully responsive untuk semua ukuran layar (mobile, tablet, desktop)
- ✅ Animasi smooth dan interaktif menggunakan Alpine.js
- ✅ Dark mode ready (dapat diaktifkan)
- ✅ Fast loading dengan optimized assets

### Komponen yang Telah Diperbarui
1. **Homepage**
   - Hero slider dengan transisi smooth
   - About section dengan card layout modern
   - Statistics counter section
   - Testimonial carousel
   - Latest news/posts grid
   - Contact section dengan Google Maps

2. **Navigation**
   - Fixed header dengan scroll effect
   - Mega menu dropdown
   - Mobile-friendly hamburger menu
   - Smooth scroll navigation

3. **Pages**
   - Berita/Artikel dengan card layout
   - Gallery dengan grid layout modern
   - Detail pages dengan typography yang baik
   - Pagination dengan Tailwind styling

## 🚀 Tech Stack

- **Laravel 11** - PHP Framework
- **Livewire 3** - Dynamic components
- **Tailwind CSS 3** - Utility-first CSS
- **Alpine.js** - JavaScript framework
- **Vite** - Modern build tool
- **Filament 3** - Admin panel

## 📦 Setup & Installation

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database di file .env
DB_DATABASE=stpdianmandala
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database (opsional)
php artisan db:seed
```

### 4. Build Assets

```bash
# Development mode (watch for changes)
npm run dev

# Production mode (optimized)
npm run build
```

### 5. Run Application

```bash
# Start development server
php artisan serve

# Application akan berjalan di: http://127.0.0.1:8000
```

## 🎨 Customization

### Colors & Theming

Edit file `tailwind.config.js` untuk mengubah warna tema:

```javascript
colors: {
    primary: {
        // Ubah warna primary sesuai kebutuhan
        600: '#0284c7',
        700: '#0369a1',
        // ...
    }
}
```

### Layout Components

Komponen layout berada di:
- `resources/views/layouts/modern.blade.php` - Layout utama
- `resources/views/components/navigation.blade.php` - Navigation bar
- `resources/views/components/footer.blade.php` - Footer

### Styling

Custom CSS berada di:
- `resources/css/app.css` - Main CSS file dengan Tailwind directives

## 📱 Pages & Routes

### Public Routes
- `/` - Homepage
- `/berita` - Halaman berita/artikel
- `/gallery` - Galeri foto
- `/read?slug={slug}` - Detail artikel
- `/gallery/{slug}` - Detail galeri
- `/page/{slug}` - Halaman statis
- `/kerjasama` - Halaman kerja sama

### Admin Routes
- `/admin/login` - Login admin (Filament)
- `/admin` - Dashboard admin

## 🔧 Configuration

### Cache Optimization

```bash
# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Performance Tips

1. **Optimize Images**
   - Gunakan format WebP untuk gambar
   - Compress images sebelum upload
   - Gunakan lazy loading

2. **Enable CDN** (optional)
   - Upload assets ke CDN
   - Update asset paths di config

3. **Database Optimization**
   - Enable query caching
   - Index important columns
   - Use eager loading untuk relations

## 🎯 Best Practices

### Development
- Selalu jalankan `npm run dev` saat development
- Test responsive di berbagai device
- Periksa console browser untuk errors

### Production
- Jalankan `npm run build` sebelum deploy
- Enable cache optimization
- Set `APP_ENV=production` di .env
- Set `APP_DEBUG=false` di .env

## 📄 File Structure

```
resources/
├── css/
│   └── app.css              # Main CSS dengan Tailwind
├── js/
│   └── app.js               # JavaScript dengan Alpine.js
└── views/
    ├── layouts/
    │   └── modern.blade.php # Layout utama
    ├── components/
    │   ├── navigation.blade.php
    │   ├── footer.blade.php
    │   └── about-section.blade.php
    ├── livewire/            # Livewire components
    │   ├── slider-home.blade.php
    │   ├── post-items.blade.php
    │   ├── post-list.blade.php
    │   ├── gallery-items.blade.php
    │   └── testimonial-items.blade.php
    └── home-new.blade.php   # Homepage baru
```

## 🐛 Troubleshooting

### Issue: Styles tidak muncul
**Solution:**
```bash
npm run build
php artisan view:clear
```

### Issue: Error "Vite manifest not found"
**Solution:**
```bash
npm run build
```

### Issue: Navigation dropdown tidak bekerja
**Solution:**
Pastikan Alpine.js ter-load dengan cek console browser

### Issue: Images tidak muncul
**Solution:**
```bash
php artisan storage:link
```

## 📞 Support

Untuk bantuan teknis atau pertanyaan, hubungi tim IT STP Dian Mandala.

## 🔄 Updates

### Version 2.0 (Current)
- ✅ Complete frontend rebuild dengan Tailwind CSS 3
- ✅ Modern dan responsive design
- ✅ Improved performance
- ✅ Better SEO optimization
- ✅ Enhanced user experience

---

**Developed with ❤️ for STP Dian Mandala Gunung Sitoli Nias**
