const path = require("path");

module.exports = {
  entry: {
    login: "./resources/js/login.js",
    reusable: "./resources/js/reusable-functions.js",
    index: "./resources/js/index.js",
  },
  output: {
    path: path.resolve(__dirname, "public/js"),
    filename: "[name].bundle.js",
  },
  module: {
    rules: [
      {
        test: /\.m?js$/, // Match JavaScript files
        exclude: /node_modules/,
        use: {
          loader: "babel-loader", // Transpile modern JavaScript
          options: {
            presets: ["@babel/preset-env"], // Define Babel presets
          },
        },
      },
    ],
  },
  mode: "development", // Change to 'production' for optimized builds
};
