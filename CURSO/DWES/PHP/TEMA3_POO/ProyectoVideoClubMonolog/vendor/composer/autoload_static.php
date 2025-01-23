<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0fd534d28ff7315714670903d9519b4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'D' => 
        array (
            'DawM\\util\\' => 10,
            'DawM\\ProyectoVideoClubMonolog\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'DawM\\util\\' => 
        array (
            0 => __DIR__ . '/../..' . '/util',
        ),
        'DawM\\ProyectoVideoClubMonolog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita0fd534d28ff7315714670903d9519b4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita0fd534d28ff7315714670903d9519b4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita0fd534d28ff7315714670903d9519b4::$classMap;

        }, null, ClassLoader::class);
    }
}
