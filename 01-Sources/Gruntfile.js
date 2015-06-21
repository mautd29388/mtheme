module.exports = function (grunt) {
	// load all deps
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// configuration
	grunt.initConfig({
		pgk: grunt.file.readJSON('package.json'),
		
		// https://npmjs.org/package/grunt-contrib-compass
		compass: {
			all: {
				options: {
					sassDir:        'lib',
					cssDir:         'css',
					imagesDir:      'img',
					outputStyle:    'compact',
					relativeAssets: true,
					noLineComments: true,
					watch:          true
				}
			}
		},

		// https://npmjs.org/package/grunt-contrib-watch
		watch: {
			options: {
				livereload: true
			},
			files: ['{,*/}/*.{css,js}', '{,*/}*.{php,html}']
		},
		
		// https://npmjs.org/package/grunt-concurrent
		concurrent: {
			server: [
				'compass:all',
				'watch',
				'concat'
			]
		},

		// https://npmjs.org/package/grunt-contrib-jshint
		jshint: {
			dist: {
				jshintrc: true,
				files: {
					src: ['assets/js/main.js', 'Gruntfile.js']
				}
			}
		},

		concat: {   
		    dist: {
		        src: [
		            'js/jqueryui/*.js',
		            'js/icheck/*.js', 
		            'js/sliderRevolution/*.js', 
		            'js/vendor/*.js', 
		            'js/backstrech/*.js', 
		            'js/instafeed/*.js', 
		            'js/twentytwenty/*.js', 
		            'js/share/*.js', 
		            'js/gmaps/*.js', 
		            'js/stellar/*.js', 
		            'js/main.js'
		        ],
		        dest: 'js/build/production.js',
		    }
		}


	});

	// when developing
	grunt.registerTask('server', [
		'concurrent:server'
	]);

	// linting
	grunt.registerTask('lint', ['jshint']);

	grunt.log.writeln("Listening to Wolf");

	// defaults to the server
	grunt.registerTask('default', [
		'server'
	]);

};