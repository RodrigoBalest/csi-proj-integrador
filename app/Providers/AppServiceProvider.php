<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configLocale();
    }

    private function configLocale()
    {
        $locales = $this->app->config->getMany(['app.locale', 'app.fallback_locale']);
        $list = [];
        foreach ($locales as $l) {
            foreach (['', '.UTF8', '.UTF-8', '.utf8'] as $suffix) {
                $list[] = $l.$suffix;
            }
        }
        setlocale(LC_ALL, $list);
    }
}
