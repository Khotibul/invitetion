@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
    <meta property="og:image" content="{{ $ogImage }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sage-green: #9caf88;
            --forest-green: #2d5016;
            --cream: #f5f1e8;
            --gold: #c9a961;

            /* Shared vars for template.partials.rsvp-wishes */
            --color-primary: var(--forest-green);
            --color-muted: rgba(45, 80, 22, 0.65);
            --section-bg: #ffffff;
            --card-bg: #ffffff;
            --rsvp-bg: #f3f7ef;
            --font-heading: 'Cormorant Garamond', serif;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--cream);
            color: var(--forest-green);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Cover */
        .cover {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(156, 175, 136, 0.92), rgba(45, 80, 22, 0.92));
            color: white;
            text-align: center;
        }

        .cover h1 {
            font-size: 4rem;
            margin-bottom: 2rem;
            letter-spacing: 3px;
        }

        .cover .date {
            font-size: 1.5rem;
            letter-spacing: 2px;
        }

        /* Story Section */
        .story {
            padding: 5rem 0;
            text-align: center;
        }

        .story h2 {
            font-size: 3rem;
            color: var(--forest-green);
            margin-bottom: 2rem;
        }

        .story-content {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Timeline */
        .timeline {
            padding: 5rem 0;
            background: white;
        }

        .timeline h2 {
            text-align: center;
            font-size: 3rem;
            color: var(--forest-green);
            margin-bottom: 3rem;
        }

        .timeline-items {
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline-item {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
            padding: 2rem;
            background: var(--cream);
            border-left: 4px solid var(--sage-green);
            border-radius: 14px;
        }

        .timeline-time {
            font-size: 2rem;
            color: var(--gold);
            min-width: 100px;
        }

        .timeline-content h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        /* Gift Section */
        .gift {
            padding: 5rem 0;
            text-align: center;
        }

        .gift h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .gift-box {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Footer */
        footer {
            background: var(--forest-green);
            color: white;
            text-align: center;
            padding: 3rem 0;
        }

        {{ '@' }}media (max-width: 768px) {
            .cover h1 {
                font-size: 2.5rem;
            }
            
            .timeline-item {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
@include('template.partials.preview-banner')
    <section class="cover" @if($coverSrc) style="background-image: linear-gradient(rgba(156, 175, 136, 0.92), rgba(45, 80, 22, 0.92)), url('{{ $coverSrc }}');background-size:cover;background-position:center" @endif>
        <div>
            @if($coverSrc)
            <img src="{{ $coverSrc }}" alt="foto sampul"
                 style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,.6);margin-bottom:1rem;box-shadow:0 4px 20px rgba(0,0,0,.2)">
            @endif
            <h1>{{ $femaleName }} &amp; {{ $maleName }}</h1>
            <div class="date">{{ \Carbon\Carbon::parse($weddingDate)->format('d . m . Y') }}</div>
            @if($other['guest'])<p style="font-size:.85rem;opacity:.8;margin-top:.5rem">Kepada: {{ $other['guest']['name'] ?? '' }}</p>@endif
        </div>
    </section>

    <section class="story">
        <div class="container">
            <h2>{{ $quoteContent ? 'Our Quote' : 'Our Story' }}</h2>
            <div class="story-content">
                <p>{{ $quoteContent ?: $coverBottom ?: 'Dengan penuh kebahagiaan kami mengundang kehadiran Anda.' }}</p>
            </div>
        </div>
    </section>

    @if(count($other['event'] ?? []) > 0)
    <section class="timeline">
        <div class="container">
            <h2>Event Timeline</h2>
            <div class="timeline-items">
                @foreach($other['event'] as $ev)
                @php $ep = json_decode($ev->content); @endphp
                @if($ep)
                <div class="timeline-item">
                    <div class="timeline-time">{{ date('H:i',strtotime($ep->time->start)) }}</div>
                    <div class="timeline-content">
                        <h3>{{ $ev->title }}</h3>
                        <p>{{ $weddingDateFormatted }}</p>
                        @if(!empty($ep->location->address??''))<p>{{ $ep->location->address }}</p>@endif
                        @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" style="color:var(--gold);font-size:.85rem">📍 Lihat Peta</a>@endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($showGift && $giftCode)
    <section class="gift">
        <div class="container">
            <h2>{{ $giftTitle }}</h2>
            <div class="gift-box">
                <p>{{ $giftContent }}</p>
                <p style="margin-top:1rem;font-weight:600">{{ strtoupper($giftBank) }}: {{ $giftCode }}<br>a.n. {{ $giftName }}</p>
                <button onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{this.textContent='✓ Tersalin!';setTimeout(()=>this.textContent='Salin',2000)})" style="margin-top:.8rem;padding:.5rem 1.2rem;background:var(--forest-green);color:#fff;border:none;border-radius:6px;cursor:pointer">Salin</button>
            </div>
        </div>
    </section>
    @endif

    @include('template.partials.details')

@include('template.partials.rsvp-wishes')

    <footer>
        <p>{{ $femaleNickname }} &amp; {{ $maleNickname }}</p>
        @if($showClosing && $closingText)<p style="font-size:.85rem;opacity:.8;margin-top:.3rem">{{ $closingText }}</p>@endif
        <p style="font-size:.7rem;opacity:.6;margin-top:.5rem">Risa Digital Invitation</p>
    </footer>
</body>
</html>
