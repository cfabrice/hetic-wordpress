const gulp         = require('gulp')
const plumber      = require('gulp-plumber')
const notify       = require('gulp-notify')
const stylus       = require('gulp-stylus')
const uglify       = require('gulp-uglify')
const sourcemaps   = require('gulp-sourcemaps')
const autoprefixer = require('gulp-autoprefixer')
const rename       = require('gulp-rename')
const babel        = require('gulp-babel')
const concat       = require('gulp-concat')
const browserSync   = require('browser-sync').create()

let config = {
  'src' : 'src/',
  'dist': 'dist/assets/'
}

gulp.task('css', function () {
  return gulp.src(config.src + 'css/app.styl')
    .pipe(plumber({errorHandler: notify.onError(Error)}))
    .pipe(sourcemaps.init())
    .pipe(stylus({compress: 'true'}))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(sourcemaps.write())
    .pipe(rename(function (path) {
      path.basename += ".min"
    }))
    .pipe(gulp.dest(config.dist + 'css'))
    .pipe(browserSync.reload({stream: true}))    
})

gulp.task('js', function() {
  return gulp.src([
    config.src + 'js/Classes/**',
    config.src + 'js/**'
  ])
    .pipe(sourcemaps.init())
    .pipe(plumber({errorHandler: notify.onError("JS Error: <%= error.message %>")}))
    .pipe(babel({
      presets: ['es2015']
    }))
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(config.dist + 'js'))
    .pipe(browserSync.reload({stream: true}))
})


gulp.task('sync', function() {
  browserSync.init({
    server: {
      baseDir: "./dist/"
    }
  })
})

gulp.task('html', function(){
  browserSync.reload();
})


gulp.task('watch', function() {
  gulp.watch(config.src + 'css/**', ['css'])
  gulp.watch(config.src + 'js/**', ['js'])
  gulp.watch('./dist/index.html', ['html'])
})

gulp.task('default', ['watch', 'js', 'css', 'sync'], function() {})