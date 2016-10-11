/**
 * Created by root on 9/17/16.
 */
var gulp = require('gulp'),
    concat = require('gulp-concat');

var dir = {
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/',
};

var pathJs = [
    'app/Resources/Module/module.js',
    'app/Resources/Module/**/*.js'
];

var pathTemplates = [
    'app/Resources/Module/**/*.html'
];

var pathStyles = [
    'app/Resources/Module/**/*.css'
]

gulp.task('assets', function() {
    gulp.src([
        //Third party assets
        dir.npm + 'angular/angular.min.js',
        dir.npm + 'bootstrap/dist/css/bootstrap.min.css',
        dir.npm + 'bootstrap/dist/js/bootstrap.min.js',
        dir.npm + 'font-awesome/css/font-awesome.min.css',
        dir.npm + 'angular-route/angular-route.min.js',
        dir.npm + 'jquery/dist/jquery.min.js',
        dir.npm + 'ng-file-upload/dist/ng-file-upload.min.js'

        // Main JS file
    ])
        .pipe(gulp.dest(dir.dist + 'assets'));
});

gulp.task('scripts', function () {
    return gulp.src(pathJs)
        .pipe(concat('index.js'))
        .pipe(gulp.dest(dir.dist + 'scripts'));
});

gulp.task('templates', function(){
    return gulp.src(pathTemplates)
        .pipe(gulp.dest(dir.dist + 'templates'));
});

gulp.task('styles', function() {
    return gulp.src(pathStyles)
        .pipe(gulp.dest(dir.dist + 'styles'));
});

gulp.task('watch', function () {
    gulp.watch(pathJs, ['scripts']);
    gulp.watch(pathTemplates, ['templates']);
    gulp.watch(pathStyles, ['styles']);
});


gulp.task('default', ['assets', 'scripts', 'templates', 'styles']);