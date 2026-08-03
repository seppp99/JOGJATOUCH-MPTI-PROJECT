@props(['user'])

@php
    use App\Http\Requests\UpdateProfilePhotoRequest;

    $photoUrl = $user->profilePhotoUrl();
    $hasPhoto = $user->hasProfilePhoto();
    $maxKb = UpdateProfilePhotoRequest::MAX_KILOBYTES;
@endphp

{{--
    Modal "Edit Foto Profil".

    Tiga modal dalam satu komponen, ditumpuk dengan z-index berbeda:
      1. #jt-pp-main    - foto besar + tombol Ganti Foto / Edit / Hapus
      2. #jt-pp-cropper - pemotong rasio 1:1 (dipakai bersama oleh Ganti & Edit)
      3. #jt-pp-confirm - konfirmasi hapus

    Komponen ini dirender di dalam dashboard-sidebar, jadi otomatis tersedia di
    /akun, /akun/riwayat, dan halaman detail pesanan tanpa duplikasi markup.

    Semua data yang dibutuhkan JavaScript ditempelkan sebagai data-attribute pada
    elemen akar, bukan ditulis sebagai variabel global - supaya tidak ada
    kebocoran nama dan skripnya bisa dipakai ulang apa adanya.
--}}
<div
    id="jt-pp-root"
    data-has-photo="{{ $hasPhoto ? '1' : '0' }}"
    data-photo-url="{{ $photoUrl ?? '' }}"
    data-update-url="{{ route('akun.foto.update') }}"
    data-delete-url="{{ route('akun.foto.destroy') }}"
    data-max-kb="{{ $maxKb }}"
    data-initial="{{ $user->initial() }}"
