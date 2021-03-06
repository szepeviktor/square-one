const gulp = require( 'gulp' );
const requireDir = require( 'require-dir' );
const tasks = requireDir( './gulp_tasks' );
const browserSync = require( 'browser-sync' ).create( 'Tribe Dev' );

let config = require( './local-config.json' );

if ( ! config ) {
	config = {
		proxy: 'square1.tribe',
		certs_path: '',
	};
}

/**
 * List out your tasks as defined in the gulp_tasks directory
 * require-dir module will bring those in here as an object
 * Each task type object will be named by its filename
 * So: 'concat:themeMinVendors' means a file named 'concat' in the grunt_tasks dir,
 * and the method themeMinVendors inside that modules export.
 * You must follow this approach, or modify the registerTasks function below.
 *
 * @type {string[]}
 */

const gulpTasks = [
	/* Concat tasks */

	'concat:themeMinVendors', // concat the webpack and manual vendors together into one file

	/* Constants tasks */

	'constants:buildTimestamp', // set a timestamp for cache busting of css and js by php

	/* Copy tasks */

	'copy:coreIconsFonts', // copy fonts for icons from dev folder to theme
	'copy:coreIconsStyles', // copy styles for icons to theme pcss base dir
	'copy:coreIconsVariables', // copy variables for icons to theme pcss variables dir
	'copy:themeJS', // copy vendors from node_modules to theme js vendors dir

	/* Clean tasks */

	'clean:coreIconsStart', // delete all files related to icons in pcss, in prep for reinjection
	'clean:coreIconsEnd', // delete the zip file you pasted in dev_components
	'clean:themeMinCSS', // delete all minified css files in theme
	'clean:themeMinJS', // delete all minified js files in theme
	'clean:themeMinVendorJS', // delete all minified vendors in theme

	/* Cssnano tasks */

	'cssnano:themeMin', // minify the theme css
	'cssnano:themeLegacyMin', // minify the legacy css for old browsers
	'cssnano:themeWPEditorMin', // minify the editor css
	'cssnano:themeWPAdminMin', // minify the main admin css bundle
	'cssnano:themeWPLoginMin', // minify the login screen css

	/* Decompress tasks */

	'decompress:coreIcons', // extract the core-icons.zip from dev_components dir to dev_components/theme/icons/core

	/* Eslint tasks */

	'eslint:theme', // lint the theme js according to the products lint rules, uses fix to auto correct common issues
	'eslint:apps', // lint the apps js according to the products lint rules, uses fix to auto correct common issues
	'eslint:utils', // lint the utils js according to the products lint rules, uses fix to auto correct common issues
	'eslint:admin', // lint the admin js according to the products lint rules, uses fix to auto correct common issues

	/* Footer tasks */

	'footer:coreIconsVariables', // just adds a closing } to the icons variables file during the icons import transform tasks

	/* Header tasks */

	'header:coreIconsStyle', // sets the header for the core icons style file in base during the icons import transform tasks
	'header:coreIconsVariables', // sets the header for the core icons style file in vars during the icons import transform tasks
	'header:theme', // sets a small header for minified files to make them traceable when checking fe src
	'header:themePrint', // sets a small header for minified files to make them traceable when checking fe src
	'header:themeLegacy', // sets a small header for minified files to make them traceable when checking fe src
	'header:themeWPEditor', // sets a small header for minified files to make them traceable when checking fe src
	'header:themeWPLogin', // sets a small header for minified files to make them traceable when checking fe src

	/* Line ending tasks */

	'lineending:win', // used by those sad folks on win systems at times to avoid LOE change commits on vendor files

	/* Postcss tasks */

	'postcss:theme', // the big ol postcss task that transforms theme pcss to css
	'postcss:themeLegacy', // the postcss task that transforms legacy pcss to css
	'postcss:themeWPEditor', // the postcss task that transforms editor pcss to css
	'postcss:themeWPLogin', // the postcss task that transforms login pcss to css
	'postcss:themeWPAdmin', // the postcss task that transforms admin pcss to css

	/* Replace tasks */

	'replace:coreIconsStyle', // runs regex to replace and convert scss to pcss compatible with our systems in the icons task
	'replace:coreIconsVariables', // runs regex to replace and convert scss to pcss compatible with our systems in the icons task

	/* Shell tasks */

	'shell:yarnInstall', // runs yarn install at start of dist to make sure we are up to date. Exclude from server dist
	'shell:test', // runs jests tests
	'shell:scriptsThemeDev', // runs webpack for the theme dev build
	'shell:scriptsThemeProd', // runs webpack for the theme prod build
	'shell:scriptsAdminDev', // runs webpack for the admin dev build
	'shell:scriptsAdminProd', // runs webpack for the admin prod build

	/* Stylelint tasks */

	'stylelint:theme', // lints and fixes the theme pcss
	'stylelint:apps', // lints and fixes the apps pcss modules

	/* Uglify tasks */

	'uglify:themeMin', // minify vendors into a single min bundle (just after this they are concat with the webpack vendor bundle)

	/* Watch Tasks (THESE MUST BE LAST) */

	'watch:frontEndDev', // watch all fe assets for admin and theme and run appropriate routines
	'watch:watchAdminJS', // watch all fe assets for admin and theme and run appropriate routines
	'watch:watchThemeJS', // watch all fe assets for admin and theme and run appropriate routines
];

