{{--
    Partial: font-vars.blade.php
    Include tepat sebelum </head> di setiap template.
    Menerapkan font & ukuran dari preset member ke semua template.
--}}
@php
    $_fTitleFont   = $data->design->title->font    ?? null;
    $_fContentFont = $data->design->content->font  ?? null;
    $_fScriptFont  = $data->design->script->font   ?? null;
    $_fTitleSize   = (int)($data->design->title->size   ?? 0);
    $_fContentSize = (int)($data->design->content->size ?? 0);
    $_fScriptSize  = (int)($data->design->script->size  ?? 0);
    $_fTitleColor  = $data->design->title->color   ?? null;
    $_fContentColor= $data->design->content->color ?? null;

    $_bgColor      = $data->design->background ?? null;
    $_bgModel      = $data->design->background_model ?? 'solid';
    $_bgColor2     = $data->design->background2 ?? $_bgColor;

    // Selalu load Google Font yang dipilih member (kecuali font sistem umum).
    // Ini memastikan semua template (yang mungkin punya set font bawaan berbeda)
    // tetap bisa memakai font custom tanpa tergantung font yang sudah di-load template.
    $_systemFonts = [
        'Arial','Helvetica','Times New Roman','Times','Georgia','Verdana','Tahoma',
        'serif','sans-serif','system-ui','ui-sans-serif','ui-serif','monospace',
    ];
    $_needLoadTitle   = $_fTitleFont   && !in_array($_fTitleFont,   $_systemFonts, true);
    $_needLoadContent = $_fContentFont && !in_array($_fContentFont, $_systemFonts, true);
    $_needLoadScript  = $_fScriptFont  && !in_array($_fScriptFont,  $_systemFonts, true);

    // Bangun CSS variables sebagai string PHP (hindari @if di dalam <style>)
    $_rootVars = '';
    if ($_fTitleFont)    $_rootVars .= "--inv-title-font:'$_fTitleFont',serif;";
    if ($_fContentFont)  $_rootVars .= "--inv-content-font:'$_fContentFont',sans-serif;";
    if ($_fScriptFont)   $_rootVars .= "--inv-script-font:'$_fScriptFont',cursive;";
    if ($_fTitleSize   > 0) $_rootVars .= "--inv-title-size:{$_fTitleSize}px;";
    if ($_fContentSize > 0) $_rootVars .= "--inv-content-size:{$_fContentSize}px;";
    if ($_fScriptSize  > 0) $_rootVars .= "--inv-script-size:{$_fScriptSize}px;";
    if ($_fTitleColor)   $_rootVars .= "--inv-title-color:$_fTitleColor;";
    if ($_fContentColor) $_rootVars .= "--inv-content-color:$_fContentColor;";

    if ($_bgColor)  $_rootVars .= "--inv-bg-color:$_bgColor;";
    if ($_bgColor2) $_rootVars .= "--inv-bg-color-2:$_bgColor2;";
    if ($_bgModel)  $_rootVars .= "--inv-bg-model:$_bgModel;";

    // Map ke variable yang dipakai beberapa template modern (ember-invites, partials, dll)
    if ($_fTitleFont) {
        $_rootVars .= "--font-heading:var(--inv-title-font);";
        $_rootVars .= "--font-display:var(--inv-title-font);";
    }
    if ($_fContentFont) {
        $_rootVars .= "--font-body:var(--inv-content-font);";
    }
@endphp

@if($_needLoadTitle)
<link href="https://fonts.googleapis.com/css2?family={{ urlencode($_fTitleFont) }}&display=swap" rel="stylesheet">
@endif
@if($_needLoadContent && $_fContentFont !== $_fTitleFont)
<link href="https://fonts.googleapis.com/css2?family={{ urlencode($_fContentFont) }}&display=swap" rel="stylesheet">
@endif
@if($_needLoadScript && $_fScriptFont !== $_fTitleFont && $_fScriptFont !== $_fContentFont)
<link href="https://fonts.googleapis.com/css2?family={{ urlencode($_fScriptFont) }}&display=swap" rel="stylesheet">
@endif

@if($_rootVars)
<style>
:root { {{ $_rootVars }} }
@if($_fTitleFont)
h1,h2,h3,h4,h5,h6,.cover-names,.couple-names,.hero h1,.hero-logo,
.cover-fill h1,.banner-fill h1,.cover-inner h1,
.desc-groom h3,.desc-bride h3,.couple-card h3,.footer-names,
[data-cover="name-male"],[data-cover="name-female"]{font-family:var(--inv-title-font)!important;}
@endif
@if($_fContentFont)
body{font-family:var(--inv-content-font)!important;}
@endif
@if($_fScriptFont)
.script,.font-script{font-family:var(--inv-script-font)!important;}
@endif
@if($_fScriptSize > 0)
.script{font-size:var(--inv-script-size)!important;}
@endif
@if($_fTitleSize > 0)
h1{font-size:var(--inv-title-size)!important;}
h2{font-size:calc(var(--inv-title-size) * 0.8)!important;}
h3{font-size:calc(var(--inv-title-size) * 0.65)!important;}
@endif
@if($_fContentFont)
p,blockquote,address,li,.desc-groom p,.desc-bride p,
.couple-card .role,.couple-card .parents,
.event-row,.story-desc,.cover-sub{font-family:var(--inv-content-font)!important;}
@endif
@if($_fContentSize > 0)
p,blockquote,address,li{font-size:var(--inv-content-size)!important;}
@endif

@if($_bgColor)
/* Background override (warna + model) */
@if($_bgModel === 'gradient')
body{background:linear-gradient(180deg,var(--inv-bg-color) 0%,var(--inv-bg-color-2, var(--inv-bg-color)) 100%)!important;}
@elseif($_bgModel === 'dots')
body{
    background-color:var(--inv-bg-color)!important;
    background-image:radial-gradient(rgba(0,0,0,.08) 1px, transparent 1px)!important;
    background-size:18px 18px!important;
}
@elseif($_bgModel === 'grid')
body{
    background-color:var(--inv-bg-color)!important;
    background-image:
        linear-gradient(rgba(0,0,0,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,.06) 1px, transparent 1px)!important;
    background-size:22px 22px!important;
}
@elseif($_bgModel === 'waves')
body{
    background-color:var(--inv-bg-color)!important;
    background-image:
        radial-gradient(circle at 20% 10%, rgba(0,0,0,.06) 0 10px, transparent 11px),
        radial-gradient(circle at 80% 30%, rgba(0,0,0,.05) 0 12px, transparent 13px),
        radial-gradient(circle at 30% 80%, rgba(0,0,0,.04) 0 14px, transparent 15px)!important;
}
@else
body{background:var(--inv-bg-color)!important;}
@endif
@endif
</style>
@endif
