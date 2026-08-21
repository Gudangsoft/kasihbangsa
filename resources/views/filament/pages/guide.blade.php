<x-filament-panels::page>
    <style>
        .guide-section {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        .guide-section h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .guide-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            color: #374151;
        }
        .guide-section ul, .guide-section ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .guide-section li {
            margin-bottom: 0.5rem;
            line-height: 1.625;
        }
        .guide-section p {
            margin-bottom: 1rem;
            line-height: 1.625;
            color: #4b5563;
        }
        .guide-icon {
            width: 1.5rem;
            height: 1.5rem;
            color: #059669;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }
        .badge-blue {
            background: #dbeafe;
            color: #1e40af;
        }
        .badge-green {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-yellow {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-red {
            background: #fee2e2;
            color: #991b1b;
        }
        .badge-purple {
            background: #ede9fe;
            color: #5b21b6;
        }
        .feature-box {
            background: #f9fafb;
            border-left: 4px solid #059669;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.375rem;
        }
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.375rem;
        }
        .info-box {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.375rem;
        }
        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.75rem;
            height: 1.75rem;
            background: #059669;
            color: white;
            border-radius: 50%;
            font-weight: 700;
            font-size: 0.875rem;
            margin-right: 0.5rem;
        }
    </style>

    <div class="space-y-6">
        <!-- Introduction -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Selamat Datang di Dashboard {{ company()->name }}
            </h3>
            <p>Dashboard ini dirancang untuk memudahkan Anda dalam mengelola konten website. Panduan ini akan membantu Anda memahami setiap fitur dan fungsi yang tersedia.</p>
            <div class="info-box">
                <strong>💡 Tips:</strong> Anda dapat mengklik menu di sidebar kiri untuk mengakses setiap fitur. Setiap menu memiliki ikon khusus untuk memudahkan identifikasi.
            </div>
        </div>

        <!-- Dashboard -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard (Beranda)
            </h3>
            <p><span class="badge badge-blue">Menu Utama</span></p>
            <p>Halaman utama yang menampilkan ringkasan statistik dan informasi penting:</p>
            <ul>
                <li><strong>Total Berita:</strong> Jumlah artikel berita yang telah dibuat</li>
                <li><strong>Total Informasi:</strong> Jumlah informasi/pengumuman</li>
                <li><strong>Total Galeri:</strong> Jumlah album foto yang tersedia</li>
                <li><strong>Total User:</strong> Jumlah pengguna yang terdaftar</li>
            </ul>
            <div class="feature-box">
                <strong>🎯 Fungsi Utama:</strong> Memberikan gambaran cepat tentang aktivitas dan konten website.
            </div>
        </div>

        <!-- Berita -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Berita
            </h3>
            <p><span class="badge badge-green">Konten Website</span></p>
            <p>Mengelola artikel berita dan informasi yang akan ditampilkan di website.</p>

            <h4><span class="step-number">1</span>Cara Membuat Berita Baru:</h4>
            <ol>
                <li>Klik menu <strong>"Berita"</strong> di sidebar</li>
                <li>Klik tombol <strong>"Buat Baru"</strong> di pojok kanan atas</li>
                <li>Isi form dengan informasi berikut:
                    <ul>
                        <li><strong>Judul (Title):</strong> Judul berita yang menarik dan informatif</li>
                        <li><strong>Preview:</strong> Ringkasan singkat berita (maks 255 karakter)</li>
                        <li><strong>Content:</strong> Isi lengkap berita menggunakan editor TinyMCE</li>
                        <li><strong>Image:</strong> Upload gambar thumbnail (maks 5MB)</li>
                        <li><strong>Publish At:</strong> Tanggal dan waktu publikasi</li>
                        <li><strong>Category:</strong> Pilih kategori berita</li>
                        <li><strong>Tags:</strong> Kata kunci untuk SEO (pisahkan dengan koma)</li>
                        <li><strong>Status:</strong> Aktifkan untuk mempublikasikan</li>
                    </ul>
                </li>
                <li>Klik <strong>"Simpan"</strong></li>
            </ol>

            <h4>✏️ Fitur Editor TinyMCE:</h4>
            <ul>
                <li>Format teks (bold, italic, underline, heading)</li>
                <li>Upload dan sisipkan gambar dalam konten</li>
                <li>Buat tabel, list, dan link</li>
                <li>Atur alignment dan spacing</li>
            </ul>

            <div class="warning-box">
                <strong>⚠️ Penting:</strong> Pastikan gambar berjajar atau format khusus dalam editor akan tampil sesuai di frontend berkat CSS custom yang telah diterapkan.
            </div>

            <h4>🔍 Fitur Lainnya:</h4>
            <ul>
                <li><strong>Filter:</strong> Cari berita berdasarkan tanggal dan status</li>
                <li><strong>Edit:</strong> Ubah berita yang sudah ada</li>
                <li><strong>Delete:</strong> Hapus berita (soft delete)</li>
                <li><strong>Detail:</strong> Lihat detail lengkap berita</li>
            </ul>
        </div>

        <!-- Informasi -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi
            </h3>
            <p><span class="badge badge-green">Konten Website</span></p>
            <p>Mengelola informasi penting, pengumuman, atau update singkat untuk ditampilkan di website.</p>

            <h4>Cara Membuat Informasi:</h4>
            <p>Langkah-langkahnya sama dengan membuat berita, namun informasi biasanya lebih singkat dan fokus pada pengumuman atau update penting.</p>

            <div class="feature-box">
                <strong>💡 Kapan Menggunakan Informasi?</strong>
                <ul>
                    <li>Pengumuman pendaftaran mahasiswa baru</li>
                    <li>Jadwal libur kampus</li>
                    <li>Update peraturan atau kebijakan</li>
                    <li>Informasi singkat yang perlu segera disampaikan</li>
                </ul>
            </div>
        </div>

        <!-- Banners -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Banners (Slider)
            </h3>
            <p><span class="badge badge-purple">Tampilan Website</span></p>
            <p>Mengelola banner/slider yang tampil di halaman utama website.</p>

            <h4>Cara Membuat Banner:</h4>
            <ol>
                <li>Upload gambar banner (resolusi tinggi untuk tampilan optimal)</li>
                <li>Isi judul dan deskripsi banner</li>
                <li>Atur urutan tampilan (number)</li>
                <li>Aktifkan status untuk menampilkan</li>
            </ol>

            <div class="info-box">
                <strong>📐 Rekomendasi Ukuran:</strong> 1920x800 pixels untuk tampilan full-width yang optimal.
            </div>
        </div>

        <!-- Gallery Foto -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Gallery Foto
            </h3>
            <p><span class="badge badge-yellow">Media & Dokumentasi</span></p>
            <p>Mengelola album foto kegiatan dan dokumentasi kampus.</p>

            <h4>Cara Membuat Album Galeri:</h4>
            <ol>
                <li>Buat album baru dengan judul dan deskripsi</li>
                <li>Upload foto thumbnail album</li>
                <li>Upload multiple foto ke dalam album (bisa banyak sekaligus)</li>
                <li>Atur tanggal kegiatan</li>
                <li>Aktifkan status untuk publish</li>
            </ol>

            <div class="feature-box">
                <strong>📸 Tips Upload Foto:</strong>
                <ul>
                    <li>Gunakan foto berkualitas tinggi</li>
                    <li>Beri nama file yang deskriptif</li>
                    <li>Kelompokkan foto berdasarkan kegiatan</li>
                    <li>Kompres foto besar sebelum upload</li>
                </ul>
            </div>
        </div>

        <!-- Data Kerja Sama -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Data Kerja Sama
            </h3>
            <p><span class="badge badge-blue">Kemitraan</span></p>
            <p>Mengelola data mitra dan instansi yang bekerja sama dengan kampus.</p>

            <h4>Informasi yang Dapat Dikelola:</h4>
            <ul>
                <li>Nama instansi/perusahaan partner</li>
                <li>Logo partner</li>
                <li>Deskripsi kerja sama</li>
                <li>Link website partner</li>
                <li>Status kerja sama (aktif/non-aktif)</li>
            </ul>
        </div>

        <!-- Testimonial -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                Testimonial
            </h3>
            <p><span class="badge badge-green">Testimoni</span></p>
            <p>Mengelola testimoni dari mahasiswa, alumni, atau mitra tentang kampus.</p>

            <h4>Data Testimonial:</h4>
            <ul>
                <li>Nama pemberi testimoni</li>
                <li>Foto/avatar</li>
                <li>Posisi/status (mahasiswa, alumni, dosen, dll)</li>
                <li>Isi testimoni</li>
                <li>Rating (jika ada)</li>
            </ul>

            <div class="feature-box">
                <strong>⭐ Testimoni yang Baik:</strong> Pilih testimoni yang autentik, positif, dan mewakili berbagai aspek kampus.
            </div>
        </div>

        <!-- Pages -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Halaman (Pages)
            </h3>
            <p><span class="badge badge-purple">Konten Statis</span></p>
            <p>Membuat halaman konten statis yang terhubung dengan menu navigasi.</p>

            <h4><span class="step-number">1</span>Panduan Lengkap:</h4>
            <p>Saat membuat halaman baru, Anda akan melihat panduan lengkap di bagian atas form (dapat di-collapse).</p>

            <h4><span class="step-number">2</span>Langkah Membuat Halaman:</h4>
            <ol>
                <li><strong>Judul Halaman:</strong> Tentukan judul yang sesuai (contoh: "Visi Misi", "Sejarah")</li>
                <li><strong>Pilih Menu:</strong> Hubungkan halaman dengan menu navigasi (atau buat menu baru)</li>
                <li><strong>Konten:</strong> Buat konten menggunakan TinyMCE editor</li>
                <li><strong>Upload File:</strong> Lampirkan dokumen pendukung jika perlu (PDF, DOC, PPT)</li>
                <li><strong>Publikasi:</strong> Aktifkan status untuk menampilkan di website</li>
            </ol>

            <div class="info-box">
                <strong>🔗 Hubungan Menu & Halaman:</strong> Ketika user klik menu di website, sistem akan menampilkan halaman yang terhubung dengan menu tersebut.
            </div>
        </div>

        <!-- Pengaturan Website -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan Website
            </h3>
            <p><span class="badge badge-red">Konfigurasi</span></p>
            <p>Mengelola pengaturan umum website dan informasi perusahaan.</p>

            <h4>Pengaturan yang Tersedia:</h4>
            <ul>
                <li><strong>Pengaturan Beranda:</strong> Konfigurasi halaman utama</li>
                <li><strong>Pengaturan Company:</strong> Informasi umum (nama, alamat, kontak, social media)</li>
                <li><strong>Logo & Favicon:</strong> Upload logo dan icon website</li>
                <li><strong>SEO Settings:</strong> Meta description, keywords</li>
            </ul>

            <div class="warning-box">
                <strong>⚠️ Perhatian:</strong> Perubahan di pengaturan ini akan mempengaruhi seluruh website. Lakukan dengan hati-hati.
            </div>
        </div>

        <!-- Management -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
                Management
            </h3>
            <p><span class="badge badge-yellow">Pengelolaan</span></p>

            <h4>Menu Management:</h4>
            <p>Mengelola menu navigasi website (menu utama dan submenu).</p>
            <ul>
                <li>Buat menu baru</li>
                <li>Atur hierarki menu (parent-child)</li>
                <li>Atur urutan tampilan</li>
                <li>Link menu ke halaman atau URL eksternal</li>
            </ul>

            <h4>Users Management:</h4>
            <p>Mengelola pengguna yang memiliki akses ke dashboard.</p>
            <ul>
                <li>Tambah user baru</li>
                <li>Atur role dan permission</li>
                <li>Edit profil user</li>
                <li>Nonaktifkan user</li>
            </ul>
        </div>

        <!-- Filament Shield -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Filament Shield (Roles & Permissions)
            </h3>
            <p><span class="badge badge-red">Keamanan</span></p>
            <p>Mengelola hak akses dan permission untuk setiap role user.</p>

            <h4>Roles (Peran):</h4>
            <ul>
                <li><strong>Super Admin:</strong> Akses penuh ke semua fitur</li>
                <li><strong>Admin:</strong> Akses ke konten dan pengelolaan user</li>
                <li><strong>Editor:</strong> Hanya akses konten (berita, informasi, galeri)</li>
                <li><strong>Custom Role:</strong> Buat role khusus dengan permission tertentu</li>
            </ul>

            <h4>Permissions (Hak Akses):</h4>
            <p>Atur permission untuk setiap role (view, create, update, delete) pada setiap resource.</p>

            <div class="warning-box">
                <strong>🔒 Keamanan:</strong> Hanya Super Admin yang dapat mengakses pengaturan roles dan permissions.
            </div>
        </div>

        <!-- Tips & Best Practices -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                Tips & Best Practices
            </h3>

            <div class="feature-box">
                <h4>✅ Do's (Lakukan):</h4>
                <ul>
                    <li>Backup konten penting secara berkala</li>
                    <li>Gunakan gambar berkualitas tinggi dan teroptimasi</li>
                    <li>Buat judul yang SEO-friendly</li>
                    <li>Preview konten sebelum publish</li>
                    <li>Gunakan tags untuk memudahkan pencarian</li>
                    <li>Update konten secara rutin</li>
                    <li>Cek tampilan di berbagai device</li>
                </ul>
            </div>

            <div class="warning-box">
                <h4>❌ Don'ts (Hindari):</h4>
                <ul>
                    <li>Upload gambar terlalu besar (>5MB)</li>
                    <li>Copy-paste konten dari sumber lain tanpa edit</li>
                    <li>Menggunakan judul yang terlalu panjang</li>
                    <li>Menghapus konten tanpa backup</li>
                    <li>Share password akses ke orang lain</li>
                    <li>Mengubah pengaturan penting tanpa konfirmasi</li>
                </ul>
            </div>

            <div class="info-box">
                <h4>🎯 SEO Tips:</h4>
                <ul>
                    <li>Gunakan heading structure yang benar (H1, H2, H3)</li>
                    <li>Tambahkan alt text pada gambar</li>
                    <li>Optimalkan meta description dan tags</li>
                    <li>Buat URL yang deskriptif (slug)</li>
                    <li>Link internal antar halaman</li>
                    <li>Update konten lama secara berkala</li>
                </ul>
            </div>
        </div>

        <!-- Troubleshooting -->
        <div class="guide-section">
            <h3>
                <svg class="guide-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Troubleshooting (Pemecahan Masalah)
            </h3>

            <h4>Masalah Umum dan Solusinya:</h4>

            <div class="feature-box">
                <p><strong>Q: Gambar tidak muncul di frontend?</strong></p>
                <p><strong>A:</strong> Pastikan file gambar sudah terupload dengan benar dan path storage sudah linked. Cek juga permission folder storage.</p>
            </div>

            <div class="feature-box">
                <p><strong>Q: Konten dari TinyMCE tidak tampil sesuai?</strong></p>
                <p><strong>A:</strong> CSS custom sudah diterapkan untuk menangani styling TinyMCE. Pastikan gambar berjajar menggunakan style inline di editor.</p>
            </div>

            <div class="feature-box">
                <p><strong>Q: Menu tidak muncul di website?</strong></p>
                <p><strong>A:</strong> Pastikan status menu aktif dan sudah terhubung dengan halaman. Clear cache jika perlu.</p>
            </div>

            <div class="feature-box">
                <p><strong>Q: Tidak bisa login ke dashboard?</strong></p>
                <p><strong>A:</strong> Pastikan akun Anda aktif dan memiliki permission yang sesuai. Hubungi Super Admin jika masalah berlanjut.</p>
            </div>

            <div class="feature-box">
                <p><strong>Q: Error 500 saat upload file?</strong></p>
                <p><strong>A:</strong> Periksa ukuran file (max 10MB untuk dokumen, 5MB untuk gambar). Pastikan format file sesuai.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="guide-section">
            <p class="text-center text-sm text-gray-500">
                <strong>Versi Panduan:</strong> 1.0 | <strong>Terakhir Diperbarui:</strong> {{ now()->format('d F Y') }}
            </p>
            <p class="text-center text-sm text-gray-500 mt-2">
                © {{ now()->year }} {{ company()->name }}. All rights reserved.
            </p>
        </div>
    </div>
</x-filament-panels::page>
