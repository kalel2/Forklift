'use strict';
var config = require('./config.js');
var gulp = require('gulp'),
    watch = require('gulp-watch'), // Rebuild only changed files
    plumber = require('gulp-plumber'), // Protect from exit on error
    prefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
  	concat = require('gulp-concat'),
  	uglify = require('gulp-uglify'),
    shell = require('gulp-shell'),
    browserSync = require("browser-sync"),
    argv = require('yargs').argv,
    reload = browserSync.reload;

var args = {
  debug: argv.debug
};

var basePath = './profiles/forklift_website/themes/forklift_theme/';

var path = {
	styles: {
		css: 'profiles/forklift_website/themes/forklift_theme/css/',
		scss: 'profiles/forklift_website/themes/forklift_theme/scss/**/*.*',
		scss_input: 'profiles/forklift_website/themes/forklift_theme/scss/styles.scss',
    bootstrapStyleDst: 'profiles/forklift_website/themes/forklift_theme/bootstrap/css'
	},
	js: {
		src: 'profiles/forklift_website/themes/forklift_theme/js_src/**/*.*',
		dst: 'profiles/forklift_website/themes/forklift_theme/js/',
    bootstrapDst: 'profiles/forklift_website/themes/forklift_theme/bootstrap/js'
	},
	template: 'profiles/forklift_website/themes/forklift_theme/templates/*.twig'
};


// gulp.task('webserver', ['sass', 'js'], function () {
//     browserSync.init({
//         proxy: config.site_name,
//         open: false
//     });
// });

gulp.task('sass', function () {
    gulp.src(path.styles.scss_input)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass()).on('error', sass.logError)
        .pipe(prefixer('last 2 versions'))
        .pipe(sourcemaps.write('/'))
        .pipe(gulp.dest(path.styles.css))
        .pipe(reload({stream: true}));
});

gulp.task('js', function () {
  var debug = args.debug;

  var process = gulp.src(path.js.src)
  .pipe(plumber())
  .pipe(sourcemaps.init())
  .pipe(concat('main.js'));

  if (!debug) {
    process
			.pipe(uglify())
  }

  process
		.pipe(sourcemaps.write('/'))
    .pipe(gulp.dest(path.js.dst))
    .pipe(reload({stream: true}));
});

gulp.task('clearcache', function() {
    return shell.task([
        'drush cr'
    ]);
});

// Move the javascript files into our folder
gulp.task('bootstrap-js', function() {
  return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js'])
      .pipe(gulp.dest(path.js.bootstrapDst));
});

gulp.task('bootstrap-css', function() {
  return gulp.src(['node_modules/bootstrap/dist/css/bootstrap.min.css'])
      .pipe(gulp.dest(path.styles.bootstrapStyleDst));
});
// gulp.task('reload', ['clearcache'], function () {
//     reload();
// });
//
// gulp.task('watch', ['webserver'], function () {
//     watch([path.styles.scss], function (event, cb) {
//     gulp.start('sass');
//   });
//     watch([path.js.src], function (event, cb) {
//     gulp.start('js');
//   });
//     watch([path.template], function (event, cb) {
//     gulp.start('reload');
//   });
// });
//
//
// gulp.task('default', ['watch', 'sass']);
