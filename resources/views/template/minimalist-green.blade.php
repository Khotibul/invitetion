<!DOCTYPE html>
<html lang="id">
<head>
    @php
        use Carbon\Carbon;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }} | Risa Digital Invitation</title>
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
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--cream);
            color: var(--forest-green);
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
            background: linear-gradient(rgba(156, 175, 136, 0.9), rgba(45, 80, 22, 0.9)),
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1200') center/cover;
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

        @media (max-width: 768px) {
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
    <section class="cover">
        <div>
            <h1>{{ $data->cover->name->male }} & {{ $data->cover->name->female }}</h1>
            <div class="date">{{ Carbon::parse($data->detail->calendar->date)->format('d . m . Y') }}</div>
        </div>
    </section>

    <section class="story">
        <div class="container">
            <h2>{{ $data->quote->show ? 'Our Quote' : 'Our Story' }}</h2>
            <div class="story-content">
                <p>{{ $data->quote->show ? $data->quote->content : $data->cover->description->bottom }}</p>
            </div>
        </div>
    </section>

    <section class="timeline">
        <div class="container">
            <h2>Event Timeline</h2>
            <div class="timeline-items">
                @foreach ($other['event'] as $item)
                @php $item->prop = json_decode($item->content); @endphp
                @if($item->prop)
                <div class="timeline-item">
                    <div class="timeline-time">{{ date('H:i', strtotime($item->prop->time->start)) }}</div>
                    <div class="timeline-content">
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->prop->location->address }}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    @if ($data->gift->show)
    <section class="gift">
        <div class="container">
            <h2>{{ $data->gift->title }}</h2>
            <div class="gift-box">
                <p>{{ $data->gift->content }}</p>
                <p style="margin-top: 1rem; font-weight: 600;">
                    {{ $data->gift->bank->option }}: {{ $data->gift->bank->code }}<br>
                    a.n. {{ $data->gift->bank->name }}
                </p>
            </div>
        </div>
    </section>
    @endif

    <footer>
        <p>Made with ❤️ by Risa Digital Invitation</p>
        <p>&copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>
