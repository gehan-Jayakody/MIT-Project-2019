var gulp = require('gulp');
var browserSync = require('browser-sync');
//var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
//var rename = require('gulp-rename');
var del = require('del');
var runSequence = require('run-sequence');
var replace = require('gulp-replace');
var injectPartials = require('gulp-inject-partials');
var inject = require('gulp-inject');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');

var connect = require('gulp-connect-php')
//var merge = require('merge-stream');
//var fileinclude = require('gulp-file-include');

gulp.paths = {
    dist: 'dist',
};

var paths = gulp.paths;

//task that fires up php server at port 8001
gulp.task('connect', function (callback) {
  connect.server({
    port: 8000
  }, callback);
});

//task that fires up browserSync proxy after connect server has started
gulp.task('browserSync', ['connect'], function () {
  browserSync({
    proxy: '127.0.0.1:8000',
    port: 8001,
	notify:false
  });
  console.log("PHP Server Connected.");
});

gulp.task('serve', [ 'browserSync'], function() {
       gulp.watch('./*.php', browserSync.reload);
	   gulp.watch('scss/**/*.scss', ['sass']);
	   gulp.watch('js/**/*.js').on('change', browserSync.reload);
	   gulp.watch('./partials/*.php', browserSync.reload);
});

gulp.task('sass', function () {
    return gulp.src('./scss/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
});

/*sequence for injecting partials and replacing paths*/
gulp.task('inject', function() {
  runSequence('injectPartial' , 'injectAssets' , 'replacePath');
});

/* inject partials like sidebar and navbar */
gulp.task('injectPartial', function () {
  return gulp.src("./**/*.php", { base: "./" })
    .pipe(injectPartials())
    .pipe(gulp.dest("."));
});

/* inject Js and CCS assets into PHP */
gulp.task('injectAssets', function () {
  return gulp.src('./**/*.php')
    .pipe(inject(gulp.src([ 
        './vendors/iconfonts/mdi/css/materialdesignicons.min.css', 
        './vendors/css/vendor.bundle.base.css', 
        './vendors/css/vendor.bundle.addons.css',
        './vendors/js/vendor.bundle.base.js',
        './vendors/js/vendor.bundle.addons.js'
    ], {read: false}), {name: 'plugins', relative: true}))
    .pipe(inject(gulp.src([
        './css/*.css', 
        './js/off-canvas.js', 
        './js/misc.js', 
    ], {read: false}), {relative: true}))
    .pipe(gulp.dest('.'));
});

/*replace image path and linking after injection*/
gulp.task('replacePath', function(){
  gulp.src('pages/*/*.php', { base: "./" })
    .pipe(replace('src="images/', 'src="../../images/'))
    .pipe(replace('href="pages/', 'href="../../pages/'))
    .pipe(replace('href="index.php"', 'href="../../index.php"'))
    .pipe(gulp.dest('.'));
  gulp.src('pages/*.php', { base: "./" })
    .pipe(replace('src="images/', 'src="../images/'))
    .pipe(replace('"pages/', '"../pages/'))
    .pipe(replace('href="index.php"', 'href="../index.php"'))
    .pipe(gulp.dest('.'));
});

/*sequence for building vendor scripts and styles*/
gulp.task('bundleVendors', function() {
    runSequence('clean:vendors','copyRecursiveVendorFiles', 'buildBaseVendorStyles','buildBaseVendorScripts',  'buildOptionalVendorScripts');
});

gulp.task('clean:vendors', function () {
    return del([
      'vendors/**/*'
    ]);
});

/* Copy whole folder of some specific node modules that are calling other files internally */
gulp.task('copyRecursiveVendorFiles', function() {
    return gulp.src(['./node_modules/mdi/**/*'])
        .pipe(gulp.dest('./vendors/iconfonts/mdi'));
});

/*Building vendor scripts needed for basic template rendering*/
gulp.task('buildBaseVendorScripts', function() {
    return gulp.src([
        './node_modules/jquery/dist/jquery.min.js', 
        './node_modules/popper.js/dist/umd/popper.min.js', 
        './node_modules/bootstrap/dist/js/bootstrap.min.js', 
        './node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
		'./node_modules/sweetalert/dist/sweetalert.min.js'
    ])
      .pipe(concat('vendor.bundle.base.js'))
      .pipe(gulp.dest('./vendors/js'));
});

/*Building vendor styles needed for basic template rendering*/
gulp.task('buildBaseVendorStyles', function() {
    return gulp.src(['./node_modules/perfect-scrollbar/css/perfect-scrollbar.css'])
      .pipe(concat('vendor.bundle.base.css'))
      .pipe(gulp.dest('./vendors/css'));
});

/*Building optional vendor scripts for addons*/
gulp.task('buildOptionalVendorScripts', function() {
    return gulp.src([
        'node_modules/chart.js/dist/Chart.min.js', 
    ])
    .pipe(concat('vendor.bundle.addons.js'))
    .pipe(gulp.dest('./vendors/js'));
});

gulp.task('build-dev', ['serve', 'sass', 'inject', 'bundleVendors']);
gulp.task('build', ['bundleVendors']);
gulp.task('default', ['serve', 'sass']);