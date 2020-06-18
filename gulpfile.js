"use strict";

// Configure project destination paths to compiled CSS and JS files
var devDir =  './dev';
// var devDir =  './dev/testy';
var destCssDir = './assets/admin/css';
var destJsDir = './assets/admin/js';
var filesToSend = destCssDir + '/**/*';
var bootstrapThemeName = 'theme_1'

var ftpGlobs = [
	destCssDir + '/**',
	destJsDir + '/**',
];

// Access data for send files by FTP
var gulpConfig = require('./gulp_config');

// Load plugins
const autoprefixer = require("gulp-autoprefixer");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const del = require("del");
const gulp = require("gulp");
const header = require("gulp-header");
const merge = require("merge-stream");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const notifier = require("node-notifier");
const ftp = require("vinyl-ftp");

// Load package.json for banner
const pkg = require('./package.json');

// Set the banner content
const banner = ['/*!\n',
	' * Start Bootstrap - <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
	' * Copyright 2013-' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
	' * Licensed under <%= pkg.license %> (https://github.com/BlackrockDigital/<%= pkg.name %>/blob/master/LICENSE)\n',
	' */\n',
	'\n'
].join('');

// BrowserSync
function browserSync(done) {
	browsersync.init({
		server: {
			baseDir: "./"
		},
		port: 3000
	});
	done();
}

// BrowserSync reload
function browserSyncReload(done) {
	browsersync.reload();
	done();
}

// Clean vendor
function clean() {
	// TODO: Artur nie usuwamy...
	//return del(["./vendor/"]);
}

// Bring third party dependencies from node_modules into vendor directory
function modules() {
	// Bootstrap JS
	var bootstrapJS = gulp.src('./node_modules/bootstrap/dist/js/*')
	.pipe(gulp.dest('./vendor/bootstrap/js'));
	// Bootstrap SCSS
	var bootstrapSCSS = gulp.src('./node_modules/bootstrap/scss/**/*')
	.pipe(gulp.dest('./vendor/bootstrap/scss'));
	// ChartJS
	var chartJS = gulp.src('./node_modules/chart.js/dist/*.js')
	.pipe(gulp.dest('./vendor/chart.js'));
	// dataTables
	var dataTables = gulp.src([
		'./node_modules/datatables.net/js/*.js',
		'./node_modules/datatables.net-bs4/js/*.js',
		'./node_modules/datatables.net-bs4/css/*.css'
	])
	.pipe(gulp.dest('./vendor/datatables'));
	// Font Awesome
	var fontAwesome = gulp.src('./node_modules/@fortawesome/**/*')
	.pipe(gulp.dest('./vendor'));
	// jQuery Easing
	var jqueryEasing = gulp.src('./node_modules/jquery.easing/*.js')
	.pipe(gulp.dest('./vendor/jquery-easing'));
	// jQuery
	var jquery = gulp.src([
		'./node_modules/jquery/dist/*',
		'!./node_modules/jquery/dist/core.js'
	])
	.pipe(gulp.dest('./vendor/jquery'));
	return merge(bootstrapJS, bootstrapSCSS, chartJS, dataTables, fontAwesome, jquery, jqueryEasing);
}

// CSS task
function css() {
	return gulp
	.src(devDir + "/scss/**/*.scss")
	.pipe(plumber())
	.pipe(sass({
		outputStyle: "expanded",
		includePaths: "./node_modules",
	}))
	.on("error", sass.logError)
	.pipe(autoprefixer({
		cascade: false
	}))
	.pipe(header(banner, {
		pkg: pkg
	}))
	.pipe(gulp.dest(destCssDir))
	.pipe(rename({
		suffix: ".min"
	}))
	.pipe(cleanCSS())
	.pipe(gulp.dest(destCssDir))
	// .pipe(deploy)
	.pipe(browsersync.stream());

}

// JS task
function js() {
	return gulp
	.src([
		devDir+'/js/*.js',
		'!'+devDir+'/js/*.min.js',
	])
	.pipe(uglify())
	.pipe(header(banner, {
		pkg: pkg
	}))
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(gulp.dest(destJsDir))
	.pipe(browsersync.stream());
}

// Watch files
function watchFiles() {
	gulp.watch(devDir+"/scss/**/*", css);
	gulp.watch([devDir+"/js/**/*", "!"+devDir+"/js/**/*.min.js"], js);
	gulp.watch("./**/*.html", browserSyncReload);
}

/* Get FTP connection */
function getConn() {
	return ftp.create(gulpConfig.ftp);
}

function deploy(cb) {

	var conn = getConn();

	return gulp.src( ftpGlobs, { base: '.', buffer: false } )
	//.pipe( conn.newer( '/public_html' ) ) // only upload newer files
	.pipe(conn.dest( '/public_html' ) )
	.on('finish', function() {
		notifier.notify({
			title: 'Wektorek',
			message: 'File uploaded'
		});
	});

	cb();
}

// Define complex tasks
const vendor = gulp.series(clean, modules);
const build = gulp.series(vendor, gulp.parallel(css, js));
const watch = gulp.series(build, gulp.parallel(watchFiles, browserSync));

// Export tasks
exports.css = css;
exports.js = js;
exports.clean = clean;
exports.vendor = vendor;
exports.build = build;
exports.watch = watch;
exports.default = build;
exports.deploy = deploy;