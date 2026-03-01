<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --emerald: #2d7a4f;
            --gold: #d4af37;
            --ivory: #fffff0;
            --charcoal: #2c3e50;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--ivory);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Cinzel', serif;
        }

        /* Botanical Background */
        .botanical-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image: 
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50 10 Q 30 30 50 50 Q 70 30 50 10" fill="%232d7a4f"/></svg>');
            background-size: 200px;
            z-index: -1;
        }

        /* Opening Section */
        .opening {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 2rem;
        }

        .opening::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(45, 122, 79, 0.05) 100%);
        }

        .opening-content {
            position: relative;
            z-index: 1;
            animation: fadeInScale 1.5s ease;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .opening h1 {
            font-size: 4rem;
            color: var(--emerald);
            margin-bottom: 1rem;
            letter-spacing: 5px;
        }

        .opening .divider {
            width: 150px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 2rem auto;
        }

        .opening .names {
            font-size: 3rem;
            color: var(--charcoal);
            margin: 2rem 0;
        }

        .opening .names .and {
            font-size: 2rem;
            color: var(--gold);
            font-style: italic;
            margin: 0 1rem;
        }

        /* Countdown */
        .countdown {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #e8f5ee 0%, #f0f9f4 100%);
            text-align: center;
        }

        .countdown h2 {
            font-size: 2.5rem;
            color: var(--emerald);
            margin-bottom: 2rem;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .countdown-item {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            min-width: 120px;
            box-shadow: 0 5px 20px rgba(45, 122, 79, 0.1);
        }

        .countdown-item .number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--emerald);
        }

        .countdown-item .label {
            font-size: 1rem;
            color: var(--charcoal);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Couple Section */
        .couple {
            padding: 5rem 2rem;
            background: white;
        }

        .couple-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        .couple-card {
            text-align: center;
            padding: 2rem;
        }

        .couple-photo {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            margin: 0 auto 2rem;
            border: 5px solid var(--emerald);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.2);
        }

        .couple-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .couple-card h3 {
            font-size: 2rem;
            color: var(--emerald);
            margin-bottom: 0.5rem;
        }

        .couple-card .subtitle {
            color: var(--gold);
            font-style: italic;
            margin-bottom: 1rem;
        }

        /* Event Details */
        .events {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #e8f5ee 0%, #f0f9f4 100%);
        }

        .events h2 {
            text-align: center;
            font-size: 3rem;
            color: var(--emerald);
            margin-bottom: 3rem;
        }

        .events-grid {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            gap: 2rem;
        }

        .event-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.15);
            border-top: 5px solid var(--emerald);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-card h3 {
            font-size: 2rem;
            color: var(--emerald);
            margin-bottom: 1rem;
        }

        .event-card .date-time {
            font-size: 1.2rem;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .event-card .location {
            color: var(--charcoal);
            line-height: 1.8;
        }

        .event-card .map-btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.8rem 2rem;
            background: var(--emerald);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .event-card .map-btn:hover {
            background: var(--gold);
            transform: scale(1.05);
        }

        /* Gallery */
        .gallery {
            padding: 5rem 2rem;
            background: white;
        }

        .gallery h2 {
            text-align: center;
            font-size: 3rem;
            color: var(--emerald);
            margin-bottom: 3rem;
        }

        .gallery-masonry {
            max-width: 1200px;
            margin: 0 auto;
            columns: 3;
            column-gap: 1rem;
        }

        .gallery-item {
            break-inside: avoid;
            margin-bottom: 1rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            display: block;
        }

        /* RSVP */
        .rsvp {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--emerald) 0%, #3d9a6f 100%);
            color: white;
            text-align: center;
        }

        .rsvp h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .rsvp-form {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 20px;
            color: var(--charcoal);
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
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
            padding: 1rem;
            border: 2px solid #e8f5ee;
            border-radius: 10px;
            font-family: 'Lato', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--emerald);
        }

        .submit-btn {
            background: var(--gold);
            color: white;
            padding: 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: var(--emerald);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Footer */
        footer {
            background: var(--charcoal);
            color: white;
            text-align: center;
            padding: 3rem 2rem;
        }

        footer .gold {
            color: var(--gold);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .opening h1 {
                font-size: 2.5rem;
            }

            .opening .names {
                font-size: 2rem;
            }

            .gallery-masonry {
                columns: 2;
            }

            .countdown-timer {
                gap: 1rem;
            }

            .countdown-item {
                min-width: 80px;
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .gallery-masonry {
                columns: 1;
            }
        }
    </style>
</head>
<body>
    <div class="botanical-bg"></div>

    <!-- Opening -->
    <section class="opening">
        <div class="opening-content">
            <h1>WEDDING</h1>
            <div class="divider"></div>
            <div class="names">
                <span>Bride</span>
                <span class="and">&</span>
                <span>Groom</span>
            </div>
            <p style="font-size: 1.2rem; color: var(--gold);">15 Juni 2024</p>
        </div>
    </section>

    <!-- Countdown -->
    <section class="countdown">
        <h2>Counting Down to Our Big Day</h2>
        <div class="countdown-timer">
            <div class="countdown-item">
                <div class="number">30</div>
                <div class="label">Days</div>
            </div>
            <div class="countdown-item">
                <div class="number">12</div>
                <div class="label">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="number">45</div>
                <div class="label">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="number">20</div>
                <div class="label">Seconds</div>
            </div>
        </div>
    </section>

    <!-- Couple -->
    <section class="couple">
        <div class="couple-container">
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="https://via.placeholder.com/250" alt="Bride">
                </div>
                <h3>Bride Name</h3>
                <p class="subtitle">Putri dari Bapak & Ibu</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="https://via.placeholder.com/250" alt="Groom">
                </div>
                <h3>Groom Name</h3>
                <p class="subtitle">Putra dari Bapak & Ibu</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section class="events">
        <h2>Event Details</h2>
        <div class="events-grid">
            <div class="event-card">
                <h3>Akad Nikah</h3>
                <p class="date-time">Sabtu, 15 Juni 2024 | 08:00 - 10:00 WIB</p>
                <div class="location">
                    <p><strong>Masjid Al-Ikhlas</strong></p>
                    <p>Jl. Contoh No. 123, Jakarta Selatan</p>
                </div>
                <a href="#" class="map-btn">Lihat Lokasi</a>
            </div>
            <div class="event-card">
                <h3>Resepsi Pernikahan</h3>
                <p class="date-time">Sabtu, 15 Juni 2024 | 11:00 - 14:00 WIB</p>
                <div class="location">
                    <p><strong>Gedung Serbaguna</strong></p>
                    <p>Jl. Contoh No. 456, Jakarta Selatan</p>
                </div>
                <a href="#" class="map-btn">Lihat Lokasi</a>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="gallery">
        <h2>Our Gallery</h2>
        <div class="gallery-masonry">
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x300" alt="Gallery 1">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x500" alt="Gallery 2">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x400" alt="Gallery 3">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x350" alt="Gallery 4">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x450" alt="Gallery 5">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400x300" alt="Gallery 6">
            </div>
        </div>
    </section>

    <!-- RSVP -->
    <section class="rsvp">
        <h2>Konfirmasi Kehadiran</h2>
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
                <label>Jumlah Tamu</label>
                <input type="number" min="1" max="5" value="1">
            </div>
            <div class="form-group">
                <label>Ucapan & Doa</label>
                <textarea rows="4"></textarea>
            </div>
            <button type="submit" class="submit-btn">Kirim Konfirmasi</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>Made with ❤️ by <span class="gold">Risa Digital Invitation</span></p>
        <p>&copy; 2024 All Rights Reserved</p>
    </footer>
</body>
</html>
