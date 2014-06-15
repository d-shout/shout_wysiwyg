<?php

namespace DShout\LaravelWysiwyg;

use Illuminate\Support\ServiceProvider;

class LaravelWysiwygIncludeChecker {

    public static $ckIncluded = false;

}

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
    public function boot() {
        $this->package('d-shout/laravel-wysiwyg');
        \Form::macro('wysiwyg', function($name, $value = null, $options = [], $config = []) {

            $defConfig = [
                'filebrowserBrowseUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/browse.php?opener=ckeditor&type=files'),
                'filebrowserImageBrowseUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/browse.php?opener=ckeditor&type=images'),
                'filebrowserFlashBrowseUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/browse.php?opener=ckeditor&type=flash'),
                'filebrowserUploadUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/upload.php?opener=ckeditor&type=files'),
                'filebrowserImageUploadUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/upload.php?opener=ckeditor&type=images'),
                'filebrowserFlashUploadUrl' => url('packages/d-shout/laravel-wysiwyg/kcfinder/upload.php?opener=ckeditor&type=flash')
            ];
            $ckConfig = json_encode(array_merge($defConfig, $config));

            $returnHtml = '';
            if (!LaravelWysiwygIncludeChecker::$ckIncluded) {
                LaravelWysiwygIncludeChecker::$ckIncluded = true;
                $returnHtml = '<script src="//cdn.ckeditor.com/4.4.1/full/ckeditor.js"></script>';
            }
            return $returnHtml . \Form::textarea($name, $value, $options) .
            '<script>	
	            CKEDITOR.replace( "' . $name . '", ' . $ckConfig . ');	
		    </script>';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}
