module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        base: {
          100: "#FFFFFF",
          200: "#F2F2F2",
          300: "#E5E6E6"
        }
      },
    },
  },
  plugins: [
    require("daisyui"),
    require('@tailwindcss/typography')

  ],
}
