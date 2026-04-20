{{-- RSVP + Wishes partial — include di setiap template --}}
@php
    // Ambil slug dengan aman dari berbagai sumber
    $__slug = $invSlug
        ?? $invitation->slug
        ?? request()->route('slug')
        ?? request()->segment(1)
        ?? '';
@endphp
@if($showWishes ?? (($data->wishes->public ?? false) === true))
@php
    $__wishesTitle   = $wishesTitle   ?? ($data->wishes->title   ?? 'Ucapan & Doa');
    $__wishesContent = $wishesContent ?? ($data->wishes->content ?? '');
@endphp
<section id="wishes" style="padding:4rem 1.5rem;background:var(--section-bg,#fff);text-align:center">
    <h2 style="font-family:var(--font-heading,'serif');color:var(--color-primary,'#2d7a4f');margin-bottom:.5rem">{{ $__wishesTitle }}</h2>
    @if($__wishesContent)<p style="color:var(--color-muted,'#888');margin-bottom:1.5rem;font-size:.95rem">{{ $__wishesContent }}</p>@endif
    <form id="wishForm"
          action="{{ $__slug ? route('invitation.wish', $__slug) : '#' }}"
          method="post"
          style="max-width:520px;margin:0 auto;background:var(--card-bg,'#f9f9f9');padding:2rem;border-radius:12px">
        @csrf
        <div style="margin-bottom:1rem;text-align:left">
            <label style="display:block;font-size:.8rem;margin-bottom:.3rem">Nama <var dir="name"></var></label>
            <input type="text" name="name" required placeholder="Nama Anda"
                   style="width:100%;padding:.7rem 1rem;border:1px solid #ddd;border-radius:8px;font-size:.9rem">
        </div>
        <div style="margin-bottom:1rem;text-align:left">
            <label style="display:block;font-size:.8rem;margin-bottom:.3rem">No. WhatsApp <var dir="phone"></var></label>
            <input type="text" name="phone" required placeholder="08xxxxxxxxxx"
                   style="width:100%;padding:.7rem 1rem;border:1px solid #ddd;border-radius:8px;font-size:.9rem">
        </div>
        <div style="margin-bottom:1rem;text-align:left">
            <label style="display:block;font-size:.8rem;margin-bottom:.3rem">Ucapan & Doa <var dir="message"></var></label>
            <textarea name="message" required placeholder="Tulis ucapan..."
                      style="width:100%;padding:.7rem 1rem;border:1px solid #ddd;border-radius:8px;font-size:.9rem;resize:vertical;min-height:80px"></textarea>
        </div>
        <button type="submit" id="wishBtn"
                style="width:100%;padding:.85rem;background:var(--color-primary,'#2d7a4f');color:#fff;border:none;border-radius:8px;font-size:.9rem;cursor:pointer">
            Kirim Ucapan
        </button>
        <div id="wishMsg" style="display:none;margin-top:.8rem;padding:.7rem;border-radius:6px;font-size:.85rem"></div>
    </form>
</section>
@endif

@php
    $__rsvpTitle   = $rsvpTitle   ?? ($data->rsvp->title   ?? 'Konfirmasi Kehadiran');
    $__rsvpContent = $rsvpContent ?? ($data->rsvp->content ?? '');
    $__rsvpYes     = $rsvpYes     ?? ($data->rsvp->yes->option ?? 'Hadir');
    $__rsvpNo      = $rsvpNo      ?? ($data->rsvp->no->option  ?? 'Tidak Hadir');
