{{-- Banner preview — tampil saat undangan belum dipublish --}}
@if(isset($isPreview) && $isPreview)
<div style="
    position:fixed;
    top:0;left:0;right:0;
    z-index:99999;
    background:linear-gradient(90deg,#f59e0b,#d97706);
    color:#fff;
    text-align:center;
    padding:.5rem 1rem;
    font-size:.8rem;
    font-family:sans-serif;
    letter-spacing:.5px;
    box-shadow:0 2px 8px rgba(0,0,0,.2);
    display:flex;align-items:center;justify-content:center;gap:.5rem;
">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    <span><strong>Mode Preview</strong> — Undangan ini belum dipublikasikan. Hanya bisa diakses melalui link ini.</span>
    @auth
        @if(auth()->id() === (int)($invitation->user_id ?? 0))
        <a href="{{ route('menu.einvitation') }}" style="
            margin-left:.5rem;
            padding:.2rem .8rem;
            background:rgba(255,255,255,.25);
            border-radius:50px;
            color:#fff;
            text-decoration:none;
            font-size:.75rem;
            border:1px solid rgba(255,255,255,.4);
        ">Publish Sekarang →</a>
        @endif
    @endauth
</div>
<div style="height:36px"></div>
@endif
