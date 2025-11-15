<?php

return [
    'theme' => \PowerComponents\LivewirePowerGrid\Themes\Tailwind::class,

    'plugins' => [
        \PowerComponents\LivewirePowerGrid\Plugins\Filters::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes
    |--------------------------------------------------------------------------
    */
    'themes' => [
        'tailwind' => [
            'table' => 'min-w-full',
            'footer' => 'bg-white px-4 py-3 items-center border-t border-gray-200 sm:px-6',
            'thead' => 'bg-gray-50',
            'th' => 'px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            'tr' => 'bg-white hover:bg-gray-50',
            'td' => 'px-2 py-4 whitespace-nowrap text-sm text-gray-600',
            'checkbox' => 'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500',
        ]
    ],
];
