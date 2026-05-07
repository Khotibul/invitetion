@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
    <meta name="theme-color" content="#2d7a4f">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

            /* Shared vars for template.partials.rsvp-wishes */
            --color-primary: var(--emerald);
            --color-muted: rgba(44, 62, 80, 0.65);
            --section-bg: #ffffff;
            --card-bg: #ffffff;
            --rsvp-bg: #f3faf6;
            --font-heading: 'Cinzel', serif;
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

        {{ '@' }}keyframes fadeInScale {
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

        .couple-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 30%, rgba(212, 175, 55, 0.25), rgba(45, 122, 79, 0.65));
            color: #fff;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 4rem;
            letter-spacing: 2px;
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
        {{ '@' }}media (max-width: 768px) {
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

        {{ '@' }}media (max-width: 480px) {
            .gallery-masonry {
                columns: 1;
            }
        }
    </style>
@include('template.partials.font-vars')
</head>
<body>
@include('template.partials.preview-banner')
    <div class="botanical-bg"></div>

    <!-- Opening -->
    <section class="opening">
        <div class="opening-content">
            @if($coverSrc)
            <img src="{{ $coverSrc }}" alt="foto sampul"
                 style="width:130px;height:130px;border-radius:50%;object-fit:cover;border:4px solid var(--gold);margin-bottom:1.2rem;box-shadow:0 0 0 6px rgba(212,175,55,.15)">
            @endif
            <h1>{{ $coverTop ?: 'The Wedding Of' }}</h1>
            <div class="divider"></div>
            <div class="names">
                <span>{{ $femaleName }}</span>
                <span class="and">&amp;</span>
                <span>{{ $maleName }}</span>
            </div>
            <p style="font-size:1.1rem;color:var(--gold)">{{ $weddingDateFormatted }}</p>
            @if($other['guest'])<p style="font-size:.85rem;color:var(--charcoal);margin-top:.5rem">Kepada: {{ $other['guest']['name'] ?? '' }}</p>@endif
        </div>
    </section>

    <!-- Countdown -->
    @if($showCountdown)
    <section class="countdown">
        <h2>Counting Down to Our Big Day</h2>
        <div class="countdown-timer">
            <div class="countdown-item"><div class="number" id="cd-d">00</div><div class="label">Hari</div></div>
            <div class="countdown-item"><div class="number" id="cd-h">00</div><div class="label">Jam</div></div>
            <div class="countdown-item"><div class="number" id="cd-m">00</div><div class="label">Menit</div></div>
            <div class="countdown-item"><div class="number" id="cd-s">00</div><div class="label">Detik</div></div>
        </div>
    </section>
    @endif

    <!-- Couple -->
    <section class="couple">
        <div class="couple-container">
                <div class="couple-card">
                    <div class="couple-photo" style="position:relative">
                        @if($femaleSrc)<img src="{{ $femaleSrc }}" alt="{{ $femaleName }}">
                    @else<div class="couple-placeholder" aria-label="{{ $femaleName }}">{{ $femaleInitial }}</div>@endif
                        @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" style="position:absolute;inset:0;width:100%;height:100%;border-radius:50%;pointer-events:none">@endif
                    </div>
                <h3>{{ $femaleName }}</h3>
                @if($showParent)<p class="subtitle">Putri ke-{{ $femaleChildhood }} dari Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
                @if($showIg && $femaleIg)<p style="font-size:.8rem;color:var(--gold);margin-top:.4rem">@{{ $femaleIg }}</p>@endif
            </div>
                <div class="couple-card">
                    <div class="couple-photo" style="position:relative">
                        @if($maleSrc)<img src="{{ $maleSrc }}" alt="{{ $maleName }}">
                    @else<div class="couple-placeholder" aria-label="{{ $maleName }}">{{ $maleInitial }}</div>@endif
                        @if($maleFrame)<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" style="position:absolute;inset:0;width:100%;height:100%;border-radius:50%;pointer-events:none">@endif
                    </div>
                <h3>{{ $maleName }}</h3>
                @if($showParent)<p class="subtitle">Putra ke-{{ $maleChildhood }} dari Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}</p>@endif
                @if($showIg && $maleIg)<p style="font-size:.8rem;color:var(--gold);margin-top:.4rem">@{{ $maleIg }}</p>@endif
            </div>
        </div>
    </section>

    <!-- Events -->
    @if(count($other['event'] ?? []) > 0)
    <section class="events">
        <h2>Event Details</h2>
        <div class="events-grid">
            @foreach($other['event'] as $ev)
            @php $ep = json_decode($ev->content); @endphp
            @if($ep)
            <div class="event-card">
                <h3>{{ $ev->title }}</h3>
                <p class="date-time">{{ $weddingDateFormatted }} | {{ date('H:i',strtotime($ep->time->start)) }} - {{ ($ep->time->done??false)?'Selesai':date('H:i',strtotime($ep->time->end)) }} {{ $weddingTz }}</p>
                @if(!empty($ep->location->address??''))<div class="location"><p><strong>{{ $ep->location->address }}</strong></p></div>@endif
                @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" class="map-btn" target="_blank">Lihat Lokasi</a>@endif
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
        <div class="gallery-masonry">
            @foreach($galleryFiles as $i => $gf)
            <div class="gallery-item"><img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy"></div>
            @endforeach
        </div>
    </section>
    @endif

    @include('template.partials.details')

@include('template.partials.rsvp-wishes')

    <!-- Footer -->
    <footer>
        <p>{{ $femaleNickname }} &amp; {{ $maleNickname }}</p>
        @if($showClosing && $closingText)<p style="font-size:.85rem;opacity:.8;margin-top:.3rem">{{ $closingText }}</p>@endif
        <p style="font-size:.7rem;margin-top:.5rem"><span class="gold">Risa Digital Invitation</span></p>
    </footer>

    <script>
    (function(){
        var t=new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
        function run(){var diff=t-new Date();if(diff<=0)return;var pad=function(n){return String(Math.floor(n)).padStart(2,'0');};
        document.getElementById('cd-d').textContent=pad(diff/86400000);
        document.getElementById('cd-h').textContent=pad((diff%86400000)/3600000);
        document.getElementById('cd-m').textContent=pad((diff%3600000)/60000);
        document.getElementById('cd-s').textContent=pad((diff%60000)/1000);}
        run();setInterval(run,1000);
    })();
    </script>
</body>
</html>
