{{--
    Details Partial — tampilkan detail undangan:
    - Lokasi & peta
    - Amplop digital / rekening (hanya jika belum ditampilkan template)
    - Kisah cinta / story (hanya jika belum ditampilkan template)
    - Save to calendar

    Untuk mencegah duplikasi, set variabel sebelum include:
    @php $__detailsShownGift = true; $__detailsShownStory = true; @endphp
    @include('template.partials.details')
--}}
@php
    // Cek apakah template sudah menampilkan gift/story sendiri
    $__skipGift  = $__detailsShownGift  ?? false;
    $__skipStory = $__detailsShownStory ?? false;
@endphp

{{-- ── LOKASI ──────────────────────────────────────────────────────────────── --}}
@if(!empty($locationAddress) || !empty($locationMap))
<section id="location" style="
    padding:4rem 1.5rem;
    background:var(--section-bg,#fff);
    text-align:center;
">
    <h2 style="
        font-family:var(--font-heading,'serif');
        color:var(--color-primary,'#2d7a4f');
        font-size:clamp(1.6rem,4vw,2.4rem);
        margin-bottom:.5rem;
    ">Lokasi Acara</h2>
    <div style="width:50px;height:2px;background:var(--color-primary,'#2d7a4f');margin:.8rem auto 1.5rem;opacity:.4"></div>

    @if(!empty($locationAddress))
    <p style="
        color:var(--color-muted,'#555');
        font-size:.95rem;
        line-height:1.8;
        max-width:500px;
        margin:0 auto 1.2rem;
    ">
        <i class="fa-solid fa-location-dot" style="color:var(--color-primary,'#2d7a4f');margin-right:.4rem"></i>
        {{ $locationAddress }}
    </p>
    @endif

    @if(!empty($locationMap))
    {{-- Embed Google Maps iframe jika URL maps.google.com --}}
    @php
        $isGoogleMaps = str_contains($locationMap, 'google.com/maps') || str_contains($locationMap, 'goo.gl/maps');
        $embedUrl = null;
        if ($isGoogleMaps && str_contains($locationMap, 'place/')) {
            // Coba buat embed URL dari place URL
            $embedUrl = 'https://maps.google.com/maps?q=' . urlencode($locationAddress) . '&output=embed';
        } elseif ($isGoogleMaps && str_contains($locationMap, '@')) {
            // Koordinat langsung
            preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $locationMap, $coords);
            if (!empty($coords[1]) && !empty($coords[2])) {
                $embedUrl = "https://maps.google.com/maps?q={$coords[1]},{$coords[2]}&output=embed";
            }
        }
        if (!$embedUrl && !empty($locationAddress)) {
            $embedUrl = 'https://maps.google.com/maps?q=' . urlencode($locationAddress) . '&output=embed';
        }
    @endphp

    @if($embedUrl)
    <div style="
        max-width:700px;margin:0 auto 1.2rem;
        border-radius:12px;overflow:hidden;
        box-shadow:0 4px 20px rgba(0,0,0,.1);
    ">
        <iframe
            src="{{ $embedUrl }}"
            width="100%" height="300"
            style="border:0;display:block"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi Acara">
        </iframe>
    </div>
    @endif

    <a href="{{ $locationMap }}" target="_blank" rel="noopener" style="
        display:inline-flex;align-items:center;gap:.5rem;
        padding:.7rem 1.8rem;
        background:var(--color-primary,'#2d7a4f');
        color:#fff;
        border-radius:50px;
        font-size:.85rem;
        text-decoration:none;
        transition:opacity .3s;
    " onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        <i class="fa-solid fa-map-location-dot"></i>
        Buka di Google Maps
    </a>
    @endif

    {{-- Save to Calendar --}}
    @if(($data->detail->calendar->save->show ?? false) === true)
    <div style="margin-top:1rem">
        <a href="https://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd',strtotime($weddingDate)) }}T{{ str_replace(':','',substr($weddingTime,0,5)) }}00Z%2F{{ date('Ymd',strtotime($weddingDate.' +1 days')) }}T{{ str_replace(':','',substr($weddingTime,0,5)) }}00Z&text={{ urlencode('Pernikahan '.$femaleNickname.' & '.$maleNickname) }}&location={{ urlencode($locationAddress) }}"
           target="_blank" rel="noopener" style="
            display:inline-flex;align-items:center;gap:.5rem;
            padding:.6rem 1.5rem;
            border:1px solid var(--color-primary,'#2d7a4f');
            color:var(--color-primary,'#2d7a4f');
            border-radius:50px;
            font-size:.82rem;
            text-decoration:none;
            transition:all .3s;
        " onmouseover="this.style.background='var(--color-primary,#2d7a4f)';this.style.color='#fff'"
           onmouseout="this.style.background='transparent';this.style.color='var(--color-primary,#2d7a4f)'">
            <i class="fa-regular fa-calendar-plus"></i>
            {{ $data->detail->calendar->save->content ?? 'Simpan ke Kalender' }}
        </a>
    </div>
    @endif
