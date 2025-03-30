const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
const themeToggleBtn = document.getElementById("theme-toggle");

if (
  localStorage.getItem("color-theme") === "dark" ||
  (!localStorage.getItem("color-theme") &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark");
  themeToggleLightIcon.classList.remove("hidden");
  themeToggleDarkIcon.classList.add("hidden");
} else {
  document.documentElement.classList.remove("dark");
  themeToggleDarkIcon.classList.remove("hidden");
  themeToggleLightIcon.classList.add("hidden");
}

themeToggleBtn.addEventListener("click", function () {
  themeToggleDarkIcon.classList.toggle("hidden");
  themeToggleLightIcon.classList.toggle("hidden");

  if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
    localStorage.setItem("color-theme", "light");
  } else {
    document.documentElement.classList.add("dark");
    localStorage.setItem("color-theme", "dark");
  }

  let event = new Event("dark-mode");
  document.dispatchEvent(event);
});
