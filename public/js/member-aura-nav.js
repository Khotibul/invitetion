(function () {
  "use strict";

  function q(selector, root) {
    return (root || document).querySelector(selector);
  }

  function qa(selector, root) {
    return Array.from((root || document).querySelectorAll(selector));
  }

  var nav = q("#memberAuraNav");
  var mobile = q("#memberAuraMobile");
  var openBtn = q("#memberAuraMobileOpen");
  var closeBtn = q("#memberAuraMobileClose");
  var lastFocus = null;

  function onScroll() {
    if (!nav) return;
    nav.classList.toggle("scrolled", window.scrollY > 16);
  }

  function openMobile() {
    if (!mobile) return;
    lastFocus = document.activeElement;
    mobile.classList.add("open");
    mobile.setAttribute("aria-hidden", "false");
    document.body.classList.add("member-aura-lock");
    if (closeBtn) closeBtn.focus();
  }

  function closeMobile() {
    if (!mobile) return;
    mobile.classList.remove("open");
    mobile.setAttribute("aria-hidden", "true");
    document.body.classList.remove("member-aura-lock");
    if (lastFocus && typeof lastFocus.focus === "function") lastFocus.focus();
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  if (openBtn) {
    openBtn.addEventListener("click", function (event) {
      event.preventDefault();
      openMobile();
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", function (event) {
      event.preventDefault();
      closeMobile();
    });
  }

  if (mobile) {
    mobile.addEventListener("click", function (event) {
      if (event.target === mobile) closeMobile();
    });
  }

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") closeMobile();
  });

  qa("[data-member-aura-close]").forEach(function (element) {
    element.addEventListener("click", closeMobile);
  });
})();
