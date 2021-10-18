const {src, dest, watch , parallel} = require("gulp");
const sass = require("gulp-sass");
const autoprefixer = require("autoprefixer");
const postcss    = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
const terser = require("gulp-terser-js");
const rename = require("gulp-rename");
const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const webp = require("gulp-webp");

const path = 
{
    scss: "src/scss/**/*.scss",
    js: "src/js/**/*.js",
    img: "src/img/**/*"
}


function css()
{
    return src(path.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write("."))
        .pipe(dest("./public/build/css"));
}
function javascript() 
{
    return src(path.js)
        .pipe(sourcemaps.init())
        .pipe(concat("bundle.js")) 
        .pipe(terser())
        .pipe(sourcemaps.write("."))
        .pipe(rename({ suffix: ".min" }))
        .pipe(dest("./public/build/js"));
}
function img() 
{
    return src(path.img)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest("./public/build/img"));
}
function toWebp() 
{
    return src(path.img)
        .pipe(webp())
        .pipe(dest("./public/build/img"));
}

function watchFiles() 
{
    watch(path.scss, css);
    watch(path.js, javascript);
    watch(path.img, img);
    watch(path.img, toWebp);
}
 
exports.default = parallel(css, javascript, img, toWebp, watchFiles); 