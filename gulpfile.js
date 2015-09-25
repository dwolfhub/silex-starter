var gulp = require("gulp");
var plumber = require("gulp-plumber");
var buffer = require('gulp-buffer');
var gutil = require("gulp-util");
var del = require("del");
var rev = require('gulp-rev');
var sass = require("gulp-sass");
var sitemap = require("gulp-sitemap");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var sourcemaps = require("gulp-sourcemaps");
var webpack = require("webpack");
var gulpWebpack = require("gulp-webpack");
var webpackConfig = require("./webpack.config.js");
var livereload = require('gulp-livereload');

/*
    Main Tasks
*/
gulp.task("default", ["clean", "build-js", "sass"]);
gulp.task("dev",     ["default"]);
gulp.task("staging", ["prod"]);
gulp.task("test",    ["prod"]);
gulp.task("uat",     ["prod"]);
gulp.task("master",  ["prod"]);
gulp.task("prod",    ["clean", "uglify-js", "build-js", "sass"]);

gulp.task("watch", function() {
    livereload.listen();
    gulp.watch(["frontend/js/**/*.js"], ["build-js"]);
    gulp.watch(["frontend/scss/**/*.scss"], ["sass"]);
});

/*
    JavaScript Tasks
*/
gulp.task("uglify-js", function(){
    webpackConfig.plugins = webpackConfig.plugins.concat( new webpack.optimize.UglifyJsPlugin() );
    webpackConfig.debug = false;
});

gulp.task("build-js", function(callback) {
    return gulp.src("frontend/js/app.js")
        .pipe(buffer())
        .pipe(gulpWebpack(webpackConfig))
        .pipe(rev())
        .pipe(gulp.dest('public_html/assets/js'))
        .pipe(rev.manifest({path: "public_html/assets/assets.json", merge : true}))
        .pipe(gulp.dest(''))
        .pipe(livereload());
});

/*
    SASS
*/
gulp.task("sass", function () {
    return gulp.src("frontend/scss/**/*.scss")
        .pipe(buffer())
        .pipe(sourcemaps.init())
        .pipe(sass({"outputStyle" : "compressed", "errLogToConsole": true}))
        .pipe(postcss([autoprefixer({browsers: ["last 2 versions"]})]))
        //.pipe(sourcemaps.write())
        .pipe(rev())
        .pipe(gulp.dest("public_html/assets/styles/"))
        .pipe(rev.manifest({path: "public_html/assets/assets.json", merge : true}))
        .pipe(gulp.dest(''))
        .pipe(livereload());
});

/*
    Clean up
*/
gulp.task("clean", function(callback){
    del(["public_html/assets/**/*"], callback);
});