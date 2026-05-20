(function () {
  "use strict";

  function q(sel, root) {
    return (root || document).querySelector(sel);
  }
  function qa(sel, root) {
    return Array.from((root || document).querySelectorAll(sel));
  }

  const menuRoot = q("#layout-menu");
  const menuInner = q("#layout-menu .menu-inner");
  if (!menuRoot || !menuInner) return;

  const filterInput = q("#adminMenuFilter");
  const filterClear = q("#adminMenuFilterClear");
  const noResults = q("#adminMenuNoResults");
  const topSearch = q("#adminTopSearch");
  const miniToggle = q("#adminMenuMiniToggle");

  function normalize(s) {
    return (s || "").toString().toLowerCase().replace(/\s+/g, " ").trim();
  }

  function setNoResultsVisible(visible) {
    if (!noResults) return;
    noResults.classList.toggle("d-none", !visible);
  }

  function itemLabelText(menuItem) {
    const link = q(":scope > a.menu-link", menuItem);
    if (!link) return "";
    return normalize(link.textContent);
  }

  function filterMenu(query) {
    const qn = normalize(query);
    const menuHeaders = qa(".menu-header", menuInner);
    const menuItems = qa(".menu-item", menuInner);

    // reset
    menuItems.forEach((mi) => mi.classList.remove("admin-menu-hidden"));
    menuHeaders.forEach((h) => h.classList.remove("admin-menu-hidden"));
    setNoResultsVisible(false);

    if (!qn) {
      if (filterClear) filterClear.classList.add("d-none");
      return;
    }
    if (filterClear) filterClear.classList.remove("d-none");

    let visibleCount = 0;

    menuItems.forEach((mi) => {
      const hasSub = !!q(":scope > ul.menu-sub", mi);
      const label = itemLabelText(mi);
      let match = label.includes(qn);

      if (hasSub) {
        const subs = qa(":scope > ul.menu-sub > .menu-item", mi);
        let anyChild = false;
        subs.forEach((child) => {
          const clabel = itemLabelText(child);
          const cmatch = clabel.includes(qn);
          child.classList.toggle("admin-menu-hidden", !cmatch && !match);
          if (cmatch) anyChild = true;
        });

        // tampilkan parent kalau match atau ada child match
        match = match || anyChild;

        // auto open jika ada child match (agar terlihat)
        if (anyChild) mi.classList.add("open");
      }

      mi.classList.toggle("admin-menu-hidden", !match);
      if (match) visibleCount++;
    });

    // hide headers yang tidak punya item visible di section-nya
    menuHeaders.forEach((header) => {
      let el = header.nextElementSibling;
      let anyVisible = false;
      while (el && !el.classList.contains("menu-header")) {
        if (el.classList.contains("menu-item") && !el.classList.contains("admin-menu-hidden")) {
          anyVisible = true;
          break;
        }
        el = el.nextElementSibling;
      }
      header.classList.toggle("admin-menu-hidden", !anyVisible);
    });

    setNoResultsVisible(visibleCount === 0);
  }

  function syncInputs(from, to) {
    if (!from || !to) return;
    to.value = from.value;
  }

  // Events: sidebar filter
  if (filterInput) {
    filterInput.addEventListener("input", () => {
      syncInputs(filterInput, topSearch);
      filterMenu(filterInput.value);
    });
  }
  if (topSearch) {
    topSearch.addEventListener("input", () => {
      syncInputs(topSearch, filterInput);
      filterMenu(topSearch.value);
    });
  }
  if (filterClear) {
    filterClear.addEventListener("click", () => {
      if (filterInput) filterInput.value = "";
      if (topSearch) topSearch.value = "";
      filterMenu("");
      if (filterInput) filterInput.focus();
    });
  }

  // Shortcut: Ctrl+K atau "/" fokus search
  document.addEventListener("keydown", (e) => {
    const isInput =
      e.target &&
      (e.target.tagName === "INPUT" ||
        e.target.tagName === "TEXTAREA" ||
        e.target.isContentEditable);
    if (isInput) return;

    if ((e.ctrlKey && (e.key === "k" || e.key === "K")) || e.key === "/") {
      e.preventDefault();
      (topSearch || filterInput)?.focus();
    }
  });

  // Mini sidebar toggle (desktop)
  const MINI_KEY = "admin_menu_mini";
  function setMini(val) {
    document.documentElement.classList.toggle("admin-menu-mini", !!val);
    try {
      localStorage.setItem(MINI_KEY, val ? "1" : "0");
    } catch (_) {}
  }
  try {
    setMini(localStorage.getItem(MINI_KEY) === "1");
  } catch (_) {}

  if (miniToggle) {
    miniToggle.addEventListener("click", (e) => {
      e.preventDefault();
      const next = !document.documentElement.classList.contains("admin-menu-mini");
      setMini(next);
    });
  }
})();

