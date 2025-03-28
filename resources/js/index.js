import "flowbite";
import { DataTable } from "simple-datatables";

const dataTable = new DataTable("#search-table", {
  searchable: true,
  sortable: true,
});

const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
const themeToggleBtn = document.getElementById("theme-toggle");

// Apply theme on initial load
if (
  localStorage.getItem("color-theme") === "dark" ||
  (!localStorage.getItem("color-theme") &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark"); // Ensure 'dark' class is added
  themeToggleLightIcon.classList.remove("hidden"); // Show light icon
  themeToggleDarkIcon.classList.add("hidden"); // Hide dark icon
} else {
  document.documentElement.classList.remove("dark"); // Ensure 'dark' class is removed
  themeToggleDarkIcon.classList.remove("hidden"); // Show dark icon
  themeToggleLightIcon.classList.add("hidden"); // Hide light icon
}

// Theme toggle button event listener
themeToggleBtn.addEventListener("click", function () {
  themeToggleDarkIcon.classList.toggle("hidden");
  themeToggleLightIcon.classList.toggle("hidden");

  // Toggle theme and update localStorage
  if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
    localStorage.setItem("color-theme", "light");
  } else {
    document.documentElement.classList.add("dark");
    localStorage.setItem("color-theme", "dark");
  }

  // Custom event for other functionalities
  let event = new Event("dark-mode");
  document.dispatchEvent(event);
});

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
