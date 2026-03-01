<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
    <meta name="description" content="Undangan Pernikahan Digital">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            --text-light: #6b7280;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f0f9f4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(45, 122, 79, 0.1) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, 20px) rotate(5deg); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .hero h1 {
            font-size: 3.5rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero .subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            animation: fadeInUp 1.2s ease;
        }

        .couple-names {
            font-size: 2.5rem;
            color: var(--text-dark);
            margin: 2rem 0;
            animation: fadeInUp 1.4s ease;
        }

        .couple-names .ampersand {
            color: var(--accent-gold);
            font-style: italic;
            margin: 0 1rem;
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

        /* Date Section */
        .date-section {
            background: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .date-box {
            display: inline-block;
            padding: 2rem 3rem;
            background: linear-gradient(135deg, var(--primary-green) 0%, #3d9a6f 100%);
            color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.3);
        }

        .date-box h2 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .date-box p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Event Details */
        .event-details {
            padding: 4rem 2rem;
            background: var(--primary-light);
        }

        .event-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .event-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(45, 122, 79, 0.1);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        .event-card h3 {
            color: var(--primary-green);
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .event-card .time {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .event-card .location {
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Gallery Section */
        .gallery {
            padding: 4rem 2rem;
            background: white;
        }

        .gallery h2 {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 3rem;
        }

        .gallery-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            aspect-ratio: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* RSVP Section */
        .rsvp-section {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f0f9f4 100%);
            text-align: center;
        }

        .rsvp-section h2 {
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 2rem;
        }

        .rsvp-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(45, 122, 79, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--primary-light);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-green);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-green) 0%, #3d9a6f 100%);
            color: white;
            padding: 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(45, 122, 79, 0.3);
        }

        /* Footer */
        footer {
            background: var(--primary-green);
            color: white;
            text-align: center;
            padding: 2rem;
        }

        footer a {
            color: var(--accent-gold);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .couple-names {
                font-size: 1.8rem;
            }

            .date-box h2 {
                font-size: 2rem;
            }

            .event-container {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Decorative Elements */
        .divider {
            width: 100px;
            height: 3px;
            background: var(--accent-gold);
            margin: 2rem auto;
        }

        .ornament {
            color: var(--accent-gold);
            font-size: 2rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="ornament">❦</div>
            <h1>The Wedding of</h1>
            <div class="couple-names">
                <span>Bride</span>
                <span class="ampersand">&</span>
                <span>Groom</span>
            </div>
            <div class="divider"></div>
            <p class="subtitle">Kami mengundang Anda untuk berbagi kebahagiaan di hari istimewa kami</p>
        </div>
    </section>

    <!-- Date Section -->
    <section class="date-section fade-in">
        <div class="date-box">
            <h2>Save The Date</h2>
            <p>Sabtu, 15 Juni 2024</p>
        </div>
    </section>

    <!-- Event Details -->
    <section class="event-details">
        <div class="event-container">
            <div class="event-card">
                <h3>Akad Nikah</h3>
                <div class="time">08:00 - 10:00 WIB</div>
                <div class="location">
                    <p>Masjid Al-Ikhlas</p>
                    <p>Jl. Contoh No. 123, Jakarta</p>
                </div>
            </div>
            <div class="event-card">
                <h3>Resepsi</h3>
                <div class="time">11:00 - 14:00 WIB</div>
                <div class="location">
                    <p>Gedung Serbaguna</p>
                    <p>Jl. Contoh No. 456, Jakarta</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <h2>Our Moments</h2>
        <div class="divider"></div>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 1">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 2">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 3">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 4">
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section class="rsvp-section">
        <h2>Konfirmasi Kehadiran</h2>
        <div class="divider"></div>
        <form class="rsvp-form">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="attendance">Kehadiran</label>
                <select id="attendance" name="attendance" required>
                    <option value="">Pilih</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak-hadir">Tidak Hadir</option>
                </select>
            </div>
            <div class="form-group">
                <label for="guests">Jumlah Tamu</label>
                <input type="number" id="guests" name="guests" min="1" max="5" value="1">
            </div>
            <div class="form-group">
                <label for="message">Ucapan & Doa</label>
                <textarea id="message" name="message" rows="4"></textarea>
            </div>
            <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <div class="ornament">❦</div>
        <p>Made with ❤️ by <a href="#">Risa Digital Invitation</a></p>
        <p>&copy; 2024 All Rights Reserved</p>
    </footer>
</body>
</html>
