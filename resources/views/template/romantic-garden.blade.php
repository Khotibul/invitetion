<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --rose-pink: #e8b4b8;
            --sage-green: #8ba888;
            --cream: #faf8f3;
            --gold: #c9a961;
            --dark-green: #4a6741;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: var(--cream);
            color: var(--dark-green);
        }

        h1, h2, h3 {
            font-family: 'Alex Brush', cursive;
        }

        /* Floral Background */
        .floral-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.08;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="40" fill="%238ba888"/><path d="M100 60 Q 80 80 100 100 Q 120 80 100 60" fill="%23e8b4b8"/><path d="M140 100 Q 120 80 100 100 Q 120 120 140 100" fill="%23e8b4b8"/><path d="M100 140 Q 120 120 100 100 Q 80 120 100 140" fill="%23e8b4b8"/><path d="M60 100 Q 80 120 100 100 Q 80 80 60 100" fill="%23e8b4b8"/></svg>');
            background-size: 300px;
            z-index: -1;
        }

        /* Opening Cover */
        .opening-cover {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--dark-green) 100%);
            position: relative;
            overflow: hidden;
        }

        .opening-cover::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 15s infinite ease-in-out;
        }

        .opening-cover::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float 20s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        .opening-content {
            text-align: center;
            color: white;
            z-index: 1;
            padding: 2rem;
            animation: fadeInUp 1.5s ease;
        }

        .opening-content .ornament {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        .opening-content h1 {
            font-size: 5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .opening-content .couple {
            font-size: 2.5rem;
            margin: 2rem 0;
        }

        .opening-content .date {
            font-size: 1.3rem;
            letter-spacing: 3px;
            opacity: 0.95;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        /* Welcome Section */
        .welcome {
            padding: 5rem 2rem;
            text-align: center;
            background: white;
        }

        .welcome h2 {
            font-size: 3.5rem;
            color: var(--sage-green);
            margin-bottom: 2rem;
        }

        .welcome-text {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            font-size: 1.1rem;
            color: var(--dark-green);
        }

        .divider {
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--rose-pink), transparent);
            margin: 2rem auto;
        }

        /* Couple Section */
        .couple-section {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #f5f3ee 0%, var(--cream) 100%);
        }

        .couple-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
        }

        .couple-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(138, 168, 136, 0.15);
            position: relative;
            overflow: hidden;
        }

        .couple-card::before {
            content: '❀';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 3rem;
            color: var(--rose-pink);
            opacity: 0.3;
        }

        .couple-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 2rem;
            border: 5px solid var(--sage-green);
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative;
        }

        .couple-photo::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px solid var(--rose-pink);
            border-radius: 50%;
            margin: 10px;
        }

        .couple-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .couple-card h3 {
            font-size: 2.5rem;
            color: var(--sage-green);
            margin-bottom: 0.5rem;
        }

        .couple-card .parents {
            color: var(--rose-pink);
            font-style: italic;
            margin-bottom: 1rem;
        }

        .couple-card .bio {
            color: var(--dark-green);
            line-height: 1.6;
        }

        /* Love Story */
        .love-story {
            padding: 5rem 2rem;
            background: white;
        }

        .love-story h2 {
            text-align: center;
            font-size: 3.5rem;
            color: var(--sage-green);
            margin-bottom: 3rem;
        }

        .story-timeline {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .story-timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--sage-green), var(--rose-pink));
            transform: translateX(-50%);
        }

        .story-item {
            display: flex;
            margin-bottom: 3rem;
            position: relative;
        }

        .story-item:nth-child(odd) {
            flex-direction: row;
        }

        .story-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .story-content {
            width: 45%;
            background: var(--cream);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .story-item:nth-child(odd) .story-content {
            margin-right: auto;
            margin-left: 0;
        }

        .story-item:nth-child(even) .story-content {
            margin-left: auto;
            margin-right: 0;
        }

        .story-year {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            background: var(--sage-green);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .story-content h4 {
            color: var(--sage-green);
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        /* Event Details */
        .events {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--dark-green) 100%);
            color: white;
        }

        .events h2 {
            text-align: center;
            font-size: 3.5rem;
            margin-bottom: 3rem;
        }

        .events-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .event-card {
            background: rgba(255,255,255,0.95);
            color: var(--dark-green);
            padding: 3rem;
            border-radius: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        .event-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .event-card h3 {
            font-size: 2rem;
            color: var(--sage-green);
            margin-bottom: 1rem;
        }

        .event-time {
            font-size: 1.2rem;
            color: var(--rose-pink);
            margin-bottom: 1rem;
        }

        .event-location {
            line-height: 1.6;
        }

        .map-button {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.8rem 2rem;
            background: var(--sage-green);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .map-button:hover {
            background: var(--dark-green);
            transform: scale(1.05);
        }

        /* Gallery */
        .gallery {
            padding: 5rem 2rem;
            background: white;
        }

        .gallery h2 {
            text-align: center;
            font-size: 3.5rem;
            color: var(--sage-green);
            margin-bottom: 3rem;
        }

        .gallery-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            aspect-ratio: 1;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.15);
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(138,168,136,0.3), rgba(232,180,184,0.3));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        /* RSVP */
        .rsvp {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #f5f3ee 0%, var(--cream) 100%);
        }

        .rsvp h2 {
            text-align: center;
            font-size: 3.5rem;
            color: var(--sage-green);
            margin-bottom: 3rem;
        }

        .rsvp-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-green);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            font-family: 'Raleway', sans-serif;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--sage-green);
        }

        .submit-button {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, var(--sage-green), var(--dark-green));
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(138,168,136,0.3);
        }

        /* Footer */
        footer {
            background: var(--dark-green);
            color: white;
            text-align: center;
            padding: 3rem 2rem;
        }

        footer .heart {
            color: var(--rose-pink);
            font-size: 1.5rem;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .opening-content h1 {
                font-size: 3rem;
            }

            .opening-content .couple {
                font-size: 1.8rem;
            }

            .story-timeline::before {
                left: 30px;
            }

            .story-item {
                flex-direction: column !important;
            }

            .story-content {
                width: 100%;
                margin-left: 60px !important;
                margin-right: 0 !important;
            }

            .story-year {
                left: 30px;
            }

            .couple-container {
                grid-template-columns: 1fr;
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
    </style>
</head>
<body>
    <div class="floral-bg"></div>

    <!-- Opening Cover -->
    <section class="opening-cover">
        <div class="opening-content">
            <div class="ornament">❀</div>
            <h1>The Wedding</h1>
            <div class="couple">Bride & Groom</div>
            <div class="divider"></div>
            <div class="date">15 . JUNI . 2024</div>
        </div>
        <div class="scroll-indicator">
            <div>↓</div>
            <div style="font-size: 0.8rem; margin-top: 0.5rem;">Scroll Down</div>
        </div>
    </section>

    <!-- Welcome -->
    <section class="welcome">
        <h2>Welcome to Our Wedding</h2>
        <div class="divider"></div>
        <div class="welcome-text">
            <p>Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i 
            untuk hadir di acara pernikahan kami. Merupakan suatu kehormatan dan kebahagiaan bagi kami 
            apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.</p>
        </div>
    </section>

    <!-- Couple -->
    <section class="couple-section">
        <div class="couple-container">
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="https://via.placeholder.com/200" alt="Bride">
                </div>
                <h3>Bride Name</h3>
                <p class="parents">Putri dari<br>Bapak & Ibu</p>
                <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Sed do eiusmod tempor incididunt ut labore.</p>
            </div>
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="https://via.placeholder.com/200" alt="Groom">
                </div>
                <h3>Groom Name</h3>
                <p class="parents">Putra dari<br>Bapak & Ibu</p>
                <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Sed do eiusmod tempor incididunt ut labore.</p>
            </div>
        </div>
    </section>

    <!-- Love Story -->
    <section class="love-story">
        <h2>Our Love Story</h2>
        <div class="divider"></div>
        <div class="story-timeline">
            <div class="story-item">
                <div class="story-year">2020</div>
                <div class="story-content">
                    <h4>First Meet</h4>
                    <p>Pertemuan pertama kami yang tak terduga di sebuah kafe kecil di kota.</p>
                </div>
            </div>
            <div class="story-item">
                <div class="story-year">2021</div>
                <div class="story-content">
                    <h4>First Date</h4>
                    <p>Kencan pertama yang romantis di taman bunga yang indah.</p>
                </div>
            </div>
            <div class="story-item">
                <div class="story-year">2023</div>
                <div class="story-content">
                    <h4>Proposal</h4>
                    <p>Lamaran yang penuh kejutan di tempat pertemuan pertama kami.</p>
                </div>
            </div>
            <div class="story-item">
                <div class="story-year">2024</div>
                <div class="story-content">
                    <h4>Wedding Day</h4>
                    <p>Hari yang kami tunggu untuk memulai hidup baru bersama.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section class="events">
        <h2>Event Details</h2>
        <div class="events-grid">
            <div class="event-card">
                <div class="event-icon">💒</div>
                <h3>Akad Nikah</h3>
                <div class="event-time">Sabtu, 15 Juni 2024<br>08:00 - 10:00 WIB</div>
                <div class="event-location">
                    <strong>Masjid Al-Ikhlas</strong><br>
                    Jl. Contoh No. 123<br>
                    Jakarta Selatan
                </div>
                <a href="#" class="map-button">📍 Lihat Lokasi</a>
            </div>
            <div class="event-card">
                <div class="event-icon">🎉</div>
                <h3>Resepsi</h3>
                <div class="event-time">Sabtu, 15 Juni 2024<br>11:00 - 14:00 WIB</div>
                <div class="event-location">
                    <strong>Gedung Serbaguna</strong><br>
                    Jl. Contoh No. 456<br>
                    Jakarta Selatan
                </div>
                <a href="#" class="map-button">📍 Lihat Lokasi</a>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="gallery">
        <h2>Our Gallery</h2>
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
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 5">
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/400" alt="Gallery 6">
            </div>
        </div>
    </section>

    <!-- RSVP -->
    <section class="rsvp">
        <h2>Konfirmasi Kehadiran</h2>
        <div class="divider"></div>
        <div class="rsvp-container">
            <form>
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
                <button type="submit" class="submit-button">Kirim Konfirmasi</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="ornament">❀</div>
        <p>Made with <span class="heart">♥</span> by Risa Digital Invitation</p>
        <p>&copy; 2024 All Rights Reserved</p>
    </footer>
</body>
</html>
