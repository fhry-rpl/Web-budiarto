import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    // === NAVIGATION ===
    const navEl = document.getElementById('mainNav');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('mobileOverlay');
    let isOpen = false;

    if (navEl) {
        const onScroll = () => navEl.classList.toggle('scrolled', window.scrollY > 20);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    window.toggleDrawer = function () {
        isOpen = !isOpen;
        drawer.classList.toggle('hidden', !isOpen);
        if (overlay) overlay.classList.toggle('hidden', !isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    };

    window.closeDrawer = function () {
        isOpen = false;
        drawer.classList.add('hidden');
        if (overlay) overlay.classList.add('hidden');
        document.body.style.overflow = '';
        document.querySelectorAll('[data-mobile-menu]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[data-mobile-toggle] .chevron').forEach(el => el.classList.remove('rotate-180'));
    };

    document.querySelectorAll('[data-drawer-close]').forEach(el => el.addEventListener('click', window.closeDrawer));
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && isOpen) window.closeDrawer(); });

    // Desktop dropdowns
    document.querySelectorAll('[data-dropdown]').forEach(container => {
        const toggle = container.querySelector('[data-dropdown-toggle]');
        const menu = container.querySelector('[data-dropdown-menu]');
        let timeout;
        if (toggle && menu) {
            toggle.addEventListener('click', e => {
                e.stopPropagation();
                document.querySelectorAll('[data-dropdown-menu]').forEach(el => el.classList.add('hidden'));
                menu.classList.toggle('hidden');
            });
            container.addEventListener('mouseenter', () => { clearTimeout(timeout); menu.classList.remove('hidden'); });
            container.addEventListener('mouseleave', () => { timeout = setTimeout(() => menu.classList.add('hidden'), 200); });
        }
    });
    document.addEventListener('click', () => document.querySelectorAll('[data-dropdown-menu]:not(.hidden)').forEach(el => el.classList.add('hidden')));

    // Mobile submenus
    document.querySelectorAll('[data-mobile-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.mobileToggle;
            const menu = document.querySelector(`[data-mobile-menu="${id}"]`);
            if (!menu) return;
            const wasHidden = menu.classList.contains('hidden');
            document.querySelectorAll('[data-mobile-menu]').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('[data-mobile-toggle] .chevron').forEach(el => el.classList.remove('rotate-180'));
            if (wasHidden) { menu.classList.remove('hidden'); btn.querySelector('.chevron')?.classList.add('rotate-180'); }
        });
    });

    // === LIGHTBOX ===
    const lightboxEl = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    let lightboxImages = [], lightboxIndex = 0;

    window.openLightbox = function (index, images) {
        lightboxImages = images; lightboxIndex = index;
        if (lightboxImg) lightboxImg.src = images[index];
        if (lightboxEl) { lightboxEl.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    };

    function closeLightbox() { if (lightboxEl) lightboxEl.classList.add('hidden'); document.body.style.overflow = ''; }
    function nextImage() { lightboxIndex = (lightboxIndex + 1) % lightboxImages.length; if (lightboxImg) lightboxImg.src = lightboxImages[lightboxIndex]; }
    function prevImage() { lightboxIndex = (lightboxIndex - 1 + lightboxImages.length) % lightboxImages.length; if (lightboxImg) lightboxImg.src = lightboxImages[lightboxIndex]; }

    document.getElementById('lightboxClose')?.addEventListener('click', closeLightbox);
    document.getElementById('lightboxPrev')?.addEventListener('click', prevImage);
    document.getElementById('lightboxNext')?.addEventListener('click', nextImage);

    document.addEventListener('keydown', e => {
        if (lightboxEl && !lightboxEl.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        }
    });

    // === FORM HANDLER ===
    window.handleFormSubmit = async function (form) {
        const btn = form.querySelector('[data-submit-btn]');
        const btnText = btn ? btn.querySelector('[data-submit-text]') : null;
        const btnLoading = btn ? btn.querySelector('[data-submit-loading]') : null;
        const errorEl = form.querySelector('[data-form-errors]');
        if (btn) btn.disabled = true;
        if (btnText) btnText.classList.add('hidden');
        if (btnLoading) btnLoading.classList.remove('hidden');
        if (errorEl) errorEl.innerHTML = '';
        try {
            const response = await fetch(form.action, {
                method: 'POST', body: new FormData(form),
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (response.ok) {
                form.reset();
                const success = form.querySelector('[data-form-success]');
                if (success) { success.classList.remove('hidden'); setTimeout(() => success.classList.add('hidden'), 3000); }
            } else if (response.status === 422) {
                const json = await response.json();
                if (errorEl && json.errors) errorEl.innerHTML = Object.values(json.errors).flat().map(m => `<p class="text-sm text-error-600 mt-1">${m}</p>`).join('');
            }
        } catch {
            if (errorEl) errorEl.innerHTML = '<p class="text-sm text-error-600 mt-1">Terjadi kesalahan. Silakan coba lagi.</p>';
        } finally {
            if (btn) btn.disabled = false;
            if (btnText) btnText.classList.remove('hidden');
            if (btnLoading) btnLoading.classList.add('hidden');
        }
    };

    // === SCROLL REVEAL ===
    const revealSections = document.querySelectorAll('[data-scroll-reveal]');
    if (revealSections.length) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.reveal').forEach(el => el.classList.add('animate-in'));
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        revealSections.forEach(section => observer.observe(section));
    }

    // === MODAL ===
    window.openModal = function (name) {
        const el = document.querySelector(`[data-modal="${name}"]`);
        if (!el) return;
        el.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const first = el.querySelector('input, button, textarea, select, a[href]');
        if (first) setTimeout(() => first.focus(), 100);
        const handler = e => {
            if (e.key === 'Escape') window.closeModal(name);
            if (e.key === 'Tab') {
                const all = el.querySelectorAll('input, button, textarea, select, a[href]');
                if (!all.length) return;
                if (e.shiftKey && document.activeElement === all[0]) { e.preventDefault(); all[all.length - 1].focus(); }
                else if (!e.shiftKey && document.activeElement === all[all.length - 1]) { e.preventDefault(); all[0].focus(); }
            }
        };
        el._keydownHandler = handler;
        document.addEventListener('keydown', handler);
    };

    window.closeModal = function (name) {
        const el = document.querySelector(`[data-modal="${name}"]`);
        if (!el) return;
        el.classList.add('hidden');
        document.body.style.overflow = '';
        if (el._keydownHandler) document.removeEventListener('keydown', el._keydownHandler);
    };

    document.querySelectorAll('[data-modal-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('[data-modal]');
            if (modal) window.closeModal(modal.dataset.modal);
        });
    });
    document.querySelectorAll('[data-modal-trigger]').forEach(btn => {
        btn.addEventListener('click', () => window.openModal(btn.dataset.modalTrigger));
    });

    // === ADMIN SIDEBAR ===
    window.toggleSidebar = function () {
        document.getElementById('adminSidebar')?.classList.toggle('hidden');
        document.getElementById('sidebarOverlay')?.classList.toggle('hidden');
    };

    // === FLASH MESSAGE ===
    document.querySelectorAll('[data-auto-hide]').forEach(el => setTimeout(() => el.classList.add('hidden'), 2000));

    // === FILE SIZE VALIDATION ===
    document.querySelectorAll('[data-file-size]').forEach(input => {
        input.addEventListener('change', function () {
            const el = document.getElementById(this.dataset.fileSize);
            if (el) el.classList.toggle('hidden', (this.files[0]?.size || 0) <= 2097152);
        });
    });

    // === ADMIN DROPDOWN ===
    document.querySelectorAll('[data-dropdown-container]').forEach(container => {
        const trigger = container.querySelector('[data-dropdown-trigger]');
        const content = container.querySelector('[data-dropdown-content]');
        if (trigger && content) {
            trigger.addEventListener('click', e => {
                e.stopPropagation();
                content.classList.toggle('hidden');
                document.addEventListener('click', () => content.classList.add('hidden'), { once: true });
            });
        }
    });
});
