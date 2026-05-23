(function () {
  "use strict";

  function q(sel, root) {
    return (root || document).querySelector(sel);
  }
  function qa(sel, root) {
    return Array.from((root || document).querySelectorAll(sel));
  }

  const nav = q("#auraNav");
  function onScroll() {
    if (!nav) return;
    nav.classList.toggle("scrolled", window.scrollY > 16);
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // Active section highlight (desktop nav)
  const sectionIds = ["features", "templates", "pricing", "showcase"];
  const sectionEls = sectionIds.map((id) => q("#" + id)).filter(Boolean);
  const navSectionLinks = sectionIds
    .map((id) => q('.aura-links a[href="#' + id + '"]'))
    .filter(Boolean);

  function updateActiveLink() {
    if (!navSectionLinks.length || !sectionEls.length) return;
    const y = window.scrollY + 110;
    let currentId = sectionEls[0].id;
    for (const el of sectionEls) {
      if (el.offsetTop <= y) currentId = el.id;
    }
    navSectionLinks.forEach((a) => {
      a.classList.toggle("active", a.getAttribute("href") === "#" + currentId);
    });
  }
  window.addEventListener("scroll", updateActiveLink, { passive: true });
  window.addEventListener("resize", updateActiveLink);
  updateActiveLink();

  // Mobile menu
  const mobile = q("#auraMobile");
  const openBtn = q("#auraMobileOpen");
  const closeBtn = q("#auraMobileClose");

  function openMobile() {
    if (!mobile) return;
    mobile.classList.add("open");
    mobile.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";
    closeBtn?.focus();
  }
  function closeMobile() {
    if (!mobile) return;
    mobile.classList.remove("open");
    mobile.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    openBtn?.focus();
  }

  openBtn?.addEventListener("click", (e) => {
    e.preventDefault();
    openMobile();
  });
  closeBtn?.addEventListener("click", (e) => {
    e.preventDefault();
    closeMobile();
  });
  mobile?.addEventListener("click", (e) => {
    if (e.target === mobile) closeMobile();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMobile();
  });
  qa("[data-aura-close]").forEach((el) => el.addEventListener("click", closeMobile));

  // Ctrl+K or / focus jump to templates
  document.addEventListener("keydown", (e) => {
    const isInput =
      e.target &&
      (e.target.tagName === "INPUT" ||
        e.target.tagName === "TEXTAREA" ||
        e.target.isContentEditable);
    if (isInput) return;
    if ((e.ctrlKey && (e.key === "k" || e.key === "K")) || e.key === "/") {
      const el = q("#templates");
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    }
  });

  // Reveal animation
  const revealEls = qa(".aura-reveal");
  if (revealEls.length) {
    if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      revealEls.forEach((el) => el.classList.add("is-visible"));
    } else if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver(
        (entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting) {
              // Animate progress bars when section becomes visible
              const bars = [];
              if (e.target?.hasAttribute?.("data-aura-progress")) bars.push(e.target);
              bars.push(...qa("[data-aura-progress]", e.target));
              bars.forEach((bar) => {
                const val = parseFloat(bar.getAttribute("data-aura-progress"));
                if (!Number.isFinite(val)) return;
                bar.style.width = Math.max(0, Math.min(100, val)) + "%";
              });
              e.target.classList.add("is-visible");
              io.unobserve(e.target);
            }
          });
        },
        { threshold: 0.12 }
      );
      revealEls.forEach((el) => io.observe(el));
    } else {
      revealEls.forEach((el) => el.classList.add("is-visible"));
    }
  }

  // Anchor offset (sticky nav)
  qa("a[href^='#']").forEach((a) => {
    a.addEventListener("click", (e) => {
      const href = a.getAttribute("href");
      if (!href || href === "#") return;
      const target = q(href);
      if (!target) return;
      e.preventDefault();
      const top = target.getBoundingClientRect().top + window.pageYOffset - 76;
      window.scrollTo({ top, behavior: "smooth" });
    });
  });
})();
