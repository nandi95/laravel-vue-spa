import resolveConfig from "tailwindcss/resolveConfig";
import tailwindConfig from "@/../tailwind.config.js";
const fullConfig = resolveConfig(tailwindConfig);
export default {
  data() {
    return {
      $thresh: null
    };
  },
  computed: {
    $themeColor() {
      return this.$store.getters["theme/themeColor"];
    },
    $foregroundColor() {
      const luminance = { r: 0.2126, g: 0.7152, b: 0.0722 };
      const color = this.$themeColor;
      const r = parseInt(color.substring(1, 3), 16);
      const g = parseInt(color.substring(3, 5), 16);
      const b = parseInt(color.substring(5), 16);
      const rgb = [r / 255, g / 255, b / 255];
      for (let i = rgb.length; i--; )
        rgb[i] =
          rgb[i] <= 0.03928
            ? rgb[i] / 12.92
            : Math.pow((rgb[i] + 0.055) / 1.055, 2.4);
      this.$thresh =
        luminance.r * rgb[0] + luminance.g * rgb[1] + luminance.b * rgb[2];
      return this.$thresh > 0.39 ? "#222" : "#ffffff";
    },
    $theme() {
      return {
        "background-color": this.$themeColor,
        color: this.$foregroundColor,
        transition: `all ${fullConfig.theme.transitionDuration.default} ease-in-out`
      };
    },
    $themeText() {
      return {
        color: this.$themeColor,
        transition: `all ${fullConfig.theme.transitionDuration.default} ease-in-out`
      };
    },
    $hoverColor() {
      // strip the leading # if it's there
      let hex = this.$themeColor.replace(/^\s*#|\s*$/g, "");

      // convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
      if (hex.length === 3) {
        hex = hex.replace(/(.)/g, "$1$1");
      }

      const r = parseInt(hex.substr(0, 2), 16),
        g = parseInt(hex.substr(2, 2), 16),
        b = parseInt(hex.substr(4, 2), 16);
      const percent = this.$thresh < 0.39 ? 25 : -25;

      return (
        "#" +
        (0 | ((1 << 8) + r + ((256 - r) * percent) / 100))
          .toString(16)
          .substr(1) +
        (0 | ((1 << 8) + g + ((256 - g) * percent) / 100))
          .toString(16)
          .substr(1) +
        (0 | ((1 << 8) + b + ((256 - b) * percent) / 100))
          .toString(16)
          .substr(1)
      );
    }
  },
  methods: {
    $addHoverAccentColor(ev) {
      ev.target.style.backgroundColor = this.$hoverColor;
    },
    $removeHoverAccentColor(ev) {
      ev.target.style.backgroundColor = this.$themeColor;
    }
  }
};
