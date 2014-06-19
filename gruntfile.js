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
		watch: {
			css: {
				files: ['style.less','less/*.less'],
				tasks: ['less:compress'],
				options: {
					livereload: true,
				}
			}
		}
	});

	// Load tasks
	grunt.loadNpmTasks( 'grunt-contrib-less' );
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Register tasks
	grunt.registerTask( 'default', [
		'less',
		'watch'
	]);
};