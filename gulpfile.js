var gulp            = require('gulp');
var concat          = require('gulp-concat');
var uglify          = require('gulp-uglify-es').default;
var merge           = require('merge-stream');
var sass            = require('gulp-sass');
var autoprefixer    = require('gulp-autoprefixer');
var gcmq            = require('gulp-group-css-media-queries');
var livereload      = require('gulp-livereload');

sass.compiler = require('node-sass');

var assetsFolder = 'assets/',
    assetsAdmin  = assetsFolder + 'admin/',
    assetsPublic = assetsFolder + 'public/';

var config = {
    //Admin Assets folders
    srcAdminDirJS: assetsAdmin + 'js/src',
    destAdminDirJS:  assetsAdmin + 'js',
    srcAdminDirSASS:  assetsAdmin + 'css/sass',
    destAdminDirSASS:  assetsAdmin + 'css',
    //Public Assets folders
    srcDirJS: assetsPublic + 'js/src',
    destDirJS: assetsPublic + 'js',
    srcDirSASS: assetsPublic + 'css/sass',
    destDirSASS: assetsPublic + 'css'
};


//The sass styles to compile combine and minify
var styles = [
    {
        src : [
            config.srcAdminDirSASS + '/base.scss'
        ],
        name : 'admin.min',
        dest : config.destAdminDirSASS + ''
    },
    {
        src : [
            config.srcDirSASS + '/base.scss'
        ],
        name : 'public.min',
        dest : config.destDirSASS + ''
    }
];


//The scripts to combine and minify
var scripts = [
    {
        src : [
            config.srcAdminDirJS + '/base.js'
        ],
        name : 'admin.min',
        dest : config.destAdminDirJS + ''
    },
    {
        src : [
            config.srcDirJS + '/base.js'
        ],
        name : 'public.min',
        dest : config.destDirJS + ''
    }
];


//Task to Compile the styles, scripts are combined and minified
gulp.task('sass:compile', function () {

    var tasks = styles.map(function( file){
        return gulp.src( file.src )
            .pipe( concat(file.name + '.css' ) )
            // .pipe(gcmq())
            .pipe( sass({outputStyle: 'compressed'}).on('error', sass.logError) )
            .pipe( autoprefixer({
                overrideBrowserslist: ['last 6 versions'],
                cascade: false
            }))
            .pipe( gulp.dest( file.dest )  )
            .pipe( livereload({ start: true }) );
    });

    return merge(tasks);


});


//Task to Compile the scripts, scripts are combined and minified
gulp.task('scripts:compile', function() {

    var tasks = scripts.map(function( file){
        return gulp.src( file.src )
            .pipe( concat(file.name + '.js' ) )
            .pipe( uglify().on('error', function(e){ console.log(e); } ) )
            .pipe( gulp.dest( file.dest ) )
            .pipe( livereload({ start: true }) );
    });

    return merge(tasks);

});


//Task to Watch only for changes in styles
gulp.task('sass:watch', function (done) {
    livereload.listen();
    gulp.watch( config.srcAdminDirSASS + '/**/*.scss', gulp.series( 'sass:compile' ) );
    gulp.watch( config.srcDirSASS + '/**/*.scss', gulp.series( 'sass:compile' ) );
    done();
});


//Task to Watch only for changes in scripts
gulp.task( 'scripts:watch', function(done) {
    livereload.listen();
    gulp.watch( config.srcAdminDirJS + '/**/*.js', gulp.series( 'scripts:compile' ) );
    gulp.watch( config.srcDirJS + '/**/*.js', gulp.series( 'scripts:compile' ) );
    done();
});


//Task to Watch both styles and scripts
gulp.task('watch', function(done){

    gulp.watch( config.srcAdminDirSASS + '/**/*.scss', gulp.series( 'sass:compile' ) );
    gulp.watch( config.srcAdminDirJS + '/**/*.js', gulp.series( 'scripts:compile' ) );
    gulp.watch( config.srcDirSASS + '/**/*.scss', gulp.series( 'sass:compile' ) );
    gulp.watch( config.srcDirJS + '/**/*.js', gulp.series( 'scripts:compile' ) );
    done();

});


//Change the default gulp task to compile styles and scripts and then watch
gulp.task( 'default', gulp.series( 'sass:compile', 'scripts:compile', 'watch' ) );
