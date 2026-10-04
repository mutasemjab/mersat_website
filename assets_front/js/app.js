(() => {
  'use strict';

  const $ = (s, root = document) => root.querySelector(s);
  const $$ = (s, root = document) => [...root.querySelectorAll(s)];
  const rtl = document.documentElement.dir === 'rtl';
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ───────── HEADER: shadow when scrolled, hides while scrolling down ───────── */
  const header = $('#nav');
  const stt = $('#stt');
  let lastY = scrollY;
  const onScroll = () => {
    const y = scrollY;
    header.classList.toggle('is-scrolled', y > 20);
    if (!document.body.classList.contains('menu-open')) {
      header.classList.toggle('is-hidden', y > lastY && y > 400);
    }
    stt && stt.classList.toggle('show', y > 600);
    lastY = y;
  };
  addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  const toTop = () => scrollTo({ top: 0, behavior: 'smooth' });
  stt && stt.addEventListener('click', toTop);
  $$('[data-top]').forEach(b => b.addEventListener('click', toTop));

  /* ───────── MOBILE MENU ───────── */
  const menu = $('#mobile-menu');
  const toggle = $('.menu-toggle');
  const setMenu = open => {
    document.body.classList.toggle('menu-open', open);
    toggle.setAttribute('aria-expanded', open);
    if (open) {
      menu.hidden = false;
      requestAnimationFrame(() => menu.classList.add('is-open'));
      header.classList.remove('is-hidden');
    } else {
      menu.classList.remove('is-open');
      setTimeout(() => { if (!menu.classList.contains('is-open')) menu.hidden = true; }, 350);
    }
  };
  if (menu && toggle) {
    toggle.addEventListener('click', () => setMenu(!document.body.classList.contains('menu-open')));
    $$('a', menu).forEach(a => a.addEventListener('click', () => setMenu(false)));
    addEventListener('keydown', e => { if (e.key === 'Escape' && document.body.classList.contains('menu-open')) setMenu(false); });
    matchMedia('(min-width: 1121px)').addEventListener('change', e => { if (e.matches) setMenu(false); });
  }

  /* ───────── ACTIVE LINK WHILE SCROLLING (home) ───────── */
  const spyLinks = $$('[data-spy]');
  if (spyLinks.length && 'IntersectionObserver' in window) {
    const spy = new IntersectionObserver(entries => {
      entries.forEach(en => {
        if (en.isIntersecting) spyLinks.forEach(a => a.classList.toggle('is-current', a.dataset.spy === en.target.id));
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    spyLinks.forEach(a => { const s = document.getElementById(a.dataset.spy); s && spy.observe(s); });
  }

  /* ───────── HERO SLIDER ───────── */
  const hero = $('#hero');
  if (hero) {
    const slides = $$('.hero-slide', hero);
    const texts = $$('.hero-text', hero);
    const dots = $$('.hero-dot', hero);
    const cur = $('.hc-cur', hero);
    const interval = Number(hero.dataset.interval) || 5000;
    let index = 0;
    let timer = null;
    let paused = false;

    const playVideo = (slide, on) => {
      const v = $('video', slide);
      if (!v) return;
      if (on) { v.currentTime = 0; v.play().catch(() => {}); } else v.pause();
    };

    const go = i => {
      if (slides.length < 2) return;
      const next = (i + slides.length) % slides.length;
      if (next === index) return;
      [slides, texts].forEach(list => {
        list[index].classList.remove('is-active');
        list[index].setAttribute('aria-hidden', 'true');
        list[next].classList.add('is-active');
        list[next].setAttribute('aria-hidden', 'false');
      });
      playVideo(slides[index], false);
      playVideo(slides[next], true);
      dots.forEach((d, k) => {
        d.classList.toggle('is-active', k === next);
        d.classList.toggle('is-done', k < next);
      });
      // restart the progress animation of the active dot
      const bar = dots[next] && $('i', dots[next]);
      if (bar) { bar.style.animation = 'none'; bar.offsetWidth; bar.style.animation = ''; }
      if (cur) cur.textContent = String(next + 1).padStart(2, '0');
      index = next;
      schedule();
    };

    const schedule = () => {
      clearTimeout(timer);
      if (!paused && !reduceMotion && slides.length > 1) timer = setTimeout(() => go(index + 1), interval);
    };
    const pause = on => { paused = on; hero.classList.toggle('is-paused', on); schedule(); };

    dots.forEach((d, k) => d.addEventListener('click', () => go(k)));
    $$('.hero-arrow', hero).forEach(b => b.addEventListener('click', () => go(index + Number(b.dataset.dir))));
    hero.addEventListener('mouseenter', () => matchMedia('(hover: hover)').matches && pause(true));
    hero.addEventListener('mouseleave', () => pause(false));
    document.addEventListener('visibilitychange', () => pause(document.hidden));

    // swipe
    let x0 = null, y0 = null;
    hero.addEventListener('touchstart', e => { x0 = e.touches[0].clientX; y0 = e.touches[0].clientY; }, { passive: true });
    hero.addEventListener('touchend', e => {
      if (x0 === null) return;
      const dx = e.changedTouches[0].clientX - x0, dy = e.changedTouches[0].clientY - y0;
      if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) go(index + ((dx < 0) !== rtl ? 1 : -1));
      x0 = null;
    }, { passive: true });

    // keyboard, while the banner is on screen
    addEventListener('keydown', e => {
      if (!['ArrowLeft', 'ArrowRight'].includes(e.key) || !$('#lightbox').hidden || hero.getBoundingClientRect().bottom < 0) return;
      const forward = (e.key === 'ArrowRight') !== rtl;
      go(index + (forward ? 1 : -1));
    });

    playVideo(slides[0], true);
    schedule();
  }

  /* ───────── REVEAL ON SCROLL ───────── */
  const revealEls = $$('.r');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => entries.forEach(en => {
      if (en.isIntersecting) { en.target.classList.add('v'); io.unobserve(en.target); }
    }), { threshold: .12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(el => io.observe(el));
  } else revealEls.forEach(el => el.classList.add('v'));

  /* ───────── COUNTERS ───────── */
  $$('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count, 10) || 0;
    if (reduceMotion || !('IntersectionObserver' in window)) return;
    el.textContent = '0';
    const io = new IntersectionObserver(([en]) => {
      if (!en.isIntersecting) return;
      io.disconnect();
      const t0 = performance.now(), dur = 1600;
      const step = t => {
        const p = Math.min((t - t0) / dur, 1);
        el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    }, { threshold: .6 });
    io.observe(el);
  });

  /* ───────── VIDEOS THAT CAN'T LOAD get hidden so the image behind shows ───────── */
  $$('video').forEach(v => {
    const srcs = $$('source', v);
    const fail = () => v.classList.add('failed');
    if (srcs.length) srcs[srcs.length - 1].addEventListener('error', fail);
    else if (v.getAttribute('src')) v.addEventListener('error', fail);
  });

  /* ───────── CLIENT CARDS: hover video ───────── */
  if (matchMedia('(hover: hover)').matches) {
    $$('.client-card').forEach(card => {
      const v = $('[data-hover-video]', card);
      if (!v) return;
      card.addEventListener('mouseenter', () => v.play().then(() => v.classList.add('playing')).catch(() => {}));
      card.addEventListener('mouseleave', () => { v.pause(); v.classList.remove('playing'); });
    });
  }

  /* ───────── WORK FILTERS (all / photos / videos) ───────── */
  $$('.filter-tabs').forEach(tabs => {
    const grid = tabs.closest('.container').querySelector('.work-grid');
    if (!grid) return;
    $$('button', tabs).forEach(btn => btn.addEventListener('click', () => {
      $$('button', tabs).forEach(b => b.classList.toggle('is-active', b === btn));
      $$('.work-item', grid).forEach(it => {
        it.classList.toggle('is-filtered', btn.dataset.filter !== 'all' && it.dataset.kind !== btn.dataset.filter);
        it.classList.add('v');
      });
    }));
  });

  /* ───────── CLIENT LOGOS: one row; still and centred when every logo fits, scrolling otherwise ───────── */
  $$('.logo-marquee').forEach(mq => {
    const row = $('.logo-row', mq);
    const cards = $$('.logo-card:not([data-copy])', mq);
    const fit = () => {
      const gap = parseFloat(getComputedStyle($('.logo-track', mq)).columnGap) || 0;
      const needed = cards.reduce((w, c) => w + c.offsetWidth, 0) + gap * (cards.length - 1);
      mq.classList.toggle('is-static', needed <= row.clientWidth - 64);
    };
    fit();
    addEventListener('resize', fit, { passive: true });
  });

  /* ───────── WORLD MAP: hovering a location lights its country ───────── */
  const wmap = $('.world-map-svg');
  if (wmap) {
    $$('.g-loc[data-cc]').forEach(loc => {
      const els = $$('[data-cc="' + loc.dataset.cc + '"]', wmap);
      loc.addEventListener('mouseenter', () => els.forEach(el => el.classList.add('hl')));
      loc.addEventListener('mouseleave', () => els.forEach(el => el.classList.remove('hl')));
    });
  }

  /* ───────── LIGHTBOX (images, video files, YouTube / Vimeo) ───────── */
  const lb = $('#lightbox');
  if (lb) {
    const stage = $('.lb-stage', lb), caption = $('.lb-caption', lb), count = $('.lb-count', lb);
    let items = [], pos = 0, opener = null;

    const render = () => {
      const it = items[pos];
      stage.innerHTML = '';
      let el;
      if (it.dataset.type === 'image') {
        el = document.createElement('img');
        el.src = it.dataset.src;
        el.alt = it.dataset.caption || '';
      } else if (it.dataset.type === 'video') {
        el = document.createElement('video');
        el.src = it.dataset.src;
        el.controls = true;
        el.autoplay = true;
        el.playsInline = true;
      } else {
        el = document.createElement('iframe');
        el.src = it.dataset.src + (it.dataset.src.includes('?') ? '&' : '?') + 'autoplay=1&rel=0';
        el.allow = 'autoplay; encrypted-media; picture-in-picture; fullscreen';
        el.allowFullscreen = true;
        el.title = it.dataset.caption || '';
      }
      stage.appendChild(el);
      caption.textContent = it.dataset.caption || '';
      count.textContent = items.length > 1 ? (pos + 1) + ' / ' + items.length : '';
      $$('.lb-prev, .lb-next', lb).forEach(b => b.hidden = items.length < 2);
    };

    const open = btn => {
      items = $$('[data-lightbox]').filter(b => !b.closest('.is-filtered'));
      pos = Math.max(items.indexOf(btn), 0);
      opener = btn;
      lb.hidden = false;
      requestAnimationFrame(() => lb.classList.add('is-open'));
      document.body.style.overflow = 'hidden';
      render();
      $('.lb-close', lb).focus();
    };
    const close = () => {
      lb.classList.remove('is-open');
      stage.innerHTML = '';
      document.body.style.overflow = '';
      setTimeout(() => { lb.hidden = true; }, 250);
      opener && opener.focus();
    };
    const move = d => { pos = (pos + d + items.length) % items.length; render(); };

    document.addEventListener('click', e => {
      const btn = e.target.closest('[data-lightbox]');
      if (btn) { e.preventDefault(); open(btn); }
    });
    $('.lb-close', lb).addEventListener('click', close);
    $('.lb-prev', lb).addEventListener('click', () => move(-1));
    $('.lb-next', lb).addEventListener('click', () => move(1));
    lb.addEventListener('click', e => { if (e.target === lb || e.target === stage) close(); });
    addEventListener('keydown', e => {
      if (lb.hidden) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowRight') move(rtl ? -1 : 1);
      if (e.key === 'ArrowLeft') move(rtl ? 1 : -1);
    });
    let lx = null;
    lb.addEventListener('touchstart', e => { lx = e.touches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend', e => {
      if (lx === null || items.length < 2) return;
      const dx = e.changedTouches[0].clientX - lx;
      if (Math.abs(dx) > 50) move((dx < 0) !== rtl ? 1 : -1);
      lx = null;
    }, { passive: true });
  }

  /* ───────── CONTACT FORM (falls back to a normal POST without JavaScript) ───────── */
  const cform = $('#contact-form');
  if (cform) {
    const btn = $('#sbtn'), msg = $('#form-msg');
    const show = (text, ok) => { msg.textContent = text; msg.className = 'form-msg ' + (ok ? 'ok' : 'err'); };
    cform.addEventListener('submit', async e => {
      e.preventDefault();
      btn.disabled = true;
      btn.textContent = cform.dataset.sending;
      try {
        const res = await fetch(cform.action, { method: 'POST', body: new FormData(cform), headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
        const data = await res.json().catch(() => ({}));
        if (res.ok) { show(data.message, true); cform.reset(); }
        else if (res.status === 422 && data.errors) show(Object.values(data.errors)[0][0], false);
        else show(cform.dataset.error, false);
      } catch (err) { show(cform.dataset.error, false); }
      btn.disabled = false;
      btn.textContent = cform.dataset.label;
    });
  }
})();
