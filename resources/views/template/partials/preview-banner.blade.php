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
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    <span><strong>Mode Preview</strong> - Undangan ini belum dipublikasikan. Hanya bisa diakses melalui link ini.</span>
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
        ">Publish Sekarang</a>
        @endif
    @endauth
</div>
<div style="height:36px"></div>
@endif

@if(isset($isTemplateReview) && $isTemplateReview)
<div style="
    position:fixed;
    top:12px;right:12px;
    z-index:99999;
    font-family:sans-serif;
    pointer-events:none;
">
    <div style="
        display:grid;
        gap:.35rem;
        min-width:160px;
        padding:.6rem .7rem;
        border:1px solid rgba(255,255,255,.25);
        border-radius:12px;
        background:rgba(0,0,0,.55);
        color:#fff;
        box-shadow:0 8px 24px rgba(0,0,0,.22);
        backdrop-filter:blur(6px);
        -webkit-backdrop-filter:blur(6px);
    ">
        <div style="font-size:.62rem;opacity:.9;letter-spacing:.6px;text-transform:uppercase;font-weight:700">Template Review</div>
        <div style="display:flex;align-items:center;gap:.45rem;font-size:.78rem;line-height:1.1">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex:0 0 auto" aria-hidden="true">
                <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M3 19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M7 14l2-2 3 3 3-4 2 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="9" cy="8" r="1.5" fill="currentColor"/>
            </svg>
            <span>Foto sampul</span>
        </div>
        <div style="display:flex;align-items:center;gap:.45rem;font-size:.78rem;line-height:1.1">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex:0 0 auto" aria-hidden="true">
                <path d="M16 11a4 4 0 1 0-8 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M19.5 8.5c.9-.9 2.5-.3 2.5 1 0 1.7-2.5 3.2-2.5 3.2S17 11.2 17 9.5c0-1.3 1.6-1.9 2.5-1z" fill="currentColor"/>
            </svg>
            <span>Foto pasangan</span>
        </div>
    </div>
</div>
@endif
