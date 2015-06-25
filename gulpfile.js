/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my global custom js files
gulp.task('js', function () {
    return gulp.src(['bower_components/jquery/dist/jquery.js',
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'app/Resources/js/**/*.js'])
        .pipe(concat('javascript.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//JAVASCRIPT TASK: write one minified js file out of my global custom js files for admin Bundle
gulp.task('admin_js', function () {
    return gulp.src(['src/ClicSape/Bundle/AdminBundle/Resources/js/**/*.js'])
        .pipe(concat('admin.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    return gulp.src([
        'bower_components/bootstrap/dist/css/bootstrap.css',
        'app/Resources/public/less/**/*.less'])
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('styles.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('img', function() {
    return gulp.src('app/Resources/public/img/**/*.*')
        .pipe(gulp.dest('web/img'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('fonts', function() {
    return gulp.src('bower_components/bootstrap/dist/fonts/**/*.*')
        .pipe(gulp.dest('web/fonts'));
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js','admin_js', 'css', 'img','fonts']);