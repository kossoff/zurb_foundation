module.exports = function(grunt) {
  var theme_name = 'STARTER';

  var global_vars = {
    theme_name: theme_name,
    theme_css: 'css',
    theme_scss: 'scss'
  }

  grunt.initConfig({
    global_vars: global_vars,
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        options: {
          outputStyle: 'compressed',
          includePaths: ['<%= global_vars.theme_scss %>', require('node-bourbon').includePaths]
        },
        files: {
          '<%= global_vars.theme_css %>/<%= global_vars.theme_name %>.css': '<%= global_vars.theme_scss %>/<%= global_vars.theme_name %>.scss'
        }
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: '<%= global_vars.theme_scss %>/**/*.scss',
        tasks: ['sass'],
        options: {
          livereload: true
        }
      },

      copy: {
        dist: {
          files: [
            {expand:true, cwd: 'js/', src: ['foundation/*.js'], dest: 'js/foundation', filter: 'isFile'},
            {expand:true, cwd: 'scss/', src: '**/*.scss', dest: 'scss/vendor/foundation', filter: 'isFile'},
            {src: 'bower.json', dest: 'dist/assets/'}
          ]
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['build','copy','watch']);
}