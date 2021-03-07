/* eslint-env node */
module.exports = function ( grunt ) {
	grunt.loadNpmTasks( 'grunt-banana-checker' );
	grunt.loadNpmTasks( 'grunt-eslint' );

	grunt.initConfig( {
		eslint: {
			options: {
				cache: true
			},
			all: [
				'**/*.{js,json}',
				// Ignore js files we can't edit directly
				'!scripts/jquery.ezpz_tooltip.js',
				'!scripts/jquery.ezpz_tooltip.min.js',
				'!node_modules/**',
				'!vendor/**'
			]
		},
		banana: [ 'i18n/' ]
	} );

	grunt.registerTask( 'test', [ 'eslint', 'banana' ] );
	grunt.registerTask( 'default', 'test' );
};
