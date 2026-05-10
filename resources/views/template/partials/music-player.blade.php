{{--
    Partial: music-player.blade.php
    Requires: $showMusic (bool), $musicUrl (full URL string)
    Usage: @include('template.partials.music-player')
    
    Renders a floating music button + audio element.
    Auto-plays when user clicks any "open invitation" button.
--}}
@if(!empty($showMusic ?? false) && !empty($musicUrl ?? ''))
<audio id="bgAudio" loop preload="none">
    <source src="{{ $musicUrl }}" type="audio/mpeg">
</audio>
<button id="musicFab" title="Musik Latar"
        style="position:fixed;bottom:80px;right:20px;z-index:9999;
               width:46px;height:46px;border-radius:50%;
               background:var(--color-primary,#2d7a4f);color:#fff;
               border:none;cursor:pointer;
               display:flex;align-items:center;justify-content:center;
               box-shadow:0 4px 14px rgba(0,0,0,.3);
               transition:transform .2s,opacity .2s;opacity:.9">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" id="icon-music">
        <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
        <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
        <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
    </svg>
</button>
<script>
(function () {
    var aud = document.getElementById('bgAudio');
    var fab = document.getElementById('musicFab');
    if (!aud || !fab) return;

    var iconMusic = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/><path fill-rule="evenodd" d="M9 3v10H8V3h1z"/><path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/></svg>';
    var iconPause = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"/></svg>';

    function playMusic() {
        aud.play().catch(function () {});
    }

    // Auto-play saat user klik tombol buka undangan (berbagai selector)
    var openSelectors = [
        '.cover-open', '.btn-open', '.open-invitation', '#open-invitation',
        '[data-open]', '.cover-btn', '.hero-cta', '.btn-cover-open',
        '.cover-button', '#btn-open', '.invitation-open'
    ];
    document.addEventListener('click', function (e) {
        var el = e.target;
        for (var i = 0; i < openSelectors.length; i++) {
            if (el.closest && el.closest(openSelectors[i])) {
                setTimeout(playMusic, 600);
                return;
            }
        }
    });

    // Toggle play/pause
    fab.addEventListener('click', function () {
        if (aud.paused) {
            playMusic();
        } else {
            aud.pause();
        }
    });

    aud.addEventListener('playing', function () {
        fab.innerHTML = iconPause;
        fab.style.opacity = '1';
    });
    aud.addEventListener('pause', function () {
        fab.innerHTML = iconMusic;
        fab.style.opacity = '.9';
    });
})();
</script>
@endif
