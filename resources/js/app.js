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

    // Mega menu desktop (คลิกเปิด/ปิด แบบ theeraphong)
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

    // เมนูมือถือ
    const root = document.querySelector('[data-mobile-nav]');
    if (root) {
        const toggle = root.querySelector('[data-mobile-nav-toggle]');
        const panel = root.querySelector('[data-mobile-nav-panel]');
        const links = root.querySelectorAll('[data-mobile-nav-link]');

        if (toggle && panel) {
            const setOpen = (open) => {
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                toggle.setAttribute('aria-label', open ? 'ปิดเมนู' : 'เปิดเมนู');
                panel.hidden = ! open;
                panel.classList.toggle('hidden', ! open);
                document.documentElement.classList.toggle('overflow-hidden', open);
            };

            toggle.addEventListener('click', () => {
                setOpen(toggle.getAttribute('aria-expanded') !== 'true');
            });

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

    // Bottom CTA — แสดงหลังเลื่อนพ้น hero (มือถือ)
    const bar = document.querySelector('[data-mobile-cta]');
    const updateBar = () => {
        if (! bar) return;

        const isMobile = window.innerWidth < 1100;
        const hero = document.getElementById('top');
        const past = window.scrollY > (hero ? hero.offsetHeight - 80 : 400);
        const show = isMobile && past;

        bar.hidden = ! show;
        bar.classList.toggle('hidden', ! show);
        bar.classList.toggle('flex', show);
    };

    // ปุ่มกลับขึ้นบน
    const toTop = document.querySelector('[data-to-top]');
    const updateToTop = () => {
        if (! toTop) return;

        const show = window.scrollY > 400;
        toTop.hidden = ! show;
        toTop.classList.toggle('hidden', ! show);
        toTop.classList.toggle('grid', show);
    };

    toTop?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const onScrollOrResize = () => {
        updateBar();
        updateToTop();
    };

    window.addEventListener('scroll', onScrollOrResize, { passive: true });
    window.addEventListener('resize', onScrollOrResize);
    onScrollOrResize();
})();
