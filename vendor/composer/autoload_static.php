<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbeee84e4b27bf01798b38f20f31e7728
{
    public static $files = array (
        '8ca8a91f0a826d6c6c8f274c90ca7d88' => __DIR__ . '/..' . '/wpmetabox/meta-box/meta-box.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ShippingAppointments\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ShippingAppointments\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbeee84e4b27bf01798b38f20f31e7728::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbeee84e4b27bf01798b38f20f31e7728::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
