<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risa Digital Invitation - Undangan Digital Elegant</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-green: #2d7a4f;
            --primary-light: #e8f5ee;
            --accent-gold: #d4af37;
            --text-dark: #1d5a3f;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-green) 0%, #1d5a3f 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 20s infinite ease-in-out;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float 25s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 1;
            padding: 2rem;
            animation: fadeInUp 1.5s ease;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .tagline {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            opacity: 0.95;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: var(--primary-green);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,255,255,0.3);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary-green);
        }

        /* Features Section */
        .features {
            padding: 6rem 2rem;
            background: var(--primary-light);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 4rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.8rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Templates Showcase */
        .templates {
            padding: 6rem 2rem;
            background: white;
        }

        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .template-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .template-card:hover {
            transform: scale(1.05);
        }

        .template-image {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, var(--primary-green), #3d9a6f);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .template-info {
            padding: 1.5rem;
            background: white;
        }

        .template-info h4 {
            font-size: 1.5rem;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }

        /* Pricing */
        .pricing {
            padding: 6rem 2rem;
            background: var(--primary-light);
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .pricing-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.1);
            transition: transform 0.3s ease;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
        }

        .pricing-card.featured {
            border: 3px solid var(--accent-gold);
            transform: scale(1.05);
        }

        .pricing-card h3 {
            font-size: 2rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-green);
            margin: 1.5rem 0;
        }

        .price-features {
            list-style: none;
            margin: 2rem 0;
            text-align: left;
        }

        .price-features li {
            padding: 0.8rem 0;
            border-bottom: 1px solid #eee;
        }

        .price-features li:before {
            content: '✓ ';
            color: var(--primary-green);
            font-weight: bold;
            margin-right: 0.5rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 6rem 2rem;
            background: white;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .testimonial-card {
            background: var(--primary-light);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(45, 122, 79, 0.1);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--primary-green);
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--primary-green) 0%, #1d5a3f 100%);
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background: #1d5a3f;
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-gold);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }

            .tagline {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Auth Links */
        .auth-links {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 100;
        }

        .auth-links a {
            color: white;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: var(--accent-gold);
        }
    </style>
</head>
<body>
    <!-- Auth Links -->
    <div class="auth-links">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Daftar</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="logo">💚 Risa Digital Invitation</h1>
            <p class="tagline">Undangan Digital Elegant untuk Momen Spesial Anda</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">Mulai Sekarang</a>
                <a href="#templates" class="btn btn-outline">Lihat Template</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Kenapa Memilih Kami?</h2>
            <p class="section-subtitle">Fitur lengkap untuk undangan digital yang sempurna</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h3>Template Kekinian</h3>
                    <p>Pilihan template modern dan elegant yang dapat disesuaikan dengan tema acara Anda</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Responsive Design</h3>
                    <p>Tampil sempurna di semua perangkat, dari smartphone hingga desktop</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Loading Cepat</h3>
                    <p>Optimasi performa untuk pengalaman pengguna yang maksimal</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📸</div>
                    <h3>Gallery Unlimited</h3>
                    <p>Upload foto sebanyak yang Anda inginkan tanpa batasan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✉️</div>
                    <h3>RSVP System</h3>
                    <p>Kelola konfirmasi kehadiran tamu dengan mudah dan praktis</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎁</div>
                    <h3>Gift Registry</h3>
                    <p>Informasi hadiah dan rekening untuk kemudahan tamu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Templates -->
    <section id="templates" class="templates">
        <div class="container">
            <h2 class="section-title">Template Pilihan</h2>
            <p class="section-subtitle">Desain modern dan elegant untuk berbagai jenis acara</p>
            <div class="templates-grid">
                <div class="template-card">
                    <div class="template-image">Modern Elegant</div>
                    <div class="template-info">
                        <h4>Modern Elegant</h4>
                        <p>Design modern dengan animasi smooth dan warna hijau elegant</p>
                    </div>
                </div>
                <div class="template-card">
                    <div class="template-image">Romantic Garden</div>
                    <div class="template-info">
                        <h4>Romantic Garden</h4>
                        <p>Tema taman romantis dengan elemen floral yang indah</p>
                    </div>
                </div>
                <div class="template-card">
                    <div class="template-image">Luxury Botanical</div>
                    <div class="template-info">
                        <h4>Luxury Botanical</h4>
                        <p>Design mewah dengan countdown timer dan gallery masonry</p>
                    </div>
                </div>
                <div class="template-card">
                    <div class="template-image">Tropical Paradise</div>
                    <div class="template-info">
                        <h4>Tropical Paradise</h4>
                        <p>Tema pantai tropis untuk beach wedding yang sempurna</p>
                    </div>
                </div>
                <div class="template-card">
                    <div class="template-image">Minimalist Green</div>
                    <div class="template-info">
                        <h4>Minimalist Green</h4>
                        <p>Design minimalis dengan sage green untuk intimate wedding</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="pricing">
        <div class="container">
            <h2 class="section-title">Paket Harga</h2>
            <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan Anda</p>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Basic</h3>
                    <div class="price">Rp 150K</div>
                    <ul class="price-features">
                        <li>1 Template Pilihan</li>
                        <li>Gallery 20 Foto</li>
                        <li>RSVP System</li>
                        <li>Aktif 30 Hari</li>
                        <li>Support Email</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                </div>
                <div class="pricing-card featured">
                    <h3>Premium</h3>
                    <div class="price">Rp 250K</div>
                    <ul class="price-features">
                        <li>Semua Template</li>
                        <li>Gallery Unlimited</li>
                        <li>RSVP + Guest Management</li>
                        <li>Aktif 60 Hari</li>
                        <li>Custom Domain</li>
                        <li>Priority Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                </div>
                <div class="pricing-card">
                    <h3>Enterprise</h3>
                    <div class="price">Rp 500K</div>
                    <ul class="price-features">
                        <li>Semua Fitur Premium</li>
                        <li>Custom Design</li>
                        <li>Video Background</li>
                        <li>Aktif 90 Hari</li>
                        <li>Dedicated Support</li>
                        <li>Free Revisi</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Testimoni</h2>
            <p class="section-subtitle">Apa kata mereka yang sudah menggunakan layanan kami</p>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Undangan digitalnya sangat elegant dan mudah digunakan. Tamu-tamu kami sangat terkesan!"</p>
                    <p class="testimonial-author">- Sarah & Ahmad</p>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Template yang disediakan sangat modern dan sesuai dengan tema pernikahan kami. Highly recommended!"</p>
                    <p class="testimonial-author">- Dina & Rizky</p>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Pelayanan yang cepat dan responsif. Undangan jadi dalam waktu singkat dengan hasil yang memuaskan."</p>
                    <p class="testimonial-author">- Maya & Budi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>Siap Membuat Undangan Digital Anda?</h2>
            <p>Mulai sekarang dan buat undangan yang berkesan untuk momen spesial Anda</p>
            <a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#">Tentang Kami</a>
                <a href="#">Template</a>
                <a href="#">Harga</a>
                <a href="#">Kontak</a>
                <a href="#">FAQ</a>
            </div>
            <p>&copy; 2024 Risa Digital Invitation. All Rights Reserved.</p>
            <p style="margin-top: 1rem; opacity: 0.8;">Made with 💚 in Indonesia</p>
        </div>
    </footer>
</body>
</html>
