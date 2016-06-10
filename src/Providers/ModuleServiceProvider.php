<?php

namespace KodiCMS\Userguide\Providers;

use KodiCMS\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function contextBackend()
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
