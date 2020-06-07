const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ["Open Sans", ...defaultTheme.fontFamily.sans],
        serif: ["Merriweather", ...defaultTheme.fontFamily.serif],
      },
      width: {
        "1/7": "14.28571429%",
        "1/8": "12.5%",
        "1/9": "11.1111111111%",
        "1/10": "10%",
      },
    },
  },
  variants: {},
  plugins: [],
};
