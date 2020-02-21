<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* @datetime($var) */
        \Blade::directive('datetime', function($expression) {
            return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
        });

        /* @eval($var++) */
        \Blade::extend(function($view)
        {
            return preg_replace('/\@eval\((.+)\)/', '<?php ${1}; ?>', $view);
        });
    }

    public function register()
    {
        //
    }
}
