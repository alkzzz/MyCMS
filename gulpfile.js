var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('frontend.scss', 'public/css/frontend.css');
	mix.scripts(['../../../node_modules/jquery/dist/jquery.min.js',
    			'../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js'], 
    			'public/js/frontend.js');
    mix.copy('node_modules/bootstrap-sass/assets/fonts', 
    		 'public/fonts');
    mix.less('sb-admin-2.less', 'public/css/sb-admin-2.css');
    mix.styles(['../../../bower_components/bootstrap/dist/css/bootstrap.min.css',
    			'../../../bower_components/metisMenu/dist/metisMenu.min.css',
    			'../../../bower_components/font-awesome/css/font-awesome.min.css',
    			'../../../public/css/sb-admin-2.css'], 
    			'public/css/backend.css');
    mix.scripts(['../../../bower_components/jquery/dist/jquery.min.js',
    			'../../../bower_components/bootstrap/dist/js/bootstrap.min.js',
    			'../../../bower_components/metisMenu/dist/metisMenu.min.js',
    			'../../../bower_components/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js'],
    			'public/js/backend.js')
});
