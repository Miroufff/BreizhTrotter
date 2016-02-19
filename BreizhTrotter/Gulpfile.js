var gulp = require('gulp');

var sass = sass = require('gulp-sass');

gulp.task('sass', function () {
    gulp.src('./web/bundles/AppBundle/sass/master.scss')
        .pipe(sass({sourceComments: 'map'}))
        .pipe(gulp.dest('./web/css/'));
});

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
    };
    gulp.watch('./src/AppBundle/sass/**/*.scss', ['sass'])
        .on('change', onChange);
});