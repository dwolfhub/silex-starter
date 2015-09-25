var path = require("path");
var webpack = require("webpack");
var fs = require("fs");
var ManifestPlugin = require('webpack-manifest-plugin');

module.exports = {
    cache: true,
    entry: {
        'app'      : "./frontend/js/app.js"
    },
    output: {
        path: path.join(__dirname, "public_html/assets/js"),
        publicPath: "/assets/js/",
        filename: "[name].js"
    },
    module: {
        loaders: []
    },
    resolve: {
        alias: {
            'fastclick' : __dirname + '/bower_components/fastclick/lib/fastclick'
        }
    },
    plugins: [
        new webpack.optimize.DedupePlugin()
    ],
    //devtool: "source-map",
    debug: true
};