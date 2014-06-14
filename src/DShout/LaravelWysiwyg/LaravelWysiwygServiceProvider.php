<?php namespace DShout\LaravelWysiwyg;

use Illuminate\Support\ServiceProvider;

class LaravelWysiwygServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('d-shout/laravel-wysiwyg');
		\Form::macro('wysiwyg', function($name, $value = null, $options = []) {
		    if (isset($options['class'])) {
		        $options['class'] .= " ckeditor ";
		    } else {
		        $options['class'] = " ckeditor ";
		    }
		    return '<script src="//cdn.ckeditor.com/4.4.1/full/ckeditor.js"></script>' . \Form::textarea($name, $value, $options);
		    //return HTML::script('/plugins/ckeditor/ckeditor.js') . Form::textarea($name, $value, $options);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
