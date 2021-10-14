const {src, dest, watch, parallel} = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("gulp-autoprefixer");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
const terser = require("gulp-terser-js");
const rename = require("gulp-postcss");
const postcss = require("gulp-postcss");

const path =
{
    scss: "src/scss/**/*.scss",
    js: "src/js/**/*.js",
    img: "src/img/**/*"
};

function css()
{
    return src(path.css)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: "compressed"}))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write("."))
        .pipe(dest("public/build/css"));
}