@endphp
<section id="rsvp" style="padding:4rem 1.5rem;background:var(--rsvp-bg,'#f0f9f4');text-align:center">
    <h2 style="font-family:var(--font-heading,'serif');color:var(--color-primary,'#2d7a4f');margin-bottom:.5rem">{{ $__rsvpTitle }}</h2>
    @if($__rsvpContent)<p style="color:var(--color-muted,'#888');margin-bottom:1.5rem;font-size:.95rem">{{ $__rsvpContent }}</p>@endif
    <form id="rsvpForm"
          action="{{ $__slug ? route('invitation.present', $__slug) : '#' }}"
          method="post"
          style="max-width:480px;margin:0 auto;background:var(--card-bg,'#fff');padding:2rem;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08)">
        @csrf
        <input type="hidden" name="option" id="rsvpOption" value="">
        <div style="display:flex;gap:.8rem;margin-bottom:1rem">
            <button type="button" class="rsvp-opt" data-val="yes"
                    style="flex:1;padding:.7rem;border:2px solid #ddd;border-radius:8px;background:#fff;cursor:pointer;font-size:.85rem;transition:all .2s">
                ✓ {{ $__rsvpYes }}
            </button>
            <button type="button" class="rsvp-opt" data-val="no"
                    style="flex:1;padding:.7rem;border:2px solid #ddd;border-radius:8px;background:#fff;cursor:pointer;font-size:.85rem;transition:all .2s">
                ✗ {{ $__rsvpNo }}
            </button>
        </div>
        <div style="margin-bottom:.8rem;text-align:left">
            <input type="text" name="name" required placeholder="Nama Anda"
                   style="width:100%;padding:.7rem 1rem;border:1px solid #ddd;border-radius:8px;font-size:.9rem">
        </div>
        <div style="margin-bottom:.8rem;text-align:left">
            <input type="number" name="amount" min="1" value="1" placeholder="Jumlah tamu"
                   style="width:100%;padding:.7rem 1rem;border:1px solid #ddd;border-radius:8px;font-size:.9rem">
        </div>
        <button type="submit" id="rsvpBtn"
                style="width:100%;padding:.85rem;background:var(--color-primary,'#2d7a4f');color:#fff;border:none;border-radius:8px;font-size:.9rem;cursor:pointer">
            Kirim Konfirmasi
        </button>
        <div id="rsvpMsg" style="display:none;margin-top:.8rem;padding:.7rem;border-radius:6px;font-size:.85rem"></div>
    </form>
</section>

<script>
(function(){
    document.querySelectorAll('.rsvp-opt').forEach(function(btn){
        btn.addEventListener('click',function(){
            document.querySelectorAll('.rsvp-opt').forEach(function(b){
                b.style.background='#fff';b.style.borderColor='#ddd';b.style.color='#333';
            });
            this.style.background='var(--color-primary,#2d7a4f)';
            this.style.borderColor='var(--color-primary,#2d7a4f)';
            this.style.color='#fff';
            document.getElementById('rsvpOption').value=this.dataset.val;
        });
    });
    function ajaxForm(fId,bId,mId){
        var f=document.getElementById(fId);
        if(!f||f.action==='#')return;
        f.addEventListener('submit',function(e){
            e.preventDefault();
            var btn=document.getElementById(bId),msg=document.getElementById(mId);
            btn.disabled=true;btn.textContent='Mengirim...';
            fetch(f.action,{method:'POST',body:new FormData(f),headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(r){return r.json();})
            .then(function(d){
                msg.style.display='block';msg.style.background='#f0faf4';
                msg.style.color='#1a6b3c';msg.style.border='1px solid #2d7a4f';
                msg.textContent=d.message||'Terkirim!';
                f.reset();
                document.querySelectorAll('.rsvp-opt').forEach(function(b){b.style.background='#fff';b.style.borderColor='#ddd';b.style.color='#333';});
                var ro=document.getElementById('rsvpOption');if(ro)ro.value='';
            })
            .catch(function(){
                msg.style.display='block';msg.style.background='#fff5f5';
                msg.style.color='#c0392b';msg.textContent='Terjadi kesalahan. Coba lagi.';
            })
            .finally(function(){btn.disabled=false;btn.textContent=fId==='wishForm'?'Kirim Ucapan':'Kirim Konfirmasi';});
        });
    }
    ajaxForm('wishForm','wishBtn','wishMsg');
    ajaxForm('rsvpForm','rsvpBtn','rsvpMsg');
})();
</script>