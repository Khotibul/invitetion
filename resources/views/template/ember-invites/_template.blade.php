@php
    /**
     * Shared layout for Ember Invites (color variants).
     *
     * Expected vars:
     * - $theme: array of CSS color strings
     * - $invitation, $data, $other (+ helpers from controller/partials.helpers)
     */
    $__slug = $invSlug
        ?? $invitation->slug
        ?? request()->route('slug')
        ?? request()->segment(1)
        ?? '';

    $__guestName = '';
    if (!empty($other['guest'])) {
        // PublicController menyimpan guest sebagai array hasil json_decode().
        if (is_array($other['guest'])) {
            if (isset($other['guest']['name'])) {
                $__guestName = (string) $other['guest']['name'];
            } else {
                $__guestName = trim(implode(' ', array_filter($other['guest'], fn ($v) => (string) $v !== '')));
            }
        } else {
            $__guestName = (string) $other['guest'];
        }
    }

    $theme = is_array($theme ?? null) ? $theme : [];
    $t = (object) array_merge([
        'ink'        => '#2a2420',
        'muted'      => '#6f6a66',
        'cream'      => '#fbf7f2',
        'cream2'     => '#f4efe8',
        'card'       => 'rgba(255,255,255,.86)',
        'border'     => 'rgba(42,36,32,.12)',
        'accent'     => '#c9a84c',
        'accentSoft' => '#ead8a7',
        'accent2'    => '#d9a5a5',
    ], $theme);

    $__tz = strtoupper((string) ($weddingTz ?? 'WIB'));
    $__offset = match ($__tz) {
        'WIT'  => '+09:00',
        'WITA' => '+08:00',
        default => '+07:00',
    };
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
    <meta name="theme-color" content="{{ $t->accent }}">
    <meta property="og:title" content="Wedding of {{ $femaleName }} &amp; {{ $maleName }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Great+Vibes&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        :root{
            --ink: {{ $t->ink }};
            --muted: {{ $t->muted }};
            --cream: {{ $t->cream }};
            --cream-2: {{ $t->cream2 }};
            --card: {{ $t->card }};
            --border: {{ $t->border }};
            --accent: {{ $t->accent }};
            --accent-soft: {{ $t->accentSoft }};
            --accent-2: {{ $t->accent2 }};
            --shadow-soft: 0 20px 60px -20px rgba(0,0,0,.18);
            --shadow-card: 0 14px 40px -16px rgba(0,0,0,.22);
            /* shared vars for template.partials.rsvp-wishes */
            --color-primary: var(--accent);
            --color-muted: rgba(42,36,32,.55);
            --section-bg: var(--cream);
            --card-bg: rgba(255,255,255,.9);
            --rsvp-bg: var(--cream-2);
            --font-heading: 'Cormorant Garamond', serif;
        }
        body{
            font-family:'Inter',system-ui,sans-serif;
            color:var(--ink);
            background:linear-gradient(180deg,var(--cream) 0%, var(--cream-2) 100%);
            overflow-x:hidden;
        }
        h1,h2,h3,h4{font-family:'Cormorant Garamond',serif;font-weight:500}
        .script{font-family:'Great Vibes',cursive}
        a{color:inherit}

        /* shimmer accent text */
        .text-accent{
            background:linear-gradient(135deg, var(--accent) 0%, var(--accent-soft) 45%, var(--accent) 100%);
            background-size:200% auto;
            -webkit-background-clip:text;background-clip:text;color:transparent;
            animation:shimmer 3s linear infinite;
        }
        @keyframes shimmer{0%{background-position:-200% center}100%{background-position:200% center}}

        /* cover overlay */
        #cover{
            position:fixed;inset:0;z-index:9999;
            display:flex;align-items:center;justify-content:center;
            padding:2rem;text-align:center;
            background:linear-gradient(180deg,var(--cream) 0%, var(--cream-2) 100%);
            transition:opacity .8s ease, visibility .8s ease;
        }
        #cover.hidden{opacity:0;visibility:hidden;pointer-events:none}
        .cover-card{
            width:min(560px, 100%);
            border:1px solid var(--border);
            background:var(--card);
            border-radius:24px;
            padding:2.2rem 2rem;
            box-shadow:var(--shadow-card);
            position:relative;
            overflow:hidden;
            backdrop-filter: blur(10px);
        }
        .cover-card:before{
            content:'';
            position:absolute;inset:-60px;
            background:radial-gradient(circle at top, rgba(201,168,76,.18), transparent 55%);
            pointer-events:none;
        }
        .cover-eyebrow{font-size:.72rem;letter-spacing:.42em;text-transform:uppercase;color:var(--muted);margin-bottom:.6rem}
        .cover-photo{
            width:120px;height:120px;border-radius:999px;
            margin:0 auto 1rem;
            border:2px solid color-mix(in oklab, var(--accent) 45%, transparent);
            overflow:hidden;background:rgba(255,255,255,.45);
            box-shadow:var(--shadow-soft);
        }
        .cover-photo img{width:100%;height:100%;object-fit:cover}
        .cover-names{font-size:clamp(2.4rem,7vw,4.8rem);line-height:1.0;margin-bottom:.35rem}
        .cover-date{
            display:inline-flex;align-items:center;gap:.55rem;
            border:1px solid rgba(0,0,0,.08);
            background:rgba(255,255,255,.55);
            padding:.55rem 1rem;border-radius:999px;
            font-size:.82rem;color:var(--muted);
            margin:1rem 0 .9rem;
        }
        .cover-guest{margin-top:.7rem;font-size:.9rem;color:var(--muted)}
        .cover-guest strong{display:block;color:var(--ink);margin-top:.15rem}
        .btn-open{
            display:inline-flex;align-items:center;justify-content:center;gap:.6rem;
            margin-top:1.25rem;
            background:var(--ink);
            color:#fff;
            padding:.95rem 2.2rem;
            border:none;border-radius:999px;
            cursor:pointer;
            letter-spacing:.25em;text-transform:uppercase;
            font-size:.75rem;
            transition:transform .25s ease, opacity .25s ease;
            box-shadow:var(--shadow-soft);
        }
        .btn-open:hover{transform:translateY(-2px);opacity:.92}

        /* main */
        #main{display:none}
        #main.visible{display:block}
        section{padding:4.5rem 1.5rem}
        .wrap{max-width:1080px;margin:0 auto}
        .sec-eyebrow{font-size:.68rem;letter-spacing:.42em;text-transform:uppercase;color:var(--muted);margin-bottom:.6rem}
        .sec-title{font-size:clamp(1.8rem,4vw,2.8rem);margin-bottom:.6rem}
        .divider{
            width:72px;height:2px;margin:1.1rem auto 0;
            background:linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        /* hero */
        .hero{min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;position:relative}
        .hero-inner{max-width:760px}
        .hero-names{font-size:clamp(3rem,10vw,6.5rem);line-height:1}
        .hero-quote{margin-top:1.3rem;color:var(--muted);font-style:italic}
        .scroll-hint{
            position:absolute;left:50%;bottom:1.6rem;transform:translateX(-50%);
            font-size:.68rem;letter-spacing:.28em;text-transform:uppercase;color:var(--muted);
            display:flex;flex-direction:column;align-items:center;gap:.3rem;
            animation:bounce 2s infinite;
        }
        @keyframes bounce{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(6px)}}

        /* cards */
        .grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.2rem}
        @media(max-width:820px){.grid-2{grid-template-columns:1fr}}
        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:22px;
            padding:1.8rem 1.5rem;
            box-shadow:var(--shadow-card);
            backdrop-filter: blur(10px);
        }

        /* couple */
        .couple-card{text-align:center}
        .avatar{
            position:relative;
            width:128px;height:128px;border-radius:999px;margin:0 auto 1rem;
            border:2px solid color-mix(in oklab, var(--accent) 45%, transparent);
            overflow:hidden;background:rgba(255,255,255,.45);
            display:flex;align-items:center;justify-content:center;
        }
        .avatar img{width:100%;height:100%;object-fit:cover}
        .avatar .frame{
            position:absolute;
            inset:-8px;
            width:calc(100% + 16px);
            height:calc(100% + 16px);
            pointer-events:none;
            object-fit:contain;
        }
        .avatar .initial{font-size:4rem}
        .couple-name{font-size:2.2rem;line-height:1.05;margin-bottom:.25rem}
        .couple-role{font-size:.68rem;letter-spacing:.32em;text-transform:uppercase;color:var(--muted)}
        .couple-parent{margin-top:.75rem;color:var(--muted);font-size:.95rem;line-height:1.7}
        .ig{margin-top:.65rem;font-size:.9rem}
        .ig a{text-decoration:none;color:var(--muted)}
        .ig a:hover{color:var(--ink)}

        /* event */
        .event-card h3{font-size:1.6rem;margin-bottom:.6rem}
        .meta{display:grid;gap:.4rem;color:var(--muted);font-size:.95rem}
        .meta i{width:18px;color:var(--accent)}
        .meta a{color:var(--accent);text-decoration:none;border-bottom:1px solid color-mix(in oklab, var(--accent) 35%, transparent)}

        /* countdown */
        .count-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:.9rem;max-width:760px;margin:1.2rem auto 0}
        @media(max-width:600px){.count-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        .count-item{padding:1.1rem;border-radius:18px;background:rgba(255,255,255,.55);border:1px solid var(--border)}
        .count-num{display:block;font-size:2.2rem;font-weight:600}
        .count-label{font-size:.7rem;letter-spacing:.28em;text-transform:uppercase;color:var(--muted)}

        /* gallery */
        .gallery{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:.6rem;margin-top:1.4rem}
        @media(max-width:860px){.gallery{grid-template-columns:repeat(2,minmax(0,1fr))}}
        .g-item{aspect-ratio:1/1;border-radius:18px;overflow:hidden;border:1px solid var(--border);background:rgba(255,255,255,.5)}
        .g-item.wide{grid-column:span 2;aspect-ratio:2/1}
        @media(max-width:860px){.g-item.wide{grid-column:span 2;aspect-ratio:2/1}}
        .g-item img{width:100%;height:100%;object-fit:cover;transition:transform .7s ease}
        .g-item:hover img{transform:scale(1.06)}

        /* embeds */
        .embed{position:relative;width:100%;padding-top:56.25%;border-radius:18px;overflow:hidden;border:1px solid var(--border);background:rgba(255,255,255,.5)}
        .embed iframe{position:absolute;inset:0;width:100%;height:100%;border:0}

        /* gift */
        .gift-box{display:grid;gap:.6rem;margin-top:1rem}
        .gift-line{display:flex;justify-content:space-between;gap:1rem;color:var(--muted);font-size:.95rem}
        .btn-copy{
            display:inline-flex;align-items:center;gap:.5rem;
            margin-top:.9rem;padding:.75rem 1.1rem;
            border-radius:999px;border:1px solid var(--border);
            background:rgba(255,255,255,.65);cursor:pointer;
        }
        .list-clean{list-style:none;padding:0;margin:1rem 0 0;display:grid;gap:.3rem;color:var(--muted)}

        /* protocol */
        .protocol{display:grid;grid-template-columns:repeat(auto-fit,minmax(110px,1fr));gap:1rem;margin-top:1.6rem}
        .protocol img{width:100%;height:auto;border-radius:16px;border:1px solid var(--border);background:#fff}

        /* floating music */
        .music-fab{
            position:fixed;right:18px;bottom:18px;z-index:9998;
            width:54px;height:54px;border-radius:999px;
            background:var(--ink);color:#fff;border:none;cursor:pointer;
            display:flex;align-items:center;justify-content:center;
            box-shadow:var(--shadow-soft);
            transition:transform .25s ease, opacity .25s ease;
        }
        .music-fab:hover{transform:scale(1.06);opacity:.95}
        .music-fab.playing{outline:3px solid rgba(255,255,255,.45);outline-offset:3px}

        /* small footer */
        footer{padding:3.2rem 1.5rem;text-align:center;color:var(--muted);font-size:.9rem}
        footer b{color:var(--ink)}
    </style>
</head>
<body>
    @include('template.partials.preview-banner')

    {{-- COVER OVERLAY --}}
    <section id="cover" aria-label="Cover">
        <div class="cover-card">
            <p class="cover-eyebrow">{{ $coverTop ?: 'The Wedding Of' }}</p>
            @if(!empty($coverSrc))
                <div class="cover-photo">
                    <img src="{{ $coverSrc }}" alt="Cover">
                </div>
            @endif
            <h1 class="cover-names script text-accent">{{ $femaleNickname }} <span style="color:var(--muted)">&amp;</span> {{ $maleNickname }}</h1>
            <div class="cover-date">
                <i class="fa-regular fa-calendar" style="color:var(--accent)"></i>
                <span>{{ $weddingDateShort }}</span>
            </div>
            @if($__guestName)
                <div class="cover-guest">
                    Kepada Yth.
                    <strong>{{ $__guestName }}</strong>
                </div>
            @endif
            <button type="button" class="btn-open" id="btnOpen">
                <i class="fa-solid fa-envelope-open-text"></i>
                {{ $coverButton }}
            </button>
            @if($coverBottom)
                <p style="margin-top:1.2rem;color:var(--muted);font-size:.9rem">{{ $coverBottom }}</p>
            @endif
        </div>
    </section>

    <div id="main">
        {{-- MUSIC --}}
        @if(($showMusic ?? false) && !empty($musicUrl))
            <audio id="bgMusic" loop>
                <source src="{{ $musicUrl }}" type="audio/mpeg">
            </audio>
            <button class="music-fab" id="musicBtn" title="Musik" type="button">
                <i class="fa-solid fa-music"></i>
            </button>
        @endif

        {{-- HERO --}}
        <section class="hero" id="hero">
            <div class="wrap hero-inner">
                <p class="sec-eyebrow">Bismillahirrahmanirrahim</p>
                <h1 class="hero-names script text-accent">{{ $femaleNickname }} <span style="color:var(--muted)">&amp;</span> {{ $maleNickname }}</h1>
                <p class="sec-eyebrow" style="margin-top:1.1rem">{{ $weddingDateFormatted }}</p>
                @if(!empty($quoteContent))
                    <p class="hero-quote">"{{ $quoteContent }}"</p>
                @endif
                <div class="scroll-hint">
                    <span>Scroll</span>
                    <i class="fa-solid fa-chevron-down" style="color:var(--accent)"></i>
                </div>
            </div>
        </section>

        {{-- COUPLE --}}
        <section id="couple">
            <div class="wrap">
                <div style="text-align:center">
                    <p class="sec-eyebrow">The Bride &amp; Groom</p>
                    <h2 class="sec-title">Mempelai</h2>
                    <div class="divider"></div>
                </div>

                <div class="grid-2" style="margin-top:2.2rem">
                    <div class="card couple-card">
                        <div class="avatar">
                            @if(!empty($femaleSrc))
                                <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}">
                                @if(!empty($femaleFrame))
                                    <img class="frame" src="{{ url('storage/frame/'.$femaleFrame) }}" alt="">
                                @endif
                            @else
                                <span class="script text-accent initial">{{ $femaleInitial }}</span>
                            @endif
                        </div>
                        <h3 class="couple-name script">{{ $femaleName }}</h3>
                        <p class="couple-role">Mempelai Wanita</p>
                        @if(($showParent ?? false) === true)
                            <p class="couple-parent">
                                Putri ke-{{ $femaleChildhood }} dari<br>
                                Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}
                            </p>
                        @endif
                        @if(($showIg ?? false) === true && !empty($femaleIg))
                            <div class="ig">
                                <a href="https://instagram.com/{{ $femaleIg }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card couple-card">
                        <div class="avatar">
                            @if(!empty($maleSrc))
                                <img src="{{ $maleSrc }}" alt="{{ $maleName }}">
                                @if(!empty($maleFrame))
                                    <img class="frame" src="{{ url('storage/frame/'.$maleFrame) }}" alt="">
                                @endif
                            @else
                                <span class="script text-accent initial">{{ $maleInitial }}</span>
                            @endif
                        </div>
                        <h3 class="couple-name script">{{ $maleName }}</h3>
                        <p class="couple-role">Mempelai Pria</p>
                        @if(($showParent ?? false) === true)
                            <p class="couple-parent">
                                Putra ke-{{ $maleChildhood }} dari<br>
                                Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}
                            </p>
                        @endif
                        @if(($showIg ?? false) === true && !empty($maleIg))
                            <div class="ig">
                                <a href="https://instagram.com/{{ $maleIg }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-instagram"></i> @{{ $maleIg }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- COUNTDOWN --}}
        @if(($showCountdown ?? true) === true)
        <section id="countdown">
            <div class="wrap" style="text-align:center">
                <p class="sec-eyebrow">Save The Date</p>
                <h2 class="sec-title">Menuju Hari Bahagia</h2>
                <div class="divider"></div>
                <div class="count-grid" id="countGrid" aria-label="Countdown">
                    <div class="count-item"><span class="count-num" id="cdDays">0</span><span class="count-label">Hari</span></div>
                    <div class="count-item"><span class="count-num" id="cdHours">0</span><span class="count-label">Jam</span></div>
                    <div class="count-item"><span class="count-num" id="cdMinutes">0</span><span class="count-label">Menit</span></div>
                    <div class="count-item"><span class="count-num" id="cdSeconds">0</span><span class="count-label">Detik</span></div>
                </div>
                @if(($data->detail->calendar->save->show ?? false) === true)
                    <div style="margin-top:1.6rem">
                        <a href="https://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd', strtotime($weddingDate)) }}T090000Z%2F{{ date('Ymd', strtotime($weddingDate.' +1 days')) }}T090000Z&text=Wedding+{{ urlencode($femaleName).'+'.$maleName }}&location={{ urlencode($locationAddress) }}"
                           target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;gap:.5rem;padding:.7rem 1.2rem;border-radius:999px;border:1px solid var(--border);text-decoration:none;background:rgba(255,255,255,.6)">
                            <i class="fa-regular fa-calendar-plus" style="color:var(--accent)"></i>
                            <span>{{ $data->detail->calendar->save->content ?? 'Simpan Tanggal' }}</span>
                        </a>
                    </div>
                @endif
            </div>
        </section>
        @endif

        {{-- EVENTS --}}
        @if(count($other['event'] ?? []) > 0)
        <section id="events" style="background:rgba(255,255,255,.35)">
            <div class="wrap">
                <div style="text-align:center">
                    <p class="sec-eyebrow">Wedding Events</p>
                    <h2 class="sec-title">Acara</h2>
                    <div class="divider"></div>
                </div>
                <div class="grid-2" style="margin-top:2rem">
                    @foreach(($other['event'] ?? []) as $ev)
                        @php $evProp = json_decode($ev->content); @endphp
                        @if($evProp)
                        <div class="card event-card">
                            <h3 class="text-accent">{{ $ev->title }}</h3>
                            <div class="meta">
                                <div><i class="fa-regular fa-calendar"></i>{{ $weddingDateFormatted }}</div>
                                <div>
                                    <i class="fa-regular fa-clock"></i>
                                    {{ date('H:i', strtotime($evProp->time->start ?? '00:00')) }}
                                    @if(!($evProp->time->done ?? false))
                                        – {{ date('H:i', strtotime($evProp->time->end ?? '00:00')) }}
                                    @endif
                                    {{ $weddingTz }}
                                </div>
                                @if(!empty($evProp->location->address ?? ''))
                                    <div><i class="fa-solid fa-location-dot"></i>{{ $evProp->location->address }}</div>
                                @endif
                                @if(!empty($evProp->location->map ?? ''))
                                    <div><i class="fa-solid fa-map"></i><a href="{{ $evProp->location->map }}" target="_blank" rel="noopener">Lihat Peta</a></div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- LOCATION (fallback saat event kosong / lokasi umum) --}}
        @if(!empty($locationAddress) || !empty($locationMap))
        <section id="location">
            <div class="wrap" style="text-align:center;max-width:920px">
                <p class="sec-eyebrow">Location</p>
                <h2 class="sec-title">Lokasi</h2>
                <div class="divider"></div>
                <div class="card" style="margin-top:1.8rem;text-align:left">
                    @if(!empty($locationAddress))
                        <div class="meta" style="margin-bottom:.6rem">
                            <div><i class="fa-solid fa-location-dot"></i>{{ $locationAddress }}</div>
                        </div>
                    @endif
                    @if(!empty($locationMap))
                        <a href="{{ $locationMap }}" target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;gap:.5rem;padding:.7rem 1.1rem;border-radius:999px;border:1px solid var(--border);text-decoration:none;background:rgba(255,255,255,.6)">
                            <i class="fa-solid fa-map" style="color:var(--accent)"></i>
                            <span>Lihat Peta</span>
                        </a>
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- STORY --}}
        @if(count($other['story'] ?? []) > 0)
        <section id="story">
            <div class="wrap">
                <div style="text-align:center">
                    <p class="sec-eyebrow">Our Story</p>
                    <h2 class="sec-title">Kisah Cinta</h2>
                    <div class="divider"></div>
                </div>
                <div style="display:grid;gap:1rem;max-width:820px;margin:2rem auto 0">
                    @foreach(($other['story'] ?? []) as $st)
                        <div class="card">
                            <div style="color:var(--muted);font-size:.9rem;margin-bottom:.3rem">
                                <i class="fa-regular fa-calendar" style="color:var(--accent);margin-right:.4rem"></i>
                                {{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}
                            </div>
                            <h3 style="font-size:1.5rem;margin-bottom:.25rem">{{ $st->title }}</h3>
                            <p style="color:var(--muted);line-height:1.8">{{ $st->content }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- VIDEO --}}
        @if(!empty($other['video']))
        <section id="video" style="background:rgba(255,255,255,.35)">
            <div class="wrap" style="text-align:center">
                <p class="sec-eyebrow">Video</p>
                <h2 class="sec-title">{{ $other['video']->title ?? 'Video' }}</h2>
                <div class="divider"></div>
                @if(!empty($other['video']->prop->content ?? ''))
                    <p style="max-width:780px;margin:1.2rem auto 0;color:var(--muted)">{{ $other['video']->prop->content }}</p>
                @endif
                @if(!empty($other['video']->prop->url ?? ''))
                    <div style="max-width:920px;margin:1.6rem auto 0">
                        <div class="embed">
                            <iframe src="https://www.youtube.com/embed/{{ $other['video']->prop->url }}" title="Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        @endif

        {{-- GALLERY --}}
        <section id="gallery">
            <div class="wrap" style="text-align:center">
                <p class="sec-eyebrow">Captured Moments</p>
                <h2 class="sec-title">{{ $galleryTitle ?? 'Galeri' }}</h2>
                <div class="divider"></div>
                @if(!empty($galleryFiles))
                    <div class="gallery">
                        @foreach($galleryFiles as $i => $gf)
                            <div class="g-item @if($i===0) wide @endif">
                                <img src="{{ url('storage/'.$gf) }}" alt="gallery {{ $i+1 }}" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="margin-top:1.8rem;color:var(--muted)">Belum ada foto galeri.</div>
                @endif
            </div>
        </section>

        {{-- GIFT --}}
        @if(($showGift ?? false) === true)
        <section id="gift" style="background:rgba(255,255,255,.35)">
            <div class="wrap" style="text-align:center;max-width:820px">
                <p class="sec-eyebrow">Gift</p>
                <h2 class="sec-title">{{ $giftTitle }}</h2>
                <div class="divider"></div>
                @if(!empty($giftContent))
                    <p style="margin-top:1rem;color:var(--muted)">{{ $giftContent }}</p>
                @endif
                <div class="card" style="margin-top:1.8rem;text-align:left">
                    <div class="gift-box">
                        <div class="gift-line"><span>Bank</span><b>{{ strtoupper($giftBank) }}</b></div>
                        <div class="gift-line"><span>Nama</span><b>{{ $giftName }}</b></div>
                        <div class="gift-line"><span>No. Rekening</span><b id="giftCode">{{ $giftCode }}</b></div>
                        <button type="button" class="btn-copy" id="btnCopyGift">
                            <i class="fa-regular fa-copy" style="color:var(--accent)"></i>
                            Salin nomor rekening
                        </button>
                        <div id="giftCopied" style="display:none;margin-top:.6rem;color:var(--muted);font-size:.9rem">Tersalin.</div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- RSVP + WISHES --}}
        @include('template.partials.rsvp-wishes')

        {{-- LIVE STREAMING --}}
        @if(($showLive ?? false) === true && !empty($liveLink))
        <section id="live">
            <div class="wrap" style="text-align:center;max-width:820px">
                <p class="sec-eyebrow">Live Streaming</p>
                <h2 class="sec-title">Siaran Langsung</h2>
                <div class="divider"></div>
                @if(!empty($liveContent))
                    <p style="margin-top:1rem;color:var(--muted)">{{ $liveContent }}</p>
                @endif
                <div style="margin-top:1.6rem">
                    <a href="{{ $liveLink }}" target="_blank" rel="noopener"
                       style="display:inline-flex;align-items:center;gap:.6rem;padding:.9rem 1.4rem;border-radius:999px;background:var(--ink);color:#fff;text-decoration:none;letter-spacing:.18em;text-transform:uppercase;font-size:.75rem">
                        <i class="fa-solid fa-video"></i>
                        Ikuti Livestream
                    </a>
                </div>
            </div>
        </section>
        @endif

        {{-- PROTOCOL --}}
        @if(($showProtocol ?? false) === true && !empty($other['protocol']))
        <section id="protocol" style="background:rgba(255,255,255,.35)">
            <div class="wrap" style="text-align:center">
                <p class="sec-eyebrow">{{ $protocolContent ?: 'Protokol' }}</p>
                <h2 class="sec-title">{{ $protocolTitle ?: 'Protokol Kesehatan' }}</h2>
                <div class="divider"></div>
                <div class="protocol">
                    @foreach((array) json_decode($other['protocol']->content ?? '[]') as $item)
                        <div>
                            <img src="{{ url('storage/protocol/'.$item) }}" alt="protocol">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- CLOSING --}}
        @if(($showClosing ?? false) === true && !empty($closingText))
        <section id="closing">
            <div class="wrap" style="text-align:center;max-width:860px">
                <p class="sec-eyebrow">Wassalamu'alaikum Wr. Wb.</p>
                <h2 class="sec-title">Terima Kasih</h2>
                <div class="divider"></div>
                <p style="margin-top:1.2rem;color:var(--muted);line-height:1.85">{{ $closingText }}</p>
                @if(!empty($data->detail->additional->special ?? []))
                    <div style="margin-top:1.6rem">
                        <p class="sec-eyebrow" style="margin-bottom:.3rem">Turut Mengundang</p>
                        <ul class="list-clean">
                            @foreach(($data->detail->additional->special ?? []) as $sp)
                                <li>{{ $sp }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="script text-accent" style="margin-top:1.8rem;font-size:2.3rem">{{ $femaleNickname }} &amp; {{ $maleNickname }}</p>
            </div>
        </section>
        @endif

        <footer>
            <small>Made with</small><br>
            <b>Risa Digital Invitation</b>
        </footer>
    </div>

    <script>
        (function(){
            var cover = document.getElementById('cover');
            var main  = document.getElementById('main');
            var btn   = document.getElementById('btnOpen');
            var music = document.getElementById('bgMusic');
            var musicBtn = document.getElementById('musicBtn');
            var isPlaying = false;

            function openInvite(){
                cover.classList.add('hidden');
                main.classList.add('visible');
                document.body.style.overflow = 'auto';
                window.scrollTo({top:0, behavior:'instant'});
                if (music && !isPlaying) {
                    music.play().then(function(){
                        isPlaying = true;
                        if (musicBtn) { musicBtn.classList.add('playing'); musicBtn.innerHTML = '<i class=\"fa-solid fa-pause\"></i>'; }
                    }).catch(function(){});
                }
            }

            document.body.style.overflow = 'hidden';
            if (btn) btn.addEventListener('click', openInvite);

            if (music && musicBtn) {
                musicBtn.addEventListener('click', function(){
                    if (!isPlaying) {
                        music.play().then(function(){
                            isPlaying = true;
                            musicBtn.classList.add('playing');
                            musicBtn.innerHTML = '<i class=\"fa-solid fa-pause\"></i>';
                        }).catch(function(){});
                    } else {
                        music.pause();
                        isPlaying = false;
                        musicBtn.classList.remove('playing');
                        musicBtn.innerHTML = '<i class=\"fa-solid fa-music\"></i>';
                    }
                });
            }

            // Countdown
            var target = new Date("{{ $weddingDate }}T{{ $weddingTime }}{{ $__offset }}").getTime();
            function tick(){
                var now = Date.now();
                var d = Math.max(0, target - now);
                var s = Math.floor(d / 1000);
                var days = Math.floor(s / 86400); s -= days*86400;
                var hours = Math.floor(s / 3600); s -= hours*3600;
                var mins = Math.floor(s / 60); s -= mins*60;
                var secs = s;
                var el;
                el=document.getElementById('cdDays'); if(el) el.textContent=days;
                el=document.getElementById('cdHours'); if(el) el.textContent=String(hours).padStart(2,'0');
                el=document.getElementById('cdMinutes'); if(el) el.textContent=String(mins).padStart(2,'0');
                el=document.getElementById('cdSeconds'); if(el) el.textContent=String(secs).padStart(2,'0');
            }
            tick();
            setInterval(tick, 1000);

            // Gift copy
            var btnCopy = document.getElementById('btnCopyGift');
            if (btnCopy) {
                btnCopy.addEventListener('click', function(){
                    var codeEl = document.getElementById('giftCode');
                    var copied = document.getElementById('giftCopied');
                    var val = (codeEl ? (codeEl.textContent || '').trim() : '');
                    if (!val) return;
                    navigator.clipboard.writeText(val).then(function(){
                        if (copied) { copied.style.display='block'; setTimeout(function(){copied.style.display='none';}, 1800); }
                    }).catch(function(){});
                });
            }
        })();
    </script>
</body>
</html>