/**
 * Iterate over the above array. Split on the colon to access the imported tasks array's
 * corresponding function for the current task in the loop
 */

function registerTasks() {
	gulpTasks.forEach( ( task ) => {
		const parts = task.split( ':' );
		gulp.task( task, tasks[ parts[ 0 ] ][ parts[ 1 ] ] );
	} );
}

/**
 * Register all tasks in the gulp_tasks directory
 */

registerTasks();

/**
 * Takes a zip file from icomoon and injects it into the postcss, modifying the scss to pcss and handling all conversions/cleanup.
 */

gulp.task( 'icons', gulp.series(
	'clean:coreIconsStart',
	'decompress:coreIcons',
	'copy:coreIconsFonts',
	'copy:coreIconsStyles',
	'copy:coreIconsVariables',
	'replace:coreIconsStyle',
	'replace:coreIconsVariables',
	'header:coreIconsStyle',
	'header:coreIconsVariables',
	'footer:coreIconsVariables',
	'clean:coreIconsEnd',
	'clean:themeMinCSS',
	'postcss:theme',
	'cssnano:themeMin',
	'header:theme',
) );

const watchTasks = [
	'watch:frontEndDev',
	'watch:watchAdminJS',
	'watch:watchThemeJS',
];

gulp.task( 'watch', gulp.parallel( watchTasks ) );

/**
 * Watches all javascript, css and twig/php for theme/admin bundle, runs tasks and reloads browser using browsersync.
 */

gulp.task( 'dev', gulp.parallel( watchTasks, async function() {
	browserSync.init( {
		watchTask: true,
		debugInfo: true,
		logConnections: true,
		notify: true,
		open: 'external',
		host: config.proxy,
		proxy: `https://${ config.proxy }`,
		https: {
			key: `${ config.certs_path }/${ config.proxy }.key`,
			cert: `${ config.certs_path }/${ config.proxy }.crt`,
		},
		ghostMode: {
			scroll: true,
			links: true,
			forms: true,
		},
	} );
} ) );

/**
 * Lints js and css, fixed common issues automatically.
 */

gulp.task( 'lint', gulp.series(
	gulp.parallel( 'eslint:theme', 'eslint:apps', 'eslint:utils', 'eslint:admin', 'stylelint:theme', 'stylelint:apps' ),
) );

/**
 * Builds the entire package for production on a server.
 */

gulp.task( 'server_dist', gulp.series(
	gulp.parallel( 'clean:themeMinCSS', 'clean:themeMinJS', 'copy:themeJS' ),
	gulp.parallel( 'postcss:theme', 'postcss:themeWPAdmin', 'postcss:themeWPEditor', 'postcss:themeWPLogin', 'postcss:themeLegacy' ),
	gulp.parallel( 'cssnano:themeMin', 'cssnano:themeLegacyMin', 'cssnano:themeWPEditorMin', 'cssnano:themeWPAdminMin', 'cssnano:themeWPLoginMin' ),
	gulp.parallel( 'header:theme', 'header:themePrint', 'header:themeLegacy', 'header:themeWPEditor', 'header:themeWPLogin' ),
	gulp.parallel( 'shell:scriptsThemeDev', 'shell:scriptsAdminDev' ),
	gulp.parallel( 'shell:scriptsThemeProd', 'shell:scriptsAdminProd' ),
	'uglify:themeMin',
	'concat:themeMinVendors',
	gulp.parallel( 'clean:themeMinVendorJS', 'constants:buildTimestamp' ),
) );

/**
 * Builds the entire package for production locally, including tests, linting.
 */

gulp.task( 'dist', gulp.series(
	'shell:yarnInstall',
	'shell:test',
	gulp.parallel( 'eslint:theme', 'eslint:apps', 'eslint:utils', 'eslint:admin', 'stylelint:theme', 'stylelint:apps' ),
	gulp.parallel( 'clean:themeMinCSS', 'clean:themeMinJS', 'copy:themeJS' ),
	gulp.parallel( 'postcss:theme', 'postcss:themeWPAdmin', 'postcss:themeWPEditor', 'postcss:themeWPLogin', 'postcss:themeLegacy' ),
	gulp.parallel( 'cssnano:themeMin', 'cssnano:themeLegacyMin', 'cssnano:themeWPEditorMin', 'cssnano:themeWPAdminMin', 'cssnano:themeWPLoginMin' ),
	gulp.parallel( 'header:theme', 'header:themePrint', 'header:themeLegacy', 'header:themeWPEditor', 'header:themeWPLogin' ),
	gulp.parallel( 'shell:scriptsThemeDev', 'shell:scriptsAdminDev' ),
	gulp.parallel( 'shell:scriptsThemeProd', 'shell:scriptsAdminProd' ),
	'uglify:themeMin',
	'concat:themeMinVendors',
	gulp.parallel( 'clean:themeMinVendorJS', 'constants:buildTimestamp' ),
) );

gulp.task( 'default', gulp.series( 'dist' ) );
