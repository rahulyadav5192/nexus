(function () {
  const wm = document.getElementById("page-watermark");
  const hero = document.getElementById("hero");
  const privacy = document.getElementById("privacy-section");

  if (!wm || !hero) return;

  let heroBottom = 0;
  let privacyBottom = document.body.scrollHeight;

  function recalc() {
    const hRect = hero.getBoundingClientRect();
    heroBottom =
      window.scrollY +
      hRect.height +
      hero.offsetTop -
      (hero.offsetHeight - hRect.height);
    // fallback: if privacy not found, use document height
    if (privacy) {
      privacyBottom = privacy.offsetTop + privacy.offsetHeight;
    } else {
      privacyBottom = document.body.scrollHeight;
    }
  }

  // simpler reliable calc
  function recalcSimple() {
    heroBottom = hero.offsetTop + hero.offsetHeight - 200;
    privacyBottom = privacy
      ? privacy.offsetTop + privacy.offsetHeight
      : document.body.scrollHeight;
  }

  recalcSimple();
  window.addEventListener("resize", () => recalcSimple());

  let ticking = false;
  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      const scrollY = window.scrollY || window.pageYOffset;
      // show watermark after hero ends and until privacy section ends
      if (scrollY >= heroBottom && scrollY < privacyBottom - 600) {
        wm.classList.add("visible");
      } else {
        wm.classList.remove("visible");
      }
      ticking = false;
    });
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  // initial state
  onScroll();
})();
