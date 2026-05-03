@php
use Carbon\Carbon;
use Illuminate\Support\Str;

// Skip if already resolved by controller (resolveHelperVars)
if (!isset($femaleName)) {

    // Nama pasangan
    $maleName   = (string)($data->profile->name->male   ?? $data->cover->name->male   ?? 'Mempelai Pria');
    $femaleName = (string)($data->profile->name->female ?? $data->cover->name->female ?? 'Mempelai Wanita');
    $maleInitial   = Str::upper(Str::substr(trim($maleName),   0, 1)) ?: 'M';
    $femaleInitial = Str::upper(Str::substr(trim($femaleName), 0, 1)) ?: 'W';

    // Tanggal & waktu
    $weddingDate          = $data->detail->calendar->date ?? now()->addMonths(3)->format('Y-m-d');
    $weddingTime          = $data->detail->calendar->time ?? '09:00';
    $weddingTz            = strtoupper($data->detail->calendar->timezone ?? 'WIB');
    $weddingDateFormatted = Carbon::parse($weddingDate)->locale('id')->translatedFormat('l, d F Y');
    $weddingDateShort     = Carbon::parse($weddingDate)->locale('id')->translatedFormat('d F Y');

    // Foto pasangan
    $maleMethod   = $data->profile->photo->male->method   ?? 'none';
    $maleImg      = $data->profile->photo->male->image     ?? '';
    $maleFrame    = $data->profile->photo->male->frame     ?? '';
    $femaleMethod = $data->profile->photo->female->method  ?? 'none';
    $femaleImg    = $data->profile->photo->female->image   ?? '';
    $femaleFrame  = $data->profile->photo->female->frame   ?? '';

    $maleSrc = (!empty($maleImg) && $maleMethod !== 'none')
        ? ($maleMethod === 'storage' ? url('storage/sm/'.$maleImg) : url('storage/avatar/'.$maleImg))
        : null;
    $femaleSrc = (!empty($femaleImg) && $femaleMethod !== 'none')
        ? ($femaleMethod === 'storage' ? url('storage/sm/'.$femaleImg) : url('storage/avatar/'.$femaleImg))
        : null;

    // Foto sampul
    $coverObj = $data->cover->description->image ?? null;
    $coverSrc = null;
    if ($coverObj && !empty($coverObj->image ?? '')) {
        $__cm = $coverObj->method ?? '';
        if ($__cm === 'asset')        $coverSrc = asset($coverObj->image);
        elseif ($__cm === 'storage')  $coverSrc = url('storage/sm/'.$coverObj->image);
        elseif ($__cm === 'avatar')   $coverSrc = url('storage/avatar/'.$coverObj->image);
        else                          $coverSrc = url('storage/'.$coverObj->image);
    }

    // OG image
    $invFile = Str::startsWith($invitation->file ?? '', 'template/')
        ? asset($invitation->file)
        : url('storage/'.($invitation->file ?? ''));
    $ogImage = $coverSrc ?? $invFile;

    // Lokasi
    $locationAddress = $data->detail->location->address ?? '';
    $locationMap     = $data->detail->location->map     ?? '';

    // Quote
    $quoteContent = $data->quote->content ?? '';

    // Teks cover
    $coverContent = $data->cover->content ?? 'Undangan Pernikahan';
    $coverButton  = $data->cover->button  ?? 'Buka Undangan';
    $coverTop     = $data->cover->description->top    ?? '';
    $coverBottom  = $data->cover->description->bottom ?? '';

    // Orang tua
    $showParent      = ($data->profile->parent->show ?? false) === true;
    $maleFather      = $data->profile->parent->male->father      ?? '';
    $maleMother      = $data->profile->parent->male->mother      ?? '';
    $maleChildhood   = $data->profile->parent->male->childhood   ?? '1';
    $femaleFather    = $data->profile->parent->female->father    ?? '';
    $femaleMother    = $data->profile->parent->female->mother    ?? '';
    $femaleChildhood = $data->profile->parent->female->childhood ?? '1';

    // Instagram
    $showIg   = ($data->profile->instagram->show ?? false) === true;
    $maleIg   = $data->profile->instagram->male   ?? '';
    $femaleIg = $data->profile->instagram->female ?? '';

    // RSVP
    $rsvpTitle   = $data->rsvp->title        ?? 'Konfirmasi Kehadiran';
    $rsvpContent = $data->rsvp->content      ?? '';
    $rsvpYes     = $data->rsvp->yes->option  ?? 'Hadir';
    $rsvpNo      = $data->rsvp->no->option   ?? 'Tidak Hadir';
    $rsvpYesMsg  = $data->rsvp->yes->content ?? 'Terima kasih';
    $rsvpNoMsg   = $data->rsvp->no->content  ?? 'Terima kasih';

    // Wishes
    $showWishes    = ($data->wishes->public ?? false) === true;
    $wishesTitle   = $data->wishes->title   ?? 'Ucapan & Doa';
    $wishesContent = $data->wishes->content ?? '';

    // Gift
    $showGift    = ($data->gift->show ?? false) === true;
    $giftTitle   = $data->gift->title        ?? 'Amplop Digital';
    $giftContent = $data->gift->content      ?? '';
    $giftBank    = $data->gift->bank->option ?? '';
    $giftCode    = $data->gift->bank->code   ?? '';
    $giftName    = $data->gift->bank->name   ?? '';

    // Countdown & penutup
    $showCountdown = ($data->detail->countdown->show ?? true) === true;
    $showClosing   = ($data->detail->additional->show ?? false) === true;
    $closingText   = $data->detail->additional->closing ?? '';

    // Musik
    $showMusic = ($data->music->show ?? false) === true;
    $musicUrl  = $data->music->url   ?? '';

    // Galeri
    $galleryFiles = (!empty($other['photo']) && !empty($other['photo']->prop->file ?? []))
        ? $other['photo']->prop->file
        : [];
    $galleryTitle = $other['photo']->title ?? 'Galeri Foto';

    // Slug untuk route
    $invSlug = $invitation->slug ?? request()->route('slug') ?? '';
}
@endphp
