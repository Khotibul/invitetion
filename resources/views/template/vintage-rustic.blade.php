@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $femaleName }} &amp; {{ $maleName }} | Risa Digital Invitation</title>
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
    <meta name="theme-color" content="#8b7355">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --vintage-brown: #8b7355;
            --cream: #f5f1e8;
            --dark-brown: #5d4e37;
            --gold: #d4af37;
            --white: #ffffff;

            /* Shared vars for template.partials.rsvp-wishes */
            --color-primary: var(--vintage-brown);
            --color-muted: rgba(93, 78, 55, 0.7);
            --section-bg: #ffffff;
            --card-bg: #ffffff;
            --rsvp-bg: #fff7ea;
            --font-heading: 'Crimson Text', serif;
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

        .couple-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 700;
            font-size: 4rem;
            letter-spacing: 2px;
            background: radial-gradient(circle at 30% 30%, rgba(212, 175, 55, 0.25), rgba(93, 78, 55, 0.78));
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
        {{ '@' }}media (max-width: 768px) {
            .hero-content h1 { font-size: 3rem; }
            .hero-content .names { font-size: 2rem; }
            .section-title { font-size: 2.5rem; }
            .couple-grid { grid-template-columns: 1fr; }
        }
    </style>
@include('template.partials.font-vars')
</head>
<body>
@include('template.partials.preview-banner')
    <div class="paper-texture"></div>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="ornament-top">❦</div>
            @if($coverSrc)
            <img src="{{ $coverSrc }}" alt="foto sampul"
                 style="width:130px;height:130px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,.5);margin-bottom:1rem;box-shadow:0 4px 20px rgba(0,0,0,.25)">
            @endif
            <h1>{{ $coverTop ?: 'The Wedding' }}</h1>
            <div class="names">{{ $femaleNickname }} &amp; {{ $maleNickname }}</div>
            <div class="date">{{ $weddingDateFormatted }}</div>
        </div>
    </section>

    <!-- Quote -->
    @if($quoteContent)
    <section class="quote-section">
        <div class="container">
            <p class="quote-text">"{{ $quoteContent }}"</p>
        </div>
    </section>
    @endif

    <!-- Couple -->
    <section class="couple-section">
        <div class="container">
            <h2 class="section-title">The Couple</h2>
            <div class="couple-grid">
                <div class="couple-card">
                    <div class="couple-photo">
                        @if($femaleSrc)
                        <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}">
                        @else
                        <div class="couple-placeholder" aria-label="{{ $femaleName }}">{{ $femaleInitial }}</div>
                        @endif
                    </div>
                    <h3>{{ $femaleName }}</h3>
                    @if($showParent)<p class="parents">Putri ke-{{ $femaleChildhood }} dari<br>Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
                </div>
                <div class="couple-card">
                    <div class="couple-photo">
                        @if($maleSrc)
                        <img src="{{ $maleSrc }}" alt="{{ $maleName }}">
                        @else
                        <div class="couple-placeholder" aria-label="{{ $maleName }}">{{ $maleInitial }}</div>
                        @endif
                    </div>
                    <h3>{{ $maleName }}</h3>
                    @if($showParent)<p class="parents">Putra ke-{{ $maleChildhood }} dari<br>Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}</p>@endif
                </div>
            </div>
        </div>
    </section>

    <!-- Events -->
    @if(count($other['event'] ?? []) > 0)
    <section class="event-section">
        <div class="container">
            <h2 class="section-title">Event Details</h2>
            <div class="event-grid">
                @foreach ($other['event'] as $item)
                @php $item->prop = json_decode($item->content); @endphp
                @if($item->prop)
                <div class="event-card">
                    <h3>{{ $item->title }}</h3>
                    <div class="event-time">{{ $weddingDateFormatted }}<br>{{ date('H:i', strtotime($item->prop->time->start)) }} - {{ ($item->prop->time->done===true) ? 'Selesai' : date('H:i', strtotime($item->prop->time->end)) }} {{ $weddingTz }}</div>
                    <div class="event-location">
                        @if(!empty($item->prop->location->address ?? ''))<strong>{{ $item->prop->location->address }}</strong>@endif
                    </div>
                    @if(!empty($item->prop->location->map ?? ''))<a href="{{ $item->prop->location->map }}" target="_blank" class="btn-submit" style="display:inline-block; width:auto; margin-top:1rem; text-decoration:none;">Lihat Lokasi</a>@endif
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

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

    @include('template.partials.details')

@include('template.partials.rsvp-wishes')

    <!-- Footer -->
    <footer>
        <div class="ornament">❦</div>
        <p>{{ $femaleNickname }} &amp; {{ $maleNickname }}</p>
        @if($showClosing && $closingText)<p style="font-size:.85rem;opacity:.8;margin-top:.3rem">{{ $closingText }}</p>@endif
        <p style="font-size:.7rem;opacity:.6;margin-top:.5rem">Risa Digital Invitation</p>
    </footer>
@include('template.partials.music-player')
</body>
</html>
