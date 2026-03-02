<!DOCTYPE html>
<html lang="id">
<head>
    @php
        use Carbon\Carbon;
    @endphp
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
            <h1>{{ $data->cover->description->top }}</h1>
            <div class="divider"></div>
            <div class="names">
                <span>{{ $data->cover->name->female }}</span>
                <span class="and">&</span>
                <span>{{ $data->cover->name->male }}</span>
            </div>
            <p style="font-size: 1.2rem; color: var(--gold);">{{ Carbon::parse($data->detail->calendar->date)->format('d F Y') }}</p>
        </div>
    </section>

    <!-- Countdown -->
    <section class="countdown">
        <h2>Counting Down to Our Big Day</h2>
        <div class="countdown-timer">
            <!-- Countdown Logic to be implemented with JS -->
            <div class="countdown-item">
                <div class="number">{{ Carbon::parse($data->detail->calendar->date)->diffInDays(now()) }}</div>
                <div class="label">Days</div>
            </div>
        </div>
    </section>

    <!-- Couple -->
    <section class="couple">
        <div class="couple-container">
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="{{ $data->profile->photo->female->image ? url('storage/avatar/'.$data->profile->photo->female->image) : 'https://via.placeholder.com/250' }}" alt="Bride">
                </div>
                <h3>{{ $data->profile->name->female }}</h3>
                <p class="subtitle">Putri dari Bapak {{ $data->profile->parent->female->father }} & Ibu {{ $data->profile->parent->female->mother }}</p>
            </div>
            <div class="couple-card">
                <div class="couple-photo">
                    <img src="{{ $data->profile->photo->male->image ? url('storage/avatar/'.$data->profile->photo->male->image) : 'https://via.placeholder.com/250' }}" alt="Groom">
                </div>
                <h3>{{ $data->profile->name->male }}</h3>
                <p class="subtitle">Putra dari Bapak {{ $data->profile->parent->male->father }} & Ibu {{ $data->profile->parent->male->mother }}</p>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section class="events">
        <h2>Event Details</h2>
        <div class="events-grid">
            @foreach ($other['event'] as $item)
            @php $item->prop = json_decode($item->content); @endphp
            <div class="event-card">
                <h3>{{ $item->title }}</h3>
                <p class="date-time">{{ Carbon::parse($data->detail->calendar->date)->format('l, d F Y') }} | {{ date('H:i', strtotime($item->prop->time->start)) }} - {{ ($item->prop->time->done===true) ? 'Selesai' : date('H:i', strtotime($item->prop->time->end)) }} WIB</p>
                <div class="location">
                    <p><strong>{{ $item->prop->location->address }}</strong></p>
                </div>
                <a href="{{ $item->prop->location->map }}" class="map-btn" target="_blank">Lihat Lokasi</a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Gallery -->
    @if ($other['photo'])
    <section class="gallery">
        <h2>{{ $other['photo']->title }}</h2>
        <div class="gallery-masonry">
            @foreach ($other['photo']->prop->file as $key => $file)
            <div class="gallery-item">
                <img src="{{ url('storage/'.$file) }}" alt="Gallery {{ $key }}">
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- RSVP -->
    <section class="rsvp">
        <h2>{{ $data->rsvp->title }}</h2>
        <div class="rsvp-form">
            <p>{{ $data->rsvp->content }}</p>
            <form action="{{ route('invitation.present', request()->slug) }}" class="sender" method="post">
                @csrf
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
                <button type="submit" class="submit-btn">Kirim Konfirmasi</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>Made with ❤️ by <span class="gold">Risa Digital Invitation</span></p>
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
</body>
</html>
