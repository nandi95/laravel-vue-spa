module.exports = {
  theme: {
    screens: {
      xs: "320px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": ""
    },
    fontFamily: {
      display: ["Gilroy", "sans-serif"],
      body: ["Graphik", "sans-serif"]
    },
    container: {
      center: true,
      padding: "2rem"
    },
    transitionDuration: {
      default: "175ms"
    }
  },
  variants: {},
  plugins: [require("tailwindcss-transitions")()]
};
