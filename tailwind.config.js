/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.php", // For PHP views in the views directory
    "./resources/views/**/*.html", // If you use HTML files as well
    "**/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
