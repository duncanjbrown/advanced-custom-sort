var gulp = require('gulp');
var jstConcat = require('gulp-jst-concat');


gulp.task('JST', function () {
  gulp.src('jst/*.jst')
    .pipe(jstConcat('jst.js', {
      renameKeys: ['^.*jst/(.*).jst$', '$1']
    }))
    .pipe(gulp.dest('js'))
});
