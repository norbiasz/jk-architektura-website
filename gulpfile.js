var gulp = require('gulp');
var gutil = require('gulp-util');
var insert = require('gulp-insert');
var compass = require('gulp-compass');
var cleanCSS = require('gulp-clean-css');
var imagemin = require('gulp-imagemin');
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");
var include = require("gulp-include");
var rename = require("gulp-rename");
var fileSync = require('syncy');
var notify = require('gulp-notify');
var watch = require('gulp-watch');
var autoprefixer = require('gulp-autoprefixer');

var themeName = 'jk-architektura';
var themeSrc = './src/themes/' + themeName;
var themeDist = './dist/themes/' + themeName;

var sassOptions = {
	'style': 'compressed',
	'unixNewlines': true,
    'compass': true
};

/** General Task */

gulp.task('optimize-images', function() {
    return copyFiles( './images/original/**', './images/optimized');
});

gulp.task('fetch-acf-json', function() {
    fileSync(themeDist + '/acf-json/*.json', themeSrc + '/files/acf-json', {
        base: themeDist + '/acf-json',
    })
    .then(() => {
        gulp.src('')
        .pipe(notify({ message: 'ACF Json files synced' }));
    })
    .catch(console.error);
});

/** SASS BUILD TASKS */

gulp.task('theme-sass', function() {
    return buildSass( themeSrc + '/sass/', themeDist);
});

/** JS BUILD TASKS */

gulp.task('theme-js', function() {
    return buildJs( themeSrc + '/js/scripts.js', themeDist + '/assets/js/' );
});

/** IMAGE TASKS */

gulp.task('minimize-images', function() {
    return copyFiles( themeSrc + '/images/**/*', themeDist + '/assets/images');
});

/** SYNC TASKS */

gulp.task('sync', function() {
    fileSync([ themeSrc + '/files/**', '!' + themeSrc + '/files/acf-json/**'], themeDist, {
        base: themeSrc + '/files',
        ignoreInDest: ['**/*.css', '**/*.js', 'acf-json/**', 'assets/images/**/*']
    })
    .then(() => {
        gulp.src('')
        .pipe(notify({ message: 'File sync task completed' }));
    })
    .catch(console.error);
});

/** BUILD TASKS */

gulp.task( 'build', [ 'theme-js', 'theme-sass', 'sync', 'minimize-images' ] );

gulp.task('watch', function() {
    watch( themeSrc + '/js/*.js', function() { gulp.start('theme-js') });
    watch( themeSrc + '/sass/**/*.scss', function() { gulp.start('theme-sass') });
    watch( themeDist + '/acf-json/*.json', function() { gulp.start('fetch-acf-json') });
    watch([ themeSrc + '/files/**/*', '!' + themeSrc + '/files/acf-json/**'], function() { gulp.start('sync') });
    watch( themeSrc + '/images/**/*', function() { gulp.start('minimize-images') })
});

/** FUNCTIONS */

function buildSass( src, dest ) {
    return gulp.src( [ src + '**/*.scss' ] )
    .pipe( compass({
        css: dest,
        sass: src,
        style: 'compact',
        image: dest + '/assets/images',
        import_path: [ __dirname + '/node_modules' ],
        sourcemap: false
    }))
    .on('error', function( error ) {
        console.log(error);
        gulp.src('')
        .pipe(notify({ message: 'Style task failed, check console for more details' }));
        this.emit('end');
    })
    .pipe(autoprefixer({
        browsers: ['> 1%', 'last 4 versions', 'Firefox ESR']
    }))
    .pipe(cleanCSS({
        processImport: true,
        processImportFrom: ['local'],
        relativeTo: dest,
    }))
    .pipe( gulp.dest( dest ) )
    .pipe(notify({ message: '<%= file.relative %> : Styles task completed' }));
}

function copyFiles( src, dest ) {
    return gulp.src( src )
    .pipe( imagemin() )
    .pipe( gulp.dest( dest ) );
}

function buildJs( src, dest ) {
    return gulp.src( src )
    .pipe(include({
        extensions: "js",
        hardFail: true,
        includePaths: [
            __dirname + "/node_modules",
            themeSrc + '/js'
        ]
    }))
    .pipe( concat( 'scripts.js' ) )
    .pipe( uglify() )
    .on('error', function( error ) {
        console.log(error);
        gulp.src('')
        .pipe(notify({ message: 'Javascript task failed, check console for more details' }));
        this.emit('end');
    })
    .pipe( gulp.dest( dest ) )
    .pipe(notify({ message: '<%= file.relative %> : Javascript task completed' }));
}