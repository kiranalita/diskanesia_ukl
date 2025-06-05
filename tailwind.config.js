/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}",
    "./ukl/**/*.{html,js,php}",  // Sesuaikan dengan struktur folder Anda
    "./**/*.php"  // Atau tambahkan ini untuk semua file PHP
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}