>
    {{-- Input berkas tersembunyi. accept membatasi pilihan di dialog sistem,
         tetapi TIDAK bisa dipercaya sendirian - pengguna masih bisa memilih
         "All files". Validasi sebenarnya ada di JS dan di server. --}}
    <input type="file" id="jt-pp-file" class="hidden" accept=".png,.jpg,.jpeg,image/png,image/jpeg">

    {{-- ============================ MODAL 1: UTAMA ======================== --}}
    <div id="jt-pp-main" class="jt-pp-overlay hidden" role="dialog" aria-modal="true" aria-labelledby="jt-pp-main-title">
        <div class="jt-pp-backdrop" data-close="jt-pp-main"></div>

        <div class="jt-pp-panel" role="document">
            <button type="button" class="jt-pp-x" data-close="jt-pp-main" aria-label="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h3 id="jt-pp-main-title" class="font-serif-display text-2xl font-bold text-[#1E1B19] text-center">
                Foto <span class="italic text-[#E35D25]">profil</span>
            </h3>
            <p class="text-xs text-[#1E1B19]/55 text-center mt-2 mb-6">
                Format PNG, JPG, atau JPEG. Maksimal {{ $maxKb / 1024 }} MB.
            </p>

            {{-- Pratinjau besar. Dua lapis yang saling menggantikan: <img> saat
                 ada foto, inisial saat tidak ada. --}}
            <div class="flex justify-center mb-7">
                <div class="jt-pp-preview">
                    <img id="jt-pp-preview-img" src="{{ $photoUrl ?? '' }}" alt="Foto profil {{ $user->name }}"
                         class="{{ $hasPhoto ? '' : 'hidden' }}">
                    <span id="jt-pp-preview-initial" class="jt-pp-initial {{ $hasPhoto ? 'hidden' : '' }}">{{ $user->initial() }}</span>
                </div>
            </div>

            <div class="space-y-2.5">
                <button type="button" id="jt-pp-btn-change" class="jt-pp-btn jt-pp-btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 7.5 7.5 12M12 7.5V21" />
                    </svg>
                    Ganti Foto
                </button>

                <div class="grid grid-cols-2 gap-2.5">
                    <button type="button" id="jt-pp-btn-edit" class="jt-pp-btn jt-pp-btn-ghost" {{ $hasPhoto ? '' : 'disabled' }}>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z" />
                        </svg>
                        Edit
                    </button>

                    <button type="button" id="jt-pp-btn-delete" class="jt-pp-btn jt-pp-btn-danger" {{ $hasPhoto ? '' : 'disabled' }}>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>

            <p id="jt-pp-main-msg" class="jt-pp-msg hidden"></p>
        </div>
    </div>

    {{-- ========================== MODAL 2: CROPPER ======================== --}}
    <div id="jt-pp-cropper" class="jt-pp-overlay hidden" role="dialog" aria-modal="true" aria-labelledby="jt-pp-crop-title">
        <div class="jt-pp-backdrop" data-close="jt-pp-cropper"></div>

        <div class="jt-pp-panel" role="document">
            <h3 id="jt-pp-crop-title" class="font-serif-display text-2xl font-bold text-[#1E1B19] text-center">
                Atur <span class="italic text-[#E35D25]">posisi foto</span>
            </h3>
            <p class="text-xs text-[#1E1B19]/55 text-center mt-2 mb-5">
                Geser untuk memindahkan, gunakan penggeser untuk memperbesar.
            </p>

            {{-- Kanvas dibuat 512x512 (resolusi KELUARAN) lalu diperkecil oleh
                 CSS. Dengan begitu pratinjau dan hasil simpan benar-benar sama -
                 tidak ada langkah render kedua yang bisa meleset. --}}
            <div class="jt-pp-stage">
                <canvas id="jt-pp-canvas" width="512" height="512"></canvas>
                <div class="jt-pp-mask" aria-hidden="true"></div>
            </div>

            <div class="flex items-center gap-3 mt-5">
                <svg class="w-4 h-4 text-[#1E1B19]/40 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                </svg>
                <input type="range" id="jt-pp-zoom" min="1" max="4" step="0.01" value="1" class="jt-pp-range" aria-label="Perbesar foto">
            </div>

            <div class="grid grid-cols-2 gap-2.5 mt-6">
                <button type="button" class="jt-pp-btn jt-pp-btn-ghost" data-close="jt-pp-cropper">Batal</button>
                <button type="button" id="jt-pp-crop-save" class="jt-pp-btn jt-pp-btn-primary">Simpan</button>
            </div>

            <p id="jt-pp-crop-msg" class="jt-pp-msg hidden"></p>
        </div>
    </div>

    {{-- ======================= MODAL 3: KONFIRMASI HAPUS ================== --}}
    <div id="jt-pp-confirm" class="jt-pp-overlay hidden" role="dialog" aria-modal="true" aria-labelledby="jt-pp-confirm-title">
        <div class="jt-pp-backdrop" data-close="jt-pp-confirm"></div>

        <div class="jt-pp-panel jt-pp-panel-sm" role="document">
            <div class="flex justify-center mb-4">
                <span class="w-14 h-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </span>
            </div>

            <h3 id="jt-pp-confirm-title" class="text-base font-bold text-[#1E1B19] text-center leading-relaxed">
                Apakah anda yakin ingin menghapus foto profile?
            </h3>
            <p class="text-xs text-[#1E1B19]/55 text-center mt-2 mb-6">
                Foto akan dihapus permanen dan tidak dapat dikembalikan.
            </p>

            <div class="grid grid-cols-2 gap-2.5">
                <button type="button" class="jt-pp-btn jt-pp-btn-ghost" data-close="jt-pp-confirm">Batal</button>
                <button type="button" id="jt-pp-confirm-yes" class="jt-pp-btn jt-pp-btn-danger-solid">Lanjutkan</button>
            </div>

            <p id="jt-pp-confirm-msg" class="jt-pp-msg hidden"></p>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* Lapisan modal. Backdrop blur dipasang di elemen terpisah (.jt-pp-backdrop)
       supaya panelnya sendiri tetap tajam - kalau blur dipasang di pembungkus,
       isi panel ikut buram. */
    .jt-pp-overlay {
        position: fixed;
        inset: 0;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .jt-pp-overlay.hidden { display: none; }

    /* Cropper & konfirmasi berada DI ATAS modal utama. */
    /* Tidak ada lagi penumpukan - modal saling berganti, jadi ketiganya berada
       di lapisan yang sama. z-index bertingkat hanya diperlukan kalau ada panel
       yang sengaja dibiarkan terlihat di belakang panel lain. */

    .jt-pp-backdrop {
        position: absolute;
        inset: 0;
        background: rgb(30 27 25 / 0.45);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .jt-pp-panel {
        position: relative;
        width: 100%;
        max-width: 26rem;
        max-height: calc(100vh - 2rem);
        overflow-y: auto;
        background: #ffffff;
        border: 1px solid rgb(30 27 25 / 0.05);
        border-radius: 2rem;
        padding: 1.75rem 1.75rem 1.5rem;
        box-shadow: 0 24px 60px -12px rgb(30 27 25 / 0.35);
        animation: jt-pp-in 0.22s cubic-bezier(0.22, 0.9, 0.3, 1);
    }

    /* Panel cropper dibuat sedikit lebih ramping dari panel utama supaya
       proporsinya seimbang dengan area crop yang kini 16rem. */
    #jt-pp-cropper .jt-pp-panel { max-width: 22rem; }

    .jt-pp-panel-sm { max-width: 22rem; }

    @keyframes jt-pp-in {
        from { opacity: 0; transform: translateY(12px) scale(0.97); }
        to   { opacity: 1; transform: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        .jt-pp-panel { animation: none; }
    }

    .jt-pp-x {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background: rgb(30 27 25 / 0.05);
        color: rgb(30 27 25 / 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease;
    }

    .jt-pp-x:hover { background: rgb(30 27 25 / 0.1); }

    /* Pratinjau bulat: bentuk avatar, walau berkasnya tetap persegi 1:1. */
    .jt-pp-preview {
        width: 9.5rem;
        height: 9.5rem;
        border-radius: 9999px;
        overflow: hidden;
        background: linear-gradient(135deg, #e35d25, #f4733e);
        box-shadow: 0 0 0 5px #fbf9f6, 0 12px 24px -8px rgb(227 93 37 / 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .jt-pp-preview img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .jt-pp-preview img.hidden, .jt-pp-initial.hidden { display: none; }

    .jt-pp-initial {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 3.5rem;
        font-weight: 800;
        color: #ffffff;
        user-select: none;
    }

    .jt-pp-btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background-color 0.2s ease, color 0.2s ease, opacity 0.2s ease;
    }

    .jt-pp-btn:disabled { opacity: 0.4; cursor: not-allowed; }

    .jt-pp-btn-primary { background: #e35d25; color: #ffffff; box-shadow: 0 10px 15px -3px rgb(227 93 37 / 0.25); }
    .jt-pp-btn-primary:hover:not(:disabled) { background: #c74c1a; }

    .jt-pp-btn-ghost { background: #fbf9f6; color: #1e1b19; border: 1px solid rgb(30 27 25 / 0.1); }
    .jt-pp-btn-ghost:hover:not(:disabled) { background: rgb(30 27 25 / 0.05); }

    .jt-pp-btn-danger { background: #fef2f2; color: #dc2626; border: 1px solid rgb(220 38 38 / 0.15); }
    .jt-pp-btn-danger:hover:not(:disabled) { background: #fee2e2; }

    /* Tombol destruktif pada modal konfirmasi: merah solid. */
    .jt-pp-btn-danger-solid { background: #dc2626; color: #ffffff; }
    .jt-pp-btn-danger-solid:hover:not(:disabled) { background: #b91c1c; }

    /* Area crop: 16rem = 80% dari 20rem sebelumnya.

       Angka tengah pada clamp() yang mencegah scrollbar. Diturunkan dari
       pengukuran: isi panel selain area crop (judul, keterangan, penggeser,
       tombol, padding) memakan ~261px, ditambah 32px padding overlay. Jadi agar
       panel selalu muat, area crop tidak boleh melebihi tinggi layar dikurangi
       ~293px - dibulatkan jadi 19rem untuk margin aman.

       Batas bawah 8rem menjaga area crop tetap bisa dipakai di jendela yang
       sangat pendek; di bawah itu scrollbar lebih baik daripada kotak crop yang
       terlalu kecil untuk dioperasikan. */
    .jt-pp-stage {
        position: relative;
        width: 100%;
        max-width: clamp(8rem, calc(100vh - 19rem), 16rem);
        margin: 0 auto;
        aspect-ratio: 1 / 1;
        border-radius: 1.25rem;
        overflow: hidden;
        background: #1e1b19;
        touch-action: none; /* geser di layar sentuh menggerakkan foto, bukan halaman */
    }

    .jt-pp-stage canvas { width: 100%; height: 100%; display: block; cursor: grab; }
    .jt-pp-stage canvas:active { cursor: grabbing; }

    /* Penanda area lingkaran - murni visual, keluarannya tetap persegi 1:1. */
    .jt-pp-mask {
        position: absolute;
        inset: 0;
        pointer-events: none;
        box-shadow: 0 0 0 9999px rgb(30 27 25 / 0.35);
        border-radius: 9999px;
        border: 2px solid rgb(255 255 255 / 0.7);
    }

    .jt-pp-range { width: 100%; accent-color: #e35d25; }

    .jt-pp-msg {
        margin-top: 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-align: center;
        border-radius: 0.75rem;
        padding: 0.625rem 0.75rem;
    }

    .jt-pp-msg.hidden { display: none; }
    .jt-pp-msg.is-error { background: #fef2f2; color: #dc2626; }
    .jt-pp-msg.is-ok { background: #ecfdf5; color: #059669; }

    body.jt-pp-lock { overflow: hidden; }
</style>

<script>
(function () {
    const root = document.getElementById('jt-pp-root');
    if (!root) return;

    // ── Konfigurasi dari server ────────────────────────────────────────────
    const UPDATE_URL = root.dataset.updateUrl;
    const DELETE_URL = root.dataset.deleteUrl;
    const MAX_BYTES = parseInt(root.dataset.maxKb, 10) * 1024;
    const INITIAL = root.dataset.initial || '?';
    const OUTPUT = 512;                       // sisi keluaran (persegi, rasio 1:1)
    const ALLOWED = ['image/png', 'image/jpeg'];

    let hasPhoto = root.dataset.hasPhoto === '1';
    let photoUrl = root.dataset.photoUrl || '';

    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

    // ── Elemen ─────────────────────────────────────────────────────────────
    const fileInput = document.getElementById('jt-pp-file');
    const modals = {
        main: document.getElementById('jt-pp-main'),
        cropper: document.getElementById('jt-pp-cropper'),
        confirm: document.getElementById('jt-pp-confirm'),
    };
    const previewImg = document.getElementById('jt-pp-preview-img');
    const previewInitial = document.getElementById('jt-pp-preview-initial');
    const btnChange = document.getElementById('jt-pp-btn-change');
    const btnEdit = document.getElementById('jt-pp-btn-edit');
    const btnDelete = document.getElementById('jt-pp-btn-delete');
    const canvas = document.getElementById('jt-pp-canvas');
    const ctx = canvas.getContext('2d');
    const zoom = document.getElementById('jt-pp-zoom');
    const cropSave = document.getElementById('jt-pp-crop-save');
    const confirmYes = document.getElementById('jt-pp-confirm-yes');

    // ── Utilitas modal ─────────────────────────────────────────────────────
    // Modal BERGANTI, tidak menumpuk: hanya satu yang terbuka pada satu waktu.
    // Cropper dan konfirmasi hapus menggantikan modal utama saat dibuka, lalu
    // mengembalikannya saat ditutup - sehingga tidak ada panel yang terlihat
    // bertindih di belakang panel lain.
    function anyOpen() {
        return Object.values(modals).some((m) => !m.classList.contains('hidden'));
    }

    function show(name) {
        modals[name].classList.remove('hidden');
        document.body.classList.add('jt-pp-lock');
    }

    function hide(name) {
        modals[name].classList.add('hidden');
        clearMsg(name);
        if (!anyOpen()) document.body.classList.remove('jt-pp-lock');
    }

    /** Tutup satu modal lalu buka modal lain sebagai penggantinya. */
    function switchTo(from, to) {
        modals[from].classList.add('hidden');
        clearMsg(from);
        show(to);
    }

    /** Cropper & konfirmasi selalu kembali ke modal utama saat dibatalkan. */
    function dismiss(name) {
        if (name === 'main') return hide('main');
        switchTo(name, 'main');
    }

    // Klik backdrop / tombol silang / tombol Batal.
    root.querySelectorAll('[data-close]').forEach((el) => {
        el.addEventListener('click', () => dismiss(el.dataset.close.replace('jt-pp-', '')));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape' || !anyOpen()) return;
        if (!modals.confirm.classList.contains('hidden')) return dismiss('confirm');
        if (!modals.cropper.classList.contains('hidden')) return dismiss('cropper');
        dismiss('main');
    });

    // ── Pesan galat/sukses per modal ───────────────────────────────────────
    const msgEls = {
        main: document.getElementById('jt-pp-main-msg'),
        cropper: document.getElementById('jt-pp-crop-msg'),
        confirm: document.getElementById('jt-pp-confirm-msg'),
    };

    function showMsg(name, text, ok = false) {
        const el = msgEls[name];
        el.textContent = text;
        el.classList.remove('hidden', 'is-error', 'is-ok');
        el.classList.add(ok ? 'is-ok' : 'is-error');
    }

    function clearMsg(name) {
        msgEls[name].classList.add('hidden');
    }

    // ── Sinkronisasi tampilan setelah foto berubah ─────────────────────────
    // Avatar muncul di beberapa tempat (sidebar, navbar). Semuanya ditandai
    // .jt-avatar-slot supaya bisa diperbarui tanpa memuat ulang halaman.
    function syncAvatars() {
        document.querySelectorAll('.jt-avatar-slot').forEach((slot) => {
            const img = slot.querySelector('img');
            const txt = slot.querySelector('.jt-avatar-initial');

            if (hasPhoto && photoUrl) {
                if (img) { img.src = photoUrl; img.classList.remove('hidden'); }
                if (txt) txt.classList.add('hidden');
            } else {
                if (img) { img.removeAttribute('src'); img.classList.add('hidden'); }
                if (txt) { txt.textContent = INITIAL; txt.classList.remove('hidden'); }
            }
        });

        if (hasPhoto && photoUrl) {
            previewImg.src = photoUrl;
            previewImg.classList.remove('hidden');
            previewInitial.classList.add('hidden');
        } else {
            previewImg.removeAttribute('src');
            previewImg.classList.add('hidden');
            previewInitial.classList.remove('hidden');
        }

        btnEdit.disabled = !hasPhoto;
        btnDelete.disabled = !hasPhoto;
    }

    // ── Pemicu dari avatar di sidebar ──────────────────────────────────────
    document.querySelectorAll('.jt-pp-trigger').forEach((el) => {
        el.addEventListener('click', () => { clearMsg('main'); show('main'); });
    });

    // ── CROPPER ────────────────────────────────────────────────────────────
    // Kanvas berukuran 512x512 = resolusi keluaran, diperkecil oleh CSS.
    // Semua koordinat di bawah memakai satuan piksel KANVAS, sehingga apa yang
    // terlihat persis sama dengan yang disimpan.
    const crop = { img: null, scale: 1, minScale: 1, x: 0, y: 0 };

    function drawCrop() {
        if (!crop.img) return;
        const w = crop.img.width * crop.scale;
        const h = crop.img.height * crop.scale;

        ctx.clearRect(0, 0, OUTPUT, OUTPUT);
        ctx.fillStyle = '#1e1b19';
        ctx.fillRect(0, 0, OUTPUT, OUTPUT);
        ctx.drawImage(crop.img, crop.x, crop.y, w, h);
    }

    // Foto selalu MENUTUPI kotak - tidak boleh ada area kosong di tepi.
    function clampCrop() {
        const w = crop.img.width * crop.scale;
        const h = crop.img.height * crop.scale;
        crop.x = Math.min(0, Math.max(OUTPUT - w, crop.x));
        crop.y = Math.min(0, Math.max(OUTPUT - h, crop.y));
    }

    function loadIntoCropper(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            // Foto tersimpan berasal dari origin yang sama, jadi kanvas tidak
            // "ternoda" dan toBlob() tetap boleh dipanggil.
            img.onload = () => {
                crop.img = img;
                // Skala minimum = skala terkecil yang masih menutupi 512x512.
                crop.minScale = Math.max(OUTPUT / img.width, OUTPUT / img.height);
                crop.scale = crop.minScale;
                crop.x = (OUTPUT - img.width * crop.scale) / 2;
                crop.y = (OUTPUT - img.height * crop.scale) / 2;

                zoom.min = '1';
                zoom.max = '4';
                zoom.value = '1';

                drawCrop();
                resolve();
            };
            img.onerror = () => reject(new Error('Gambar gagal dimuat.'));
            img.src = src;
        });
    }

    zoom.addEventListener('input', () => {
        if (!crop.img) return;
        // Perbesaran berpusat di tengah kotak supaya terasa wajar.
        const prev = crop.scale;
        crop.scale = crop.minScale * parseFloat(zoom.value);
        const k = crop.scale / prev;
        crop.x = OUTPUT / 2 - (OUTPUT / 2 - crop.x) * k;
        crop.y = OUTPUT / 2 - (OUTPUT / 2 - crop.y) * k;
        clampCrop();
        drawCrop();
    });

    // Geser dengan pointer (tetikus maupun sentuh).
    let dragId = null, lastX = 0, lastY = 0;

    canvas.addEventListener('pointerdown', (e) => {
        if (!crop.img) return;
        dragId = e.pointerId;
        lastX = e.clientX;
        lastY = e.clientY;
        canvas.setPointerCapture(dragId);
    });

    canvas.addEventListener('pointermove', (e) => {
        if (dragId !== e.pointerId || !crop.img) return;
        // Piksel CSS -> piksel kanvas.
        const ratio = OUTPUT / canvas.getBoundingClientRect().width;
        crop.x += (e.clientX - lastX) * ratio;
        crop.y += (e.clientY - lastY) * ratio;
        lastX = e.clientX;
        lastY = e.clientY;
        clampCrop();
        drawCrop();
    });

    function endDrag(e) {
        if (dragId !== e.pointerId) return;
        canvas.releasePointerCapture(dragId);
        dragId = null;
    }

    canvas.addEventListener('pointerup', endDrag);
    canvas.addEventListener('pointercancel', endDrag);

    // ── Tombol: Ganti Foto ─────────────────────────────────────────────────
    btnChange.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', async () => {
        const file = fileInput.files?.[0];
        // Reset supaya memilih berkas yang SAMA dua kali tetap memicu 'change'.
        fileInput.value = '';
        if (!file) return;

        if (!ALLOWED.includes(file.type)) {
            return showMsg('main', 'Format tidak didukung. Gunakan PNG, JPG, atau JPEG.');
        }
        if (file.size > MAX_BYTES) {
            return showMsg('main', 'Ukuran foto melebihi ' + (MAX_BYTES / 1048576) + ' MB.');
        }

        const url = URL.createObjectURL(file);
        try {
            await loadIntoCropper(url);
            clearMsg('cropper');
            switchTo('main', 'cropper');
        } catch (err) {
            showMsg('main', 'Gambar tidak dapat dibaca. Coba berkas lain.');
        } finally {
            // Objek URL dilepas setelah gambar termuat ke kanvas.
            URL.revokeObjectURL(url);
        }
    });

    // ── Tombol: Edit (memuat foto yang sedang dipakai) ─────────────────────
    btnEdit.addEventListener('click', async () => {
        if (!hasPhoto || !photoUrl) return;
        try {
            await loadIntoCropper(photoUrl);
            clearMsg('cropper');
            switchTo('main', 'cropper');
        } catch (err) {
            showMsg('main', 'Foto saat ini gagal dimuat untuk diedit.');
        }
    });

    // ── Simpan hasil crop ──────────────────────────────────────────────────
    cropSave.addEventListener('click', () => {
        if (!crop.img) return;

        setBusy(cropSave, true, 'Menyimpan…');

        canvas.toBlob(async (blob) => {
            if (!blob) {
                setBusy(cropSave, false, 'Simpan');
                return showMsg('cropper', 'Gagal memproses gambar.');
            }

            const body = new FormData();
            body.append('photo', blob, 'profile.jpg');

            try {
                const res = await fetch(UPDATE_URL, {
                    method: 'POST',
                    body,
                    credentials: 'same-origin',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                });

                const data = await res.json().catch(() => ({}));

                if (res.status === 422) {
                    // Galat validasi Laravel: ambil pesan pertama yang relevan.
                    const first = data.errors ? Object.values(data.errors)[0]?.[0] : null;
                    throw new Error(first || 'Foto ditolak oleh server.');
                }
                if (!res.ok || !data.ok) {
                    throw new Error(data.message || 'Gagal menyimpan foto.');
                }

                hasPhoto = true;
                photoUrl = data.url;
                syncAvatars();
                switchTo('cropper', 'main');
                showMsg('main', data.message || 'Foto profil berhasil diperbarui.', true);
            } catch (err) {
                showMsg('cropper', err.message || 'Terjadi kesalahan jaringan.');
            } finally {
                setBusy(cropSave, false, 'Simpan');
            }
        }, 'image/jpeg', 0.9);
    });

    // ── Hapus ──────────────────────────────────────────────────────────────
    btnDelete.addEventListener('click', () => {
        if (!hasPhoto) return;
        clearMsg('confirm');
        switchTo('main', 'confirm');
    });

    confirmYes.addEventListener('click', async () => {
        setBusy(confirmYes, true, 'Menghapus…');
        try {
            const res = await fetch(DELETE_URL, {
                method: 'DELETE',
                credentials: 'same-origin',
                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
            });

            const data = await res.json().catch(() => ({}));
            if (!res.ok || !data.ok) throw new Error(data.message || 'Gagal menghapus foto.');

            hasPhoto = false;
            photoUrl = '';
            syncAvatars();
            switchTo('confirm', 'main');
            showMsg('main', data.message || 'Foto profil berhasil dihapus.', true);
        } catch (err) {
            showMsg('confirm', err.message || 'Terjadi kesalahan jaringan.');
        } finally {
            setBusy(confirmYes, false, 'Lanjutkan');
        }
    });

    function setBusy(btn, busy, label) {
        btn.disabled = busy;
        btn.textContent = label;
    }

    syncAvatars();
})();
</script>
@endpush
