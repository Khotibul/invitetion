@php
    use Carbon\Carbon;

    $ogUrl = $ogUrl ?? request()->fullUrl();

    $invTitle = trim((string) ($invitation->title ?? ''));
    $ogTitle = $ogTitle ?? ($invTitle !== '' ? ('The Wedding of '.$invTitle) : 'The Wedding Invitation');

    $ogImageUrl = (string) ($ogImage ?? ($set['file'] ?? ''));
    if (trim($ogImageUrl) === '') {
        // fallback aman jika file kosong
        $ogImageUrl = asset('modules/dropify/src/images/cover.jpg');
    }

    $dateText = $weddingDateFormatted ?? null;
    if (empty($dateText) && !empty($data->detail->calendar->date ?? null)) {
        try {
            $dateText = Carbon::parse($data->detail->calendar->date)->locale('id')->translatedFormat('l, d F Y');
        } catch (\Exception $e) {
            $dateText = null;
        }
    }

    $defaultDesc = trim(($dateText ? ($dateText.'. ') : '').'Tanpa Mengurangi Rasa Hormat, Kami Bermaksud Mengundang Bapak/Ibu/Saudara/i, Pada Acara Pernikahan Kami');
    $ogDescription = $ogDescription ?? ($set['content'] ?? $defaultDesc);
@endphp

<meta property="og:type" content="website">
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $ogImageUrl }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $ogUrl }}">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">

