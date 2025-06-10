const { src, dest, watch, series } = require('gulp');
const sass         = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS     = require('gulp-clean-css');
const uglify       = require('gulp-uglify');
const concat       = require('gulp-concat');
const rename       = require('gulp-rename');
const browserSync  = require('browser-sync').create();

const paths = {
  scss: 'assets/scss/**/*.scss',
  js:   'assets/js/**/*.js',
};

// Compilar SASS
function styles() {
  return src(paths.scss)
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('assets/css'))
    .pipe(browserSync.stream());
}

// Minificar JS
function scripts() {
  return src(paths.js)
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('assets/js'))
    .pipe(browserSync.stream());
}

// Recargar navegador
function serve() {
  browserSync.init({
    proxy: "http://localhost/header-test" // tu URL local de WP
  });

  watch(paths.scss, styles);
  watch(paths.js, scripts);
  watch("**/*.php").on('change', browserSync.reload);
}

exports.default = series(styles, scripts, serve);
