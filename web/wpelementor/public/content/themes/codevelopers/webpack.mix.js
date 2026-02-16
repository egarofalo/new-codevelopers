// laravel mix object
let mix = require("laravel-mix");

// image optimization plugin
let ImageminPlugin = require("imagemin-webpack-plugin").default;

// clean webpack plugin
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

// theme assets file
const assets = require("./assets/assets.json");

// set public path where assets will be compiled
mix.setPublicPath(assets.publicPath);

// use browsersync when run watch command
mix.browserSync(assets.browserSync);

// extract each vendor library into its vendor~library.js file
assets.extractVendorLibraries.forEach((library) =>
    mix.extract([library], `scripts/vendor~${library}.js`)
);

// extract all node_modules vendor libraries into a vendor.js file, except those listed in assets.extractVendorLibraries array
mix.extract();

// versioning files in production mode
if (mix.inProduction()) {
    mix.version();
}

// set webpack custom configuration
mix.webpackConfig({
    // tell webpack use wordpress builtin jquery script
    externals: {
        jquery: "jQuery",
    },
    // add webpack plugins
    plugins: [
        // optimize image files only in production mode
        new ImageminPlugin({
            disable: !mix.inProduction(),
        }),
        // delete all contents in the output dir
        new CleanWebpackPlugin(),
    ],
});

// copy static images to dist/images folder
mix.copy(
    [
        "assets/images/**/*.jpg",
        "assets/images/**/*.svg",
        "assets/images/**/*.png",
    ],
    `${assets.publicPath}/images`
);

// compile with laravel mix each js entry file
assets.entries.forEach((entry) =>
    mix.js(`assets/scripts/${entry.input}`, `scripts/${entry.output}`)
);

// compile with laravel mix each sass entry file
assets.styleEntries.forEach((entry) =>
    mix.sass(`assets/styles/${entry.input}`, `styles/${entry.output}`)
);
