var gulp = require("gulp");
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var notify = require('gulp-notify');

var files = {
    js: ['./js/*.js', '!./js/speechesjs.js', '!./js/speechesjs.min.js']
};

gulp.task('default', ["minifyjs"], function() {
   gulp.watch(files.js, ['minifyjs']);
});

gulp.task('minifyjs', function() {
    return gulp.src(files.js)
            .pipe(concat("speechesjs.min.js"))
            .pipe(uglify())
            .pipe(gulp.dest('./js/'))
            .pipe(notify('Javascript Compiled Succesfully'));
});