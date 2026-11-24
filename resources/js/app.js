import './bootstrap';

// Penanda bahwa JS aktif: skeleton & animasi hanya dipakai bila JS berjalan
document.documentElement.classList.add('sf-js');

// Skeleton poster: tampilkan gambar setelah selesai dimuat (juga untuk kartu dari "Muat lebih banyak")
const markPosterLoaded = (img) => img.closest('.sf-card__poster')?.classList.add('is-loaded');

document.querySelectorAll('.sf-card__poster img').forEach((img) => {
    if (img.complete) markPosterLoaded(img);
});

['load', 'error'].forEach((type) => {
    document.addEventListener(type, (event) => {
        if (event.target.matches?.('.sf-card__poster img')) markPosterLoaded(event.target);
    }, true);
});

// Section muncul perlahan saat masuk viewport
const revealTargets = document.querySelectorAll('.sf-reveal');

if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -10% 0px' });

    revealTargets.forEach((el) => observer.observe(el));
} else {
    revealTargets.forEach((el) => el.classList.add('is-visible'));
}

// Navbar menjadi solid + blur setelah halaman discroll
const navbar = document.querySelector('.sf-navbar');

if (navbar) {
    const updateNavbar = () => navbar.classList.toggle('is-scrolled', window.scrollY > 40);
    updateNavbar();
    window.addEventListener('scroll', updateNavbar, { passive: true });
}

// Tombol "Muat lebih banyak": ambil halaman berikutnya sebagai JSON lalu tempel ke grid
document.querySelectorAll('[data-load-more]').forEach((btn) => {
    const grid = document.querySelector(btn.dataset.loadMore);
    if (!grid) return;

    const label = btn.textContent.trim();

    btn.addEventListener('click', async () => {
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Memuat…';

        try {
            const { data } = await window.axios.get(btn.dataset.next);
            grid.insertAdjacentHTML('beforeend', data.html);

            if (data.next) {
                btn.dataset.next = data.next;
            } else {
                btn.parentElement.remove();
                return;
            }
        } catch (error) {
            console.error(error);
        }

        btn.disabled = false;
        btn.textContent = label;
    });
});

// Tombol ‹ › pada baris film horizontal
document.querySelectorAll('.sf-row').forEach((row) => {
    const track = row.querySelector('[data-row-track]');
    const buttons = row.querySelectorAll('[data-row-scroll]');
    if (!track) return;

    const updateButtons = () => {
        const max = track.scrollWidth - track.clientWidth - 1;
        buttons.forEach((btn) => {
            btn.disabled = btn.dataset.rowScroll < 0 ? track.scrollLeft <= 0 : track.scrollLeft >= max;
        });
    };

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            track.scrollBy({ left: track.clientWidth * 0.8 * Number(btn.dataset.rowScroll) });
        });
    });

    track.addEventListener('scroll', updateButtons, { passive: true });
    window.addEventListener('resize', updateButtons);
    updateButtons();
});
