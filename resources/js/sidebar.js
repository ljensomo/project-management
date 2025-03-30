const sidebar = document.getElementById("sidebar");

if (sidebar) {
  const toggleSidebarMobile = (
    sidebar,
    sidebarBackdrop,
    toggleSidebarMobileHamburger,
    toggleSidebarMobileClose
  ) => {
    if (
      sidebar &&
      sidebarBackdrop &&
      toggleSidebarMobileHamburger &&
      toggleSidebarMobileClose
    ) {
      sidebar.classList.toggle("hidden");
      sidebarBackdrop.classList.toggle("hidden");
      toggleSidebarMobileHamburger.classList.toggle("hidden");
      toggleSidebarMobileClose.classList.toggle("hidden");
    }
  };

  const toggleSidebarMobileEl = document.getElementById("toggleSidebarMobile");
  const sidebarBackdrop = document.getElementById("sidebarBackdrop");
  const toggleSidebarMobileHamburger = document.getElementById(
    "toggleSidebarMobileHamburger"
  );
  const toggleSidebarMobileClose = document.getElementById(
    "toggleSidebarMobileClose"
  );
  const toggleSidebarMobileSearch = document.getElementById(
    "toggleSidebarMobileSearch"
  );

  // Add event listeners only if elements exist
  if (toggleSidebarMobileSearch) {
    toggleSidebarMobileSearch.addEventListener("click", () => {
      toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
      );
    });
  }

  if (toggleSidebarMobileEl) {
    toggleSidebarMobileEl.addEventListener("click", () => {
      toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
      );
    });
  }

  if (sidebarBackdrop) {
    sidebarBackdrop.addEventListener("click", () => {
      toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
      );
    });
  }
}
