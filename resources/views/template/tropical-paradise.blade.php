<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --tropical-green: #00a86b;
            --ocean-blue: #0077be;
            --sand: #f4e4c1;
            --coral: #ff6b6b;
            --white: #ffffff;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--sand);
            color: #333;
        }

        h1, h2, h3 { font-family: 'Pacifico', cursive; }

        /* Hero Beach */
        .hero-beach {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--tropical-green) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-beach::before {
            content: '🌴';
            position: absolute;
            font-size: 15rem;
            opacity: 0.1;
            top: -50px;
            right: -50px;
            animation: sway 10s infinite ease-in-out;
        }

        @keyframes sway {
            0%, 100% { transform: rotate(-5deg); }
            50% { transform: rotate(5deg); }
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 1;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-content .names {
            font-size: 2.5rem;
            margin: 2rem 0;
        }

        .wave-divider {
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23f4e4c1"/></svg>') no-repeat bottom;
            background-size: cover;
            position: absolute;
            bottom: 0;
        }

        /* Content Sections */
        section {
            padding: 5rem 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            color: var(--tropical-green);
            margin-bottom: 3rem;
        }

        /* Couple Cards */
        .couple-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .couple-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .couple-photo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 5px solid var(--tropical-green);
            overflow: hidden;
        }

        .couple-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Event Cards */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .event-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
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

        /* RSVP Form */
        .rsvp-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--tropical-green);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--tropical-green), var(--ocean-blue));
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
        }

        footer {
            background: var(--tropical-green);
            color: white;
            text-align: center;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.5rem; }
            .hero-content .names { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <section class="hero-beach">
        <div class="hero-content">
            <h1>Beach Wedding</h1>
            <div class="names">Bride & Groom</div>
            <p style="font-size: 1.2rem;">15 Juni 2024</p>
        </div>
        <div class="wave-divider"></div>
    </section>

    <section style="background: white;">
        <div class="container">
            <h2 class="section-title">The Couple</h2>
            <div class="couple-grid">
                <div class="couple-card">
                    <div class="couple-photo">
                        <img src="https://via.placeholder.com/180" alt="Bride">
                    </div>
                    <h3 style="color: var(--coral); font-size: 2rem;">Bride Name</h3>
                    <p>Putri dari Bapak & Ibu</p>
                </div>
                <div class="couple-card">
                    <div class="couple-photo">
                        <img src="https://via.placeholder.com/180" alt="Groom">
                    </div>
                    <h3 style="color: var(--ocean-blue); font-size: 2rem;">Groom Name</h3>
                    <p>Putra dari Bapak & Ibu</p>
                </div>
            </div>
        </div>
    </section>

    <section style="background: var(--sand);">
        <div class="container">
            <h2 class="section-title">Event Details</h2>
            <div class="event-grid">
                <div class="event-card">
                    <h3 style="color: var(--tropical-green); font-size: 1.8rem;">Akad Nikah</h3>
                    <p style="margin: 1rem 0;">Sabtu, 15 Juni 2024<br>08:00 - 10:00 WIB</p>
                    <p>Masjid Al-Ikhlas<br>Jakarta</p>
                </div>
                <div class="event-card">
                    <h3 style="color: var(--ocean-blue); font-size: 1.8rem;">Resepsi</h3>
                    <p style="margin: 1rem 0;">Sabtu, 15 Juni 2024<br>11:00 - 14:00 WIB</p>
                    <p>Beach Resort<br>Jakarta</p>
                </div>
            </div>
        </div>
    </section>

    <section style="background: white;">
        <div class="container">
            <h2 class="section-title">Gallery</h2>
            <div class="gallery-grid">
                <div class="gallery-item"><img src="https://via.placeholder.com/300" alt="1"></div>
                <div class="gallery-item"><img src="https://via.placeholder.com/300" alt="2"></div>
                <div class="gallery-item"><img src="https://via.placeholder.com/300" alt="3"></div>
                <div class="gallery-item"><img src="https://via.placeholder.com/300" alt="4"></div>
            </div>
        </div>
    </section>

    <section style="background: var(--sand);">
        <div class="container">
            <h2 class="section-title">RSVP</h2>
            <form class="rsvp-form">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Kehadiran</label>
                    <select required>
                        <option value="">Pilih</option>
                        <option value="hadir">Hadir</option>
                        <option value="tidak">Tidak Hadir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ucapan</label>
                    <textarea rows="4"></textarea>
                </div>
                <button type="submit" class="btn-submit">Kirim</button>
            </form>
        </div>
    </section>

    <footer>
        <p>Made with 🌴 by Risa Digital Invitation</p>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
