export function initPasswordToggles() {
    document.querySelectorAll('[data-toggle-target]').forEach((btn) => {
        const input = document.getElementById(btn.dataset.toggleTarget);
        if (!input) return;

        btn.addEventListener('click', () => {
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            btn.querySelector('.icon-eye-open')?.classList.toggle('hidden', !showing);
            btn.querySelector('.icon-eye-closed')?.classList.toggle('hidden', showing);
            btn.setAttribute('aria-label', showing ? 'Tampilkan password' : 'Sembunyikan password');
        });
    });
}
