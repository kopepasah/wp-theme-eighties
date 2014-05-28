module.exports = function(grunt) {

	grunt.initConfig({
		less: {
			compress: {
				files: {
					'style.min.css' : 'style.less' 
				},
				options: {
					compress: true,
				}
			},
			standard: {
				files: {
					'style.css' : 'style.less'
				}
			}
		},
	});

	// Load tasks
	grunt.loadNpmTasks( 'grunt-contrib-less' );

	// Register tasks
	grunt.registerTask( 'default', [
		'less'
	]);
};