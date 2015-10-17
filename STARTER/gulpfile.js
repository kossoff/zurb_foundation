var gulp            = require('gulp'),
    livereload      = require('gulp-livereload'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    sass            = require('gulp-sass'),
    postcss         = require('gulp-postcss'),
    autoprefixer    = require('autoprefixer'),
    cssnext         = require('cssnext'),
    mqpacker        = require('css-mqpacker'),
    csswring        = require('csswring');

var base_theme_path = '../zurb_foundation';

// array of Zurb Foundation javascript components to include.
var jsFoundation = [
    base_theme_path + '/js/foundation/foundation.js',
    base_theme_path + '/js/foundation/foundation.abide.js',
    base_theme_path + '/js/foundation/foundation.accordion.js',
    base_theme_path + '/js/foundation/foundation.alert.js',
    base_theme_path + '/js/foundation/foundation.clearing.js',
    base_theme_path + '/js/foundation/foundation.dropdown.js',
    base_theme_path + '/js/foundation/foundation.equalizer.js',
    base_theme_path + '/js/foundation/foundation.interchange.js',
    base_theme_path + '/js/foundation/foundation.joyride.js',
    base_theme_path + '/js/foundation/foundation.magellan.js',
    base_theme_path + '/js/foundation/foundation.offcanvas.js',
    base_theme_path + '/js/foundation/foundation.orbit.js',
    base_theme_path + '/js/foundation/foundation.reveal.js',
    base_theme_path + '/js/foundation/foundation.slider.js',
    base_theme_path + '/js/foundation/foundation.tab.js',
    base_theme_path + '/js/foundation/foundation.tooltip.js',
    base_theme_path + '/js/foundation/foundation.topbar.js'
];

gulp.task('awesome_css', function () {
    var processors = [
        autoprefixer(
                     {browsers: [
                        'last 2 version',
                        '> 2%'
                        ]}),
        cssnext,
        mqpacker,
        csswring
    ];

    gulp.src('./scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(gulp.dest('./css'))
        .pipe(livereload());
});

gulp.task('foundation_js', function() {
    gulp.src(jsFoundation)
        .pipe(concat('foundation.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
        .pipe(livereload());
});

gulp.task('libs_js', function() {
    gulp.src([
             base_theme_path + '/js/vendor/fastclick.js',
             base_theme_path + '/js/vendor/placeholder.js'])
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
        .pipe(livereload());
});

gulp.task('custom_js', function() {
    gulp.src(['./js/_*.js'])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
        .pipe(livereload());
});

gulp.task('default', function () {
    livereload.listen();

    gulp.watch('./scss/**/*.scss', ['awesome_css']);
    gulp.watch('./js/_*.js', ['foundation_js', 'libs_js', 'custom_js']);
});
