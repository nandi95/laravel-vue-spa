const path = require("path");
const fs = require("fs-extra");
const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
require("laravel-mix-purgecss");
// require("laravel-mix-versionhash");
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

mix.config.webpackConfig.output = {
  chunkFilename: "js/[name].bundle.js" // until resolved https://github.com/JeffreyWay/laravel-mix/issues/1889
};

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css");

if (mix.inProduction()) {
  mix
    .extract(["vue", "axios"])
    .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
    .disableNotifications()
    .purgeCss({
      whitelist: ["dark-mode"]
    });
  // .versionHash();
} else {
  mix.sourceMaps();
}

mix
  .webpackConfig({
    plugins: [
      // new BundleAnalyzerPlugin()
    ],
    resolve: {
      extensions: [".js", ".json", ".vue"],
      alias: {
        "~": path.join(__dirname, "./resources/js"),
        "@": path.join(__dirname, "./resources"),
        icons: path.resolve(__dirname, "node_modules/vue-material-design-icons")
      }
    }
  })
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.config.js")]
  });

// mix.then(() => {
//   if (!mix.config.hmr) {
//     process.nextTick(() => publishAssets());
//   }
// });

function publishAssets() {
  const publicDir = path.resolve(__dirname, "./public");

  if (mix.inProduction()) {
    fs.removeSync(path.join(publicDir, "dist"));
  }

  fs.copySync(
    path.join(publicDir, "build", "dist"),
    path.join(publicDir, "dist")
  );
  fs.removeSync(path.join(publicDir, "build"));
}
