(() => {
    // Accordion ในเมนูมือถือ
    document.querySelectorAll('[data-nav-accordion]').forEach((item) => {
        const toggle = item.querySelector(':scope > [data-nav-accordion-toggle]');
        const panel = item.querySelector(':scope > [data-nav-accordion-panel]');
        const icon = item.querySelector(':scope > [data-nav-accordion-toggle] [data-nav-accordion-icon]');

        if (! toggle || ! panel) return;

        toggle.addEventListener('click', () => {
            const open = toggle.getAttribute('aria-expanded') !== 'true';
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            panel.hidden = ! open;
            panel.classList.toggle('hidden', ! open);
            icon?.classList.toggle('rotate-180', open);
        });
    });

    // Mega menu desktop
    const megaRoot = document.querySelector('[data-nav-mega]');
    const megaToggle = megaRoot?.querySelector('[data-nav-mega-toggle]');
    const megaPanel = document.querySelector('[data-nav-mega-panel]');
    const megaChevron = megaRoot?.querySelector('[data-nav-mega-chevron]');

    if (megaToggle && megaPanel) {
        const setMegaOpen = (open) => {
            megaToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            megaPanel.hidden = ! open;
            megaPanel.classList.toggle('hidden', ! open);
            megaChevron?.classList.toggle('rotate-180', open);
        };

        megaToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            setMegaOpen(megaToggle.getAttribute('aria-expanded') !== 'true');
        });

        megaPanel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => setMegaOpen(false));
        });

        document.addEventListener('click', (event) => {
            if (! megaPanel.hidden && ! megaPanel.contains(event.target) && ! megaToggle.contains(event.target)) {
                setMegaOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && megaToggle.getAttribute('aria-expanded') === 'true') {
                setMegaOpen(false);
                megaToggle.focus();
            }
        });

        window.matchMedia('(min-width: 1100px)').addEventListener('change', (event) => {
            if (! event.matches) setMegaOpen(false);
        });
    }

    // เมนูมือถือ — แผงทึบ + backdrop โปร่ง
    const root = document.querySelector('[data-mobile-nav]');
    let bodyScrollY = 0;

    if (root) {
        const toggle = root.querySelector('[data-mobile-nav-toggle]');
        const panel = root.querySelector('[data-mobile-nav-panel]');
        const backdrop = root.querySelector('[data-mobile-nav-backdrop]');
        const links = root.querySelectorAll('[data-mobile-nav-link]');

        if (toggle && panel) {
            const lockBody = (lock) => {
                if (lock) {
                    bodyScrollY = window.scrollY;
                    document.body.style.position = 'fixed';
                    document.body.style.top = `-${bodyScrollY}px`;
                    document.body.style.left = '0';
                    document.body.style.right = '0';
                    document.body.style.width = '100%';
                    document.documentElement.classList.add('overflow-hidden');
                } else {
                    document.body.style.position = '';
                    document.body.style.top = '';
                    document.body.style.left = '';
                    document.body.style.right = '';
                    document.body.style.width = '';
                    document.documentElement.classList.remove('overflow-hidden');
                    window.scrollTo(0, bodyScrollY);
                }
            };

            const setOpen = (open) => {
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                toggle.setAttribute('aria-label', open ? 'ปิดเมนู' : 'เปิดเมนู');
                panel.hidden = ! open;
                panel.classList.toggle('hidden', ! open);

                if (backdrop) {
                    backdrop.hidden = ! open;
                    backdrop.classList.toggle('hidden', ! open);
                    backdrop.setAttribute('aria-hidden', open ? 'false' : 'true');
                }

                lockBody(open);

                if (open) {
                    panel.scrollTop = 0;
                }

                updateToTop();
            };

            toggle.addEventListener('click', () => {
                setOpen(toggle.getAttribute('aria-expanded') !== 'true');
            });

            backdrop?.addEventListener('click', () => setOpen(false));

            links.forEach((link) => link.addEventListener('click', () => setOpen(false)));

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
                    setOpen(false);
                    toggle.focus();
                }
            });

            window.matchMedia('(min-width: 1100px)').addEventListener('change', (event) => {
                if (event.matches) setOpen(false);
            });
        }
    }

    // ปุ่มกลับขึ้นบน
    const toTop = document.querySelector('[data-to-top]');
    const updateToTop = () => {
        if (! toTop) return;

        const menuOpen = root
            ?.querySelector('[data-mobile-nav-toggle]')
            ?.getAttribute('aria-expanded') === 'true';
        const show = window.scrollY > 400 && ! menuOpen;

        toTop.hidden = ! show;
        toTop.classList.toggle('hidden', ! show);
        toTop.classList.toggle('grid', show);
    };

    toTop?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.addEventListener('scroll', updateToTop, { passive: true });
    window.addEventListener('resize', updateToTop);
    updateToTop();

    // Carousel ผลงานที่เกี่ยวข้อง
    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const track = carousel.querySelector('[data-carousel-track]');
        const section = carousel.closest('section');
        const prev = section?.querySelector('[data-carousel-prev]');
        const next = section?.querySelector('[data-carousel-next]');
        const nav = section?.querySelector('[data-carousel-nav]');

        if (! track) return;

        const scrollStep = () => {
            const slide = track.querySelector('[data-carousel-slide]');
            if (! slide) return track.clientWidth;

            const gap = Number.parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 16;

            return slide.offsetWidth + gap;
        };

        const updateNav = () => {
            const scrollable = track.scrollWidth > track.clientWidth + 2;

            if (nav) {
                nav.hidden = ! scrollable;
                nav.classList.toggle('hidden', ! scrollable);
            }

            if (! prev || ! next) return;

            const maxScroll = track.scrollWidth - track.clientWidth;
            prev.disabled = track.scrollLeft <= 2;
            next.disabled = track.scrollLeft >= maxScroll - 2;
        };

        prev?.addEventListener('click', () => {
            track.scrollBy({ left: -scrollStep(), behavior: 'smooth' });
        });

        next?.addEventListener('click', () => {
            track.scrollBy({ left: scrollStep(), behavior: 'smooth' });
        });

        track.addEventListener('scroll', updateNav, { passive: true });
        window.addEventListener('resize', updateNav);
        updateNav();
    });
})();
