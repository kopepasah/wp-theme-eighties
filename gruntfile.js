module.exports = function(grunt) {

	grunt.initConfig({
		less: {
			compress: {
				files: {
					'style.min.css'                 : 'style.less',
					'fonts/fa/font-awesome.min.css' : 'fonts/fa/font-awesome.css'
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
				tasks: ['less:compress', 'shell:grunt'],
				options: {
					livereload: true,
				}
			}
		},
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: function() {
						return 'releases/' + name + '.zip';
					}
				},
				files: [
					{
						expand: true,
						src: [
							'**',
							'!.gitignore',
							'!.DS_Store',
							'!style.less',
							'!package.json',
							'!gruntfile.js',
							'!.git/**',
							'!less/**',
							'!node_modules/**',
							'!releases/**'
						]
					}
				]
			},
		},
		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					potFilename: 'eighties-en_US.pot',
					exclude: [
						'css/.*',
						'fonts/.*',
						'images/.*',
						'js/.*',
						'languages/.*',
						'less/.*',
						'releases/.*',
					],
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'http://github.com/kopepasah/eighties/issues';
						delete pot.headers['x-generator'];

						return pot;
					},
					type: 'wp-theme'
				}
			}
		},
		shell: {
			grunt: {
				command: 'afplay ~/Library/Sounds/Grunt.aiff'
			}
		},
		uglify: {
			main: {
				options: {
					mangle: false
				},
				files: {
					'js/backstretch.min.js'         : [ 'js/backstretch.js' ],
					'js/customizer-preview.min.js'  : [ 'js/customizer-preview.js' ],
					'js/eighties-blog.min.js'       : [ 'js/eighties-blog.js' ],
					'js/eighties-enable-js.min.js'  : [ 'js/eighties-enable-js.js' ],
					'js/eighties-header.min.js'     : [ 'js/eighties-header.js' ],
					'js/eighties-portfolio.min.js'  : [ 'js/eighties-portfolio.js' ],
					'js/eighties.min.js'            : [ 'js/eighties.js' ],
					'js/fitvids.min.js'             : [ 'js/fitvids.js' ],
					'js/skip-link-focus-fix.min.js' : [ 'js/skip-link-focus-fix.js' ]
				}
			}
		}
	});

	// Load tasks
	grunt.loadNpmTasks( 'grunt-contrib-less' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-shell' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );

	grunt.registerTask( 'zip', 'Make a zip file for the project.', function( name ){
		if ( name ) {
		    grunt.log.writeln( 'Zipping up the project with the name "' + name + '".');
			global.name = name;
		    grunt.task.run( 'compress' );
		} else {
			grunt.fail.fatal( 'No project name provided for the zip. Please run "grunt zip:name".' );
		}
	});

	// Register tasks
	grunt.registerTask( 'default', [
		'less'
	]);
};