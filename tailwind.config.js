module.exports = {
  theme: {
    screens: {
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "2160px"
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
  variants: {
    // ["dark", "dark-hover", "dark-group-hover", "dark-focus", "dark-focus-within", "dark-active"]
    backgroundColor: [
      "responsive",
      "hover",
      "focus",
      "dark",
      "dark-hover",
      "dark-group-hover",
      "dark-focus",
      "dark-focus-within",
      "dark-active"
    ],
    borderColor: [
      "responsive",
      "hover",
      "focus",
      "dark",
      "dark-hover",
      "dark-group-hover",
      "dark-focus",
      "dark-focus-within",
      "dark-active"
    ],
    placeholderColor: [
      "responsive",
      "focus",
      "dark",
      "dark-hover",
      "dark-group-hover",
      "dark-focus",
      "dark-focus-within",
      "dark-active"
    ],
    textColor: [
      "responsive",
      "hover",
      "focus",
      "dark",
      "dark-hover",
      "dark-group-hover",
      "dark-focus",
      "dark-focus-within",
      "dark-active"
    ]
  },
  corePlugins: {
    transitionProperty: false
  },
  plugins: [
    require("tailwindcss-transitions")(),
    require("tailwindcss-dark-mode")()
  ]
};
