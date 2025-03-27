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