</section>
@endif

{{-- ── KISAH CINTA (STORY) ─────────────────────────────────────────────────── --}}
@if(!$__skipStory && count($other['story'] ?? []) > 0)
<section id="story" style="
    padding:4rem 1.5rem;
    background:var(--card-bg,#f9f9f9);
    text-align:center;
">
    <h2 style="
        font-family:var(--font-heading,'serif');
        color:var(--color-primary,'#2d7a4f');
        font-size:clamp(1.6rem,4vw,2.4rem);
        margin-bottom:.5rem;
    ">Kisah Cinta Kami</h2>
    <div style="width:50px;height:2px;background:var(--color-primary,'#2d7a4f');margin:.8rem auto 2rem;opacity:.4"></div>

    <div style="max-width:680px;margin:0 auto;position:relative;padding-left:2rem;text-align:left">
        {{-- Garis timeline --}}
        <div style="
            position:absolute;left:8px;top:0;bottom:0;
            width:2px;
            background:linear-gradient(180deg,var(--color-primary,'#2d7a4f'),rgba(45,122,79,.1));
        "></div>

        @foreach($other['story'] as $st)
        <div style="position:relative;margin-bottom:2rem;padding-left:1.5rem">
            {{-- Dot --}}
            <div style="
                position:absolute;left:-1.9rem;top:.3rem;
                width:16px;height:16px;border-radius:50%;
                background:#fff;
                border:2px solid var(--color-primary,'#2d7a4f');
                box-shadow:0 0 0 4px rgba(45,122,79,.1);
            "></div>
            <p style="font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--color-primary,'#2d7a4f');margin-bottom:.3rem">
                {{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}
            </p>
            <h4 style="font-family:var(--font-heading,'serif');font-size:1.15rem;color:var(--color-muted,'#333');margin-bottom:.4rem">
                {{ $st->title }}
            </h4>
            <p style="font-size:.88rem;color:var(--color-muted,'#666');line-height:1.8">
                {{ $st->content }}
            </p>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── AMPLOP DIGITAL / REKENING ───────────────────────────────────────────── --}}
@if(!$__skipGift && ($showGift ?? false))
<section id="gift" style="
    padding:4rem 1.5rem;
    background:var(--section-bg,#fff);
    text-align:center;
">
    <h2 style="
        font-family:var(--font-heading,'serif');
        color:var(--color-primary,'#2d7a4f');
        font-size:clamp(1.6rem,4vw,2.4rem);
        margin-bottom:.5rem;
    ">{{ $giftTitle ?? 'Amplop Digital' }}</h2>
    <div style="width:50px;height:2px;background:var(--color-primary,'#2d7a4f');margin:.8rem auto 1rem;opacity:.4"></div>

    @if(!empty($giftContent ?? ''))
    <p style="color:var(--color-muted,'#666');font-size:.9rem;max-width:480px;margin:0 auto 1.5rem;line-height:1.7">
        {{ $giftContent }}
    </p>
    @endif

    @if(!empty($giftCode ?? ''))
    <div style="
        display:inline-block;max-width:400px;width:100%;
        background:var(--card-bg,'#f9f9f9');
        border:1px solid rgba(45,122,79,.2);
        border-top:3px solid var(--color-primary,'#2d7a4f');
        border-radius:12px;
        padding:2rem 1.5rem;
        box-shadow:0 4px 20px rgba(0,0,0,.06);
    ">
        <p style="font-size:.65rem;letter-spacing:4px;text-transform:uppercase;color:var(--color-primary,'#2d7a4f');margin-bottom:.5rem">
            {{ strtoupper($giftBank ?? 'Bank') }}
        </p>
        <p id="giftAccNum" style="
            font-family:var(--font-heading,'serif');
            font-size:1.9rem;
            color:var(--color-muted,'#222');
            margin:.3rem 0;
            letter-spacing:.05em;
        ">{{ $giftCode }}</p>
        <p style="font-size:.82rem;color:var(--color-muted,'#888');margin-bottom:1rem">
            a.n. {{ $giftName ?? '' }}
        </p>
        <button onclick="
            navigator.clipboard.writeText('{{ $giftCode }}').then(function(){
                var btn = document.getElementById('btnCopyGift');
                var orig = btn.innerHTML;
                btn.innerHTML = '<i class=\'fa-solid fa-check\'></i> Tersalin!';
                setTimeout(function(){ btn.innerHTML = orig; }, 2200);
            });
        " id="btnCopyGift" style="
            display:inline-flex;align-items:center;gap:.5rem;
            padding:.6rem 1.8rem;
            background:var(--color-primary,'#2d7a4f');
            color:#fff;border:none;border-radius:50px;
            font-size:.8rem;cursor:pointer;
            transition:opacity .3s;
        " onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
            <i class="fa-regular fa-copy"></i> Salin Nomor
        </button>
    </div>
    @endif
</section>
@endif
