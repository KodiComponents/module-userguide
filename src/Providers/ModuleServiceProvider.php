<?php

namespace KodiCMS\Userguide\Providers;

use Event;
use KodiCMS\Userguide\Navigation\Page;
use KodiCMS\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Event::listen('config.loaded', function () {
            $this->registerNavigation();
        }, 999);
    }

    public function register()
    {
    }

    private function registerNavigation()
    {
        $navigation = \Navigation::addPage([
            'id' => 'documentation',
            'icon' => 'book',
            'title' => 'userguide::core.title',
            'priority' => 9999,
        ]);

        $modules = array_reverse(config('userguide.modules'));

        // Remove modules that have been disabled via config
        foreach ($modules as $key => $value) {
            if (! config('userguide.modules.'.$key.'.enabled')) {
                continue;
            }

            $title = config('userguide.modules.'.$key.'.name');

            if (empty($title)) {
                $title = $key;
            }

            $navigation->addPage([
                'id' => $key,
                'icon' => 'leanpub',
                'title' => $title,
                'url' => route('backend.userguide.docs', [$key]),
            ]);
        }
    }
}
