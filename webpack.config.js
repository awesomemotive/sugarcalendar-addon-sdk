// External dependencies
const webpack = require( 'webpack' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const UglifyJS = require( 'uglify-es' );

// See CopyWebpackPlugin() below for usage
const MinifyJs = ( content ) => {
	return Promise.resolve( Buffer.from( UglifyJS.minify( content.toString() ).code ) );
};

// Array of admin pages with JavaScript needing reducing
const adminPages = [];

// Webpack configuration.
const config = {
	mode: process.env.NODE_ENV === 'production'
		? 'production'
		: 'development',
	resolve: {
		modules: [
			`${ __dirname }/assets/js`,
			'node_modules',
		],
	},
	entry: Object.assign(

		// Dynamic entry points for individual admin pages.
		adminPages.reduce( ( memo, path ) => {
			memo[ `sc-addon-${ path.replace( '/', '-' ) }` ] = `./admin/assets/js/admin/${ path }`;
			return memo;
		}, {} ),
		{
			'sc-addon-general': './admin/assets/js/general',
		}
	),
	output: {
		filename: 'assets/js/[name].js',
		path: __dirname,
	},
	module: {
		rules: [
			{
				test: /.js$/,
				use: 'babel-loader',
				exclude: /node_modules/,
				include: /assets\/js/,
			},
		],
	},
	externals: {
		jquery: 'jQuery',
		$: 'jQuery',
	},
	plugins: [
		// Copy vendor files to ensure 3rd party plugins relying on a script
		// handle to exist continue to be enqueued.
		new CopyWebpackPlugin( [
			/*
			{
				from: './node_modules/flot/jquery.flot.pie.js',
				to: 'assets/js/vendor/jquery.flot.pie.min.js',
				transform: ( content ) => MinifyJs( content ),
			},
			*/
		] ),
	],
};

if ( config.mode !== 'production' ) {
	config.devtool = process.env.SOURCEMAP || 'source-map';
}

module.exports = config;
