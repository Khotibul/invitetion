<!DOCTYPE html>
<html lang="id">
<head>
    @php
        use Carbon\Carbon;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --vintage-brown: #8b7355;
            --cream: #f5f1e8;
            --dark-brown: #5d4e37;
            --gold: #d4af37;
            --white: #ffffff;
        }

        body {
            font-family: 'Lora', serif;
            background: var(--cream);
            color: var(--dark-brown);
        }

        h1, h2, h3 { font-family: 'Crimson Text', serif; }

        /* Vintage Paper Effect */
        .paper-texture {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(139, 115, 85, 0.03) 2px, rgba(139, 115, 85, 0.03) 4px);
            pointer-events: none;
            z-index: 1;
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--vintage-brown) 0%, var(--dark-brown) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect x="0" y="0" width="100" height="100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></svg>');
            background-size: 50px;
            opacity: 0.3;
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
            padding: 2rem;
            max-width: 800px;
        }

        .ornament-top {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            margin-bottom: 1rem;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-content .names {
            font-size: 2.8rem;
            margin: 2rem 0;
            font-style: italic;
        }

        .hero-content .date {
            font-size: 1.3rem;
            letter-spacing: 2px;
            border-top: 1px solid rgba(255,255,255,0.3);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding: 1rem 0;
            display: inline-block;
        }

        /* Content Sections */
        section {
            padding: 5rem 2rem;
            position: relative;
            z-index: 2;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 3.5rem;
            color: var(--vintage-brown);
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title::after {
            content: '❦';
            display: block;
            font-size: 2rem;
            color: var(--gold);
            margin-top: 0.5rem;
        }

        /* Quote Section */
        .quote-section {
            background: white;
            text-align: center;
        }

        .quote-text {
            font-size: 1.5rem;
            font-style: italic;
            color: var(--vintage-brown);
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .quote-author {
            font-size: 1.1rem;
            color: var(--dark-brown);
        }

        /* Couple Section */
        .couple-section {
            background: var(--cream);
        }

        .couple-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .couple-card {
            background: white;
            padding: 3rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(139, 115, 85, 0.15);
            border: 2px solid var(--vintage-brown);
        }

        .couple-photo {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            margin: 0 auto 2rem;
            border: 5px solid var(--vintage-brown);
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .couple-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(20%);
        }

        .couple-card h3 {
            font-size: 2.5rem;
            color: var(--vintage-brown);
            margin-bottom: 1rem;
        }

        .couple-card .parents {
            font-style: italic;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        /* Event Section */
        .event-section {
            background: white;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .event-card {
            background: var(--cream);
            padding: 3rem;
            border-radius: 10px;
            text-align: center;
            border: 2px solid var(--vintage-brown);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        .event-card h3 {
            font-size: 2.2rem;
            color: var(--vintage-brown);
            margin-bottom: 1rem;
        }

        .event-time {
            font-size: 1.2rem;
            color: var(--gold);
            margin-bottom: 1.5rem;
        }

        .event-location {
            line-height: 1.8;
        }

        /* Gallery */
        .gallery-section {
            background: var(--cream);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            border: 3px solid var(--vintage-brown);
            aspect-ratio: 1;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(30%);
            transition: all 0.3s ease;
        }

        .gallery-item:hover img {
            filter: sepia(0%);
            transform: scale(1.1);
        }

        /* RSVP */
        .rsvp-section {
            background: white;
        }

        .rsvp-form {
            max-width: 700px;
            margin: 3rem auto 0;
            background: var(--cream);
            padding: 3rem;
            border-radius: 10px;
            border: 2px solid var(--vintage-brown);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-brown);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--vintage-brown);
            border-radius: 5px;
            background: white;
            font-family: 'Lora', serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--gold);
        }

        .btn-submit {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, var(--vintage-brown), var(--dark-brown));
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            font-family: 'Crimson Text', serif;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(139, 115, 85, 0.3);
        }

        /* Footer */
        footer {
            background: var(--dark-brown);
            color: white;
            text-align: center;
            padding: 3rem 2rem;
        }

        footer .ornament {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--gold);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 3rem; }
            .hero-content .names { font-size: 2rem; }
            .section-title { font-size: 2.5rem; }
            .couple-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="paper-texture"></div>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="ornament-top">❦</div>
            <h1>{{ $data->cover->description->top }}</h1>
            <div class="names">{{ $data->cover->name->female }} & {{ $data->cover->name->male }}</div>
            <div class="date">{{ Carbon::parse($data->detail->calendar->date)->format('d F Y') }}</div>
        </div>
    </section>

    <!-- Quote -->
    <section class="quote-section">
        <div class="container">
            <p class="quote-text">"{{ $data->quote->content }}"</p>
        </div>
    </section>

    <!-- Couple -->
    <section class="couple-section">
        <div class="container">
            <h2 class="section-title">The Couple</h2>
            <div class="couple-grid">
                <div class="couple-card">
                    <div class="couple-photo">
                        <img src="{{ $data->profile->photo->female->image ? url('storage/avatar/'.$data->profile->photo->female->image) : 'https://via.placeholder.com/220' }}" alt="Bride">
                    </div>
                    <h3>{{ $data->profile->name->female }}</h3>
                    <p class="parents">Putri dari<br>Bapak {{ $data->profile->parent->female->father }} & Ibu {{ $data->profile->parent->female->mother }}</p>
                </div>
                <div class="couple-card">
                    <div class="couple-photo">
                        <img src="{{ $data->profile->photo->male->image ? url('storage/avatar/'.$data->profile->photo->male->image) : 'https://via.placeholder.com/220' }}" alt="Groom">
                    </div>
                    <h3>{{ $data->profile->name->male }}</h3>
                    <p class="parents">Putra dari<br>Bapak {{ $data->profile->parent->male->father }} & Ibu {{ $data->profile->parent->male->mother }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section class="event-section">
        <div class="container">
            <h2 class="section-title">Event Details</h2>
            <div class="event-grid">
                @foreach ($other['event'] as $item)
                @php $item->prop = json_decode($item->content); @endphp
                @if($item->prop)
                <div class="event-card">
                    <h3>{{ $item->title }}</h3>
                    <div class="event-time">{{ Carbon::parse($data->detail->calendar->date)->format('l, d F Y') }}<br>{{ date('H:i', strtotime($item->prop->time->start)) }} - {{ ($item->prop->time->done===true) ? 'Selesai' : date('H:i', strtotime($item->prop->time->end)) }} WIB</div>
                    <div class="event-location">
                        <strong>{{ $item->prop->location->address }}</strong>
                    </div>
                    <a href="{{ $item->prop->location->map }}" target="_blank" class="btn-submit" style="display:inline-block; width:auto; margin-top:1rem; text-decoration:none;">Lihat Lokasi</a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery -->
    @if ($other['photo'])
    <section class="gallery-section">
        <div class="container">
            <h2 class="section-title">{{ $other['photo']->title }}</h2>
            <div class="gallery-grid">
                @foreach ($other['photo']->prop->file as $key => $file)
                <div class="gallery-item">
                    <img src="{{ url('storage/'.$file) }}" alt="Gallery {{ $key }}">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- RSVP -->
    <section class="rsvp-section">
        <div class="container">
            <h2 class="section-title">{{ $data->rsvp->title }}</h2>
            <form action="{{ route('invitation.present', request()->slug) }}" class="rsvp-form sender" method="post">
                @csrf
                <p style="text-align:center; margin-bottom:2rem;">{{ $data->rsvp->content }}</p>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Kehadiran</label>
                    <select name="option" required>
                        <option value="">Pilih</option>
                        <option value="yes">{{ $data->rsvp->yes->option }}</option>
                        <option value="no">{{ $data->rsvp->no->option }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Tamu</label>
                    <input type="number" name="amount" min="1" max="5" value="1">
                </div>
                <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="ornament">❦</div>
        <p>Made with ♥ by Risa Digital Invitation</p>
        <p>&copy; {{ date('Y') }} All Rights Reserved</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>
        $(".sender").on('submit', function(e) {
            e.preventDefault();
            let action = $(this).attr('action'),
                submit = $(this).find('button[type=submit]');
            $.ajax({
                type: 'post',
                url : action,
                dataType: 'json',
                data: $(this).serialize(),
                error: function(q,w,e) {
                    submit.text('Coba Lagi');
                    submit.prop('disabled', false);
                },
                beforeSend: function() {
                    submit.prop('disabled', true);
                    submit.text('Memeriksa data...');
                },
                success: function(response) {
                    submit.prop('disabled', false);
                    submit.text('Terkirim');
                    $(".sender")[0].reset();
                    alert(response.message);
                }
            });
        });
    </script>
</html>
