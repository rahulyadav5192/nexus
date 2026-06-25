/* NEXUS GROUP HOLDINGS — interactions */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Nav scroll state */
  var nav = document.querySelector('.nav');
  function onScroll(){ if(nav) nav.classList.toggle('scrolled', window.scrollY > 30); }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* Mobile menu */
  var toggle = document.querySelector('.nav-toggle');
  var menu = document.querySelector('.mobile-menu');
  if (toggle && menu) {
    menu.setAttribute('role', 'dialog');
    menu.setAttribute('aria-modal', 'true');
    var focusableElements = 'a[href], button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])';

    toggle.addEventListener('click', function () {
      var open = menu.classList.toggle('open');
      nav.classList.toggle('open', open);
      document.body.style.overflow = open ? 'hidden' : '';
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) {
        menu.querySelectorAll('a').forEach(function (a, i) { a.style.transitionDelay = (0.1 + i * 0.05) + 's'; });
        var firstFocusable = menu.querySelectorAll(focusableElements)[0];
        if (firstFocusable) { setTimeout(function() { firstFocusable.focus(); }, 100); }
      } else {
        toggle.focus();
      }
    });

    menu.addEventListener('keydown', function(e) {
      if (e.key !== 'Tab') return;
      var focusable = Array.from(menu.querySelectorAll(focusableElements)).filter(function(el) { return el.offsetParent !== null; });
      if (!focusable.length) return;
      var first = focusable[0], last = focusable[focusable.length - 1];
      if (e.shiftKey) {
        if (document.activeElement === first) { last.focus(); e.preventDefault(); }
      } else {
        if (document.activeElement === last) { first.focus(); e.preventDefault(); }
      }
    });

    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        menu.classList.remove('open'); nav.classList.remove('open'); document.body.style.overflow = '';
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
      });
    });
  }

  /* Scroll reveals */
  var reveals = document.querySelectorAll('.reveal');
  if (reduce || !('IntersectionObserver' in window)) {
    reveals.forEach(function (el) { el.classList.add('in'); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  }

  /* Number counters */
  function animateCount(el) {
    var target = parseFloat(el.getAttribute('data-count'));
    var pad = el.getAttribute('data-pad') === 'true';
    var dur = 900, start = null;
    function step(t) {
      if (!start) start = t;
      var p = Math.min((t - start) / dur, 1), eased = 1 - Math.pow(1 - p, 3), val = Math.floor(eased * target);
      el.textContent = pad && val < 10 ? '0' + val : val;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = pad && target < 10 ? '0' + target : target;
    }
    requestAnimationFrame(step);
  }
  var counters = document.querySelectorAll('[data-count]');
  if (reduce || !('IntersectionObserver' in window)) {
    counters.forEach(function (el) { var t = el.getAttribute('data-count'); el.textContent = (el.getAttribute('data-pad') === 'true' && t < 10) ? '0' + t : t; });
  } else {
    var cio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { animateCount(e.target); cio.unobserve(e.target); } });
    }, { threshold: 0.6 });
    counters.forEach(function (el) { cio.observe(el); });
  }

  /* Timeline progress */
  var timeline = document.querySelector('.timeline-track');
  if (timeline) {
    var prog = timeline.querySelector('.progress');
    var tio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { if (prog) prog.style.width = '70%'; tio.disconnect(); } });
    }, { threshold: 0.3 });
    tio.observe(timeline);
  }

  /* Projection bars */
  var projBars = document.querySelectorAll('.proj-bar span');
  if (projBars.length) {
    var run = function(){ projBars.forEach(function (b) { b.style.width = (b.getAttribute('data-w') || '0') + '%'; }); };
    if (reduce || !('IntersectionObserver' in window)) run();
    else { var pio = new IntersectionObserver(function (en) { en.forEach(function (e) { if (e.isIntersecting) { run(); pio.disconnect(); } }); }, { threshold: 0.4 }); pio.observe(projBars[0].closest('.proj')); }
  }

  /* Category filters */
  document.querySelectorAll('.filters[data-target]').forEach(function (bar) {
    var items = document.querySelectorAll(bar.getAttribute('data-target'));
    bar.querySelectorAll('.filter-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        bar.querySelectorAll('.filter-btn').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        var cat = btn.getAttribute('data-cat');
        items.forEach(function (it) { it.classList.toggle('hidden', !(cat === 'all' || it.getAttribute('data-cat') === cat)); });
      });
    });
  });

  /* Magnetic island buttons */
  if (!reduce && window.matchMedia('(pointer:fine)').matches) {
    document.querySelectorAll('.btn').forEach(function (b) {
      b.addEventListener('pointermove', function (e) {
        var r = b.getBoundingClientRect();
        b.style.transform = 'translate(' + ((e.clientX - r.left - r.width / 2) * 0.18).toFixed(1) + 'px,' + ((e.clientY - r.top - r.height / 2) * 0.3).toFixed(1) + 'px)';
      });
      b.addEventListener('pointerleave', function () { b.style.transform = ''; });
    });
  }

  /* Contact form */
  var form = document.getElementById('contactForm');
  if (form) {
    var msg = document.getElementById('formMsg');
    var submitUrl = form.getAttribute('action');
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (msg) msg.setAttribute('role', 'alert');
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var firstInvalid = null;
      if (!form.name.value.trim()) firstInvalid = firstInvalid || form.name;
      if (!form.email.value.trim()) firstInvalid = firstInvalid || form.email;
      if (!form.message.value.trim()) firstInvalid = firstInvalid || form.message;

      if (firstInvalid) {
        msg.style.color = 'var(--bronze)';
        msg.textContent = 'Please complete your name, email and message.';
        firstInvalid.focus();
        return;
      }

      if (!submitUrl || !csrfMeta) {
        msg.style.color = 'var(--bronze)';
        msg.textContent = 'Unable to submit the form right now. Please try again later.';
        return;
      }

      var submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;
      msg.style.color = 'var(--bone-dim)';
      msg.textContent = 'Sending your enquiry…';

      var fd = new FormData(form);
      if (!fd.get('subject')) fd.set('subject', 'General Enquiry');

      fetch(submitUrl, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfMeta.getAttribute('content'),
          'Accept': 'application/json',
        },
        body: fd,
      })
        .then(function (res) { return res.json().then(function (data) { return { ok: res.ok, data: data }; }); })
        .then(function (result) {
          if (result.ok && result.data.success) {
            msg.style.color = 'var(--gold)';
            msg.textContent = result.data.message || 'Thank you! Your enquiry has been received.';
            form.reset();
            return;
          }
          var errors = result.data && result.data.errors;
          if (errors) {
            var firstKey = Object.keys(errors)[0];
            throw new Error(errors[firstKey][0]);
          }
          throw new Error((result.data && result.data.message) || 'Something went wrong. Please try again.');
        })
        .catch(function (err) {
          msg.style.color = 'var(--bronze)';
          msg.textContent = err.message || 'Something went wrong. Please try again.';
        })
        .finally(function () {
          if (submitBtn) submitBtn.disabled = false;
        });
    });
  }

  /* Careers apply + form */
  document.querySelectorAll('[data-apply]').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      var sel = document.getElementById('a-position');
      if (sel) { var o = [].slice.call(sel.options).find(function (x) { return x.value === btn.getAttribute('data-apply'); }); if (o) sel.value = btn.getAttribute('data-apply'); }
      var af = document.getElementById('applyForm');
      if (af) { 
        var n = document.getElementById('a-name'); 
        if (n) {
          var onScrollEnd = function() { n.focus(); window.removeEventListener('scrollend', onScrollEnd); };
          window.addEventListener('scrollend', onScrollEnd);
        }
        af.scrollIntoView({ behavior: 'smooth', block: 'center' }); 
      }
    });
  });
  var af = document.getElementById('applyForm');
  if (af) {
    var amsg = document.getElementById('applyMsg');
    if (amsg) amsg.setAttribute('role', 'alert');
    af.addEventListener('submit', function (e) {
      e.preventDefault();
      var firstInvalid = null;
      if (!af.name.value.trim()) firstInvalid = firstInvalid || af.name;
      if (!af.email.value.trim()) firstInvalid = firstInvalid || af.email;
      
      if (firstInvalid) { 
        amsg.style.color = 'var(--bronze)'; amsg.textContent = 'Please add your name and email.'; 
        firstInvalid.focus();
        return; 
      }
      var body = 'Name: ' + af.name.value.trim() + '%0D%0A' + 'Email: ' + af.email.value.trim() + '%0D%0A'
        + 'Phone: ' + af.phone.value.trim() + '%0D%0A' + 'Position: ' + (af.position.value || '—') + '%0D%0A%0D%0A' + encodeURIComponent(af.message.value.trim());
      window.location.href = 'mailto:info@nexusgroupholdings.com?subject=' + encodeURIComponent('Career application — ' + (af.position.value || 'General') + ' — ' + af.name.value.trim()) + '&body=' + body;
      amsg.style.color = 'var(--gold)'; amsg.textContent = 'Opening your email client… if nothing happens, write to info@nexusgroupholdings.com'; af.reset();
    });
  }

  /* Footer year */
  var yr = document.getElementById('year');
  if (yr) yr.textContent = new Date().getFullYear();
})();
