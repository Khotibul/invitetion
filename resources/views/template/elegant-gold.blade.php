<!DOCTYPE html>
<html lang="id">
<head>
    @php
        use Carbon\Carbon;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title ?? 'Wedding Invitation' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #d4af37;
            --secondary: #1a1a1a;
            --light: #f8f6f0;
            --white: #ffffff;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary);
            overflow-x: hidden;
            background: var(--light);
        }

        h1, h2, h3 {
            font-family: 'Great Vibes', cursive;
            color: var(--primary);
        }

        /* Cover Section */
        .cover {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--light) 0%, #fff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .cover h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .cover .date {
            font-size: 1.5rem;
            margin-top: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Section Generic */
        section {
            padding: 4rem 2rem;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        p {
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        /* Timeline */
        .timeline-item {
            margin-bottom: 2rem;
            padding: 2rem;
            background: var(--white);
            border: 1px solid var(--primary);
            border-radius: 8px;
        }

        .timeline-time {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        /* Footer */
        footer {
            background: var(--secondary);
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <section class="cover">
        <div>
            <p style="text-transform: uppercase; letter-spacing: 2px;">The Wedding Of</p>
            <h1>{{ $data->cover->name->male }} & {{ $data->cover->name->female }}</h1>
            <div class="date">{{ Carbon::parse($data->detail->calendar->date)->format('d F Y') }}</div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2>Our Quote</h2>
            <p>{{ $data->quote->content }}</p>
        </div>
    </section>

    <section>
        <div class="container">
            <h2>The Couple</h2>
            <div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                <div>
                    <h3>{{ $data->profile->name->male }}</h3>
                    <p>Son of Mr. {{ $data->profile->parent->male->father }} & Mrs. {{ $data->profile->parent->male->mother }}</p>
                </div>
                <div>
                    <h3>{{ $data->profile->name->female }}</h3>
                    <p>Daughter of Mr. {{ $data->profile->parent->female->father }} & Mrs. {{ $data->profile->parent->female->mother }}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2>Save The Date</h2>
            @foreach ($other['event'] as $item)
            @php $item->prop = json_decode($item->content); @endphp
            <div class="timeline-item">
                <h3>{{ $item->title }}</h3>
                <div class="timeline-time">{{ date('H:i', strtotime($item->prop->time->start)) }} - {{ ($item->prop->time->done===true) ? 'Until Finish' : date('H:i', strtotime($item->prop->time->end)) }}</div>
                <p>{{ $item->prop->location->address }}</p>
                <a href="{{ $item->prop->location->map }}" target="_blank" class="btn">View Map</a>
            </div>
            @endforeach
        </div>
    </section>

    @if ($data->gift->show)
    <section>
        <div class="container">
            <h2>Wedding Gift</h2>
            <p>{{ $data->gift->content }}</p>
            <div style="margin-top: 2rem; padding: 2rem; background: #fff; border: 1px solid #ddd;">
                <h3>{{ $data->gift->bank->option }}</h3>
                <p>No. Rek: {{ $data->gift->bank->code }}</p>
                <p>a.n {{ $data->gift->bank->name }}</p>
            </div>
        </div>
    </section>
    @endif

    <footer>
        <p>Created with love</p>
        <p>&copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>
