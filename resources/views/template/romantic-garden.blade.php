@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding of {{ $femaleName }} &amp; {{ $maleName }} | Risa Digital Invitation</title>
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:title" content="Wedding of {{ $femaleName }} & {{ $maleName }}">
    <meta name="theme-color" content="#2d7a4f">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Replaced pink accent with green to match the global theme. */
            --rose-pink: #2d7a4f;
            --sage-green: #8ba888;
            --cream: #faf8f3;
            --gold: #c9a961;
            --dark-green: #4a6741;

            /* Shared vars for template.partials.rsvp-wishes */
            --color-primary: var(--rose-pink);
            --color-muted: rgba(74, 103, 65, 0.7);
            --section-bg: #ffffff;
            --card-bg: #ffffff;
            --rsvp-bg: #f3f7f2;
            --font-heading: 'Alex Brush', cursive;
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
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="40" fill="%238ba888"/><path d="M100 60 Q 80 80 100 100 Q 120 80 100 60" fill="%232d7a4f"/><path d="M140 100 Q 120 80 100 100 Q 120 120 140 100" fill="%232d7a4f"/><path d="M100 140 Q 120 120 100 100 Q 80 120 100 140" fill="%232d7a4f"/><path d="M60 100 Q 80 120 100 100 Q 80 80 60 100" fill="%232d7a4f"/></svg>');
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

        {{ '@' }}keyframes float {
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

        {{ '@' }}keyframes pulse {
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

        {{ '@' }}keyframes bounce {
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

        .couple-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 30%, rgba(201, 169, 97, 0.25), rgba(139, 168, 136, 0.75));
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            font-size: 4rem;
            letter-spacing: 1px;
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

        {{ '@' }}keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Responsive */
        {{ '@' }}media (max-width: 768px) {
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

        {{ '@' }}keyframes fadeInUp {
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
    <section class="opening-cover">
        <div class="opening-content">
            <div class="ornament">❀</div>
            @if($coverSrc)
            <img src="{{ $coverSrc }}" alt="foto sampul"
                 style="width:130px;height:130px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,.6);margin-bottom:1rem;box-shadow:0 4px 20px rgba(0,0,0,.2)">
            @endif
            <h1>The Wedding</h1>
            <div class="couple">{{ $femaleName }} &amp; {{ $maleName }}</div>
            <div class="divider"></div>
            <div class="date">{{ \Carbon\Carbon::parse($weddingDate)->format('d . m . Y') }}</div>
            @if($other['guest'])<p style="color:rgba(255,255,255,.8);font-size:.85rem;margin-top:.5rem">Kepada: {{ $other['guest']['name'] ?? '' }}</p>@endif
        </div>
        <div class="scroll-indicator"><div>↓</div><div style="font-size:.8rem;margin-top:.5rem">Scroll Down</div></div>
    </section>

    <!-- Welcome -->
    <section class="welcome">
        <h2>Welcome to Our Wedding</h2>
        <div class="divider"></div>
        <div class="welcome-text">
            <p>{{ $coverBottom ?: 'Dengan penuh kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu.' }}</p>
            @if($quoteContent)<p style="margin-top:1rem;font-style:italic;color:var(--sage-green)">"{{ $quoteContent }}"</p>@endif
        </div>
    </section>

    <!-- Couple -->
    <section class="couple-section">
        <div class="couple-container">
            <div class="couple-card">
                <div class="couple-photo" style="position:relative">
                    @if($femaleSrc)<img src="{{ $femaleSrc }}" alt="{{ $femaleName }}">
                    @else<div class="couple-placeholder" aria-label="{{ $femaleName }}">{{ $femaleInitial }}</div>@endif
                    @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" style="position:absolute;inset:0;width:100%;height:100%;border-radius:50%;pointer-events:none">@endif
                </div>
                <h3>{{ $femaleName }}</h3>
                @if($showParent)<p class="parents">Putri ke-{{ $femaleChildhood }} dari<br>Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
                @if($showIg && $femaleIg)<p style="font-size:.8rem;color:var(--sage-green);margin-top:.5rem">@{{ $femaleIg }}</p>@endif
            </div>
            <div class="couple-card">
                <div class="couple-photo" style="position:relative">
                    @if($maleSrc)<img src="{{ $maleSrc }}" alt="{{ $maleName }}">
                    @else<div class="couple-placeholder" aria-label="{{ $maleName }}">{{ $maleInitial }}</div>@endif
                    @if($maleFrame)<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" style="position:absolute;inset:0;width:100%;height:100%;border-radius:50%;pointer-events:none">@endif
                </div>
                <h3>{{ $maleName }}</h3>
                @if($showParent)<p class="parents">Putra ke-{{ $maleChildhood }} dari<br>Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}</p>@endif
                @if($showIg && $maleIg)<p style="font-size:.8rem;color:var(--sage-green);margin-top:.5rem">@{{ $maleIg }}</p>@endif
            </div>
        </div>
    </section>

    <!-- Love Story -->
    @if(count($other['story'] ?? []) > 0)
    <section class="love-story">
        <h2>Our Love Story</h2>
        <div class="divider"></div>
        <div class="story-timeline">
            @foreach($other['story'] as $i => $st)
            <div class="story-item">
                <div class="story-year">{{ \Carbon\Carbon::parse($st->created_at)->format('Y') }}</div>
                <div class="story-content">
                    <h4>{{ $st->title }}</h4>
                    <p>{{ $st->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Events -->
    @if(count($other['event'] ?? []) > 0)
    <section class="events">
        <h2>Event Details</h2>
        <div class="events-grid">
            @foreach($other['event'] as $ev)
            @php $ep = json_decode($ev->content); @endphp
            @if($ep)
            <div class="event-card">
                <div class="event-icon">💒</div>
                <h3>{{ $ev->title }}</h3>
                <div class="event-time">{{ $weddingDateFormatted }}<br>{{ date('H:i',strtotime($ep->time->start)) }} - {{ ($ep->time->done??false) ? 'selesai' : date('H:i',strtotime($ep->time->end)) }} {{ $weddingTz }}</div>
                @if(!empty($ep->location->address??''))<div class="event-location"><strong>{{ $ep->location->address }}</strong></div>@endif
                @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" class="map-button">📍 Lihat Lokasi</a>@endif
            </div>
            @endif
            @endforeach
        </div>
    </section>
    @endif

    <!-- Gallery -->
    @if(count($galleryFiles) > 0)
    <section class="gallery">
        <h2>{{ $galleryTitle }}</h2>
        <div class="divider"></div>
        <div class="gallery-grid">
            @foreach($galleryFiles as $i => $gf)
            <div class="gallery-item"><img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy"></div>
            @endforeach
        </div>
    </section>
    @endif

    @include('template.partials.rsvp-wishes')

    <!-- Footer -->
    <footer>
        <div class="ornament">❀</div>
        <p>{{ $femaleName }} &amp; {{ $maleName }}</p>
        @if($showClosing && $closingText)<p style="font-size:.85rem;opacity:.8;margin-top:.3rem">{{ $closingText }}</p>@endif
        <p style="font-size:.7rem;opacity:.6;margin-top:.5rem">Risa Digital Invitation</p>
    </footer>
</body>
</html>
