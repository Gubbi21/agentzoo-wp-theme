"use strict";

// MODULES
const gulp = require('gulp');

const rename = require('gulp-rename');

//JS
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

//SCSS
const sass = require('gulp-sass');
const nano = require('gulp-cssnano');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');

const browserSync = require('browser-sync').create();

//TASKS

gulp.task('js', () => {
	gulp.src('js/src/**/*.js')
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['es2015']
		}))
		.pipe(concat('script.js'))
		.pipe(gulp.dest('js/build'))
		.pipe(rename('scripts.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream());
});

gulp.task('css', () => {
	gulp.src('sass/style.scss')
	.pipe(sourcemaps.init())
	.pipe(sass().on('error', sass.logError))
	.pipe(autoprefixer({
		browsers: ['last 2 versions', '>2%']
	}))
	.pipe(nano())
	.pipe(sourcemaps.write())
	.pipe(gulp.dest('.'))
	.pipe(browserSync.stream());
});

gulp.task('watch', () => {
    browserSync.init({
        proxy: 'localhost/agentzoo'
    });
    gulp.watch(['sass/**/*.scss'], ['css']);
    gulp.watch(['js/src/**/*.js'], ['js']);
    gulp.watch('**/*.php').on('change', browserSync.reload);
});

gulp.task('default', ['css','js','watch']);