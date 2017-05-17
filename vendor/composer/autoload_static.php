<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6fa90193f551739c20cab085bd1e24cc
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6fa90193f551739c20cab085bd1e24cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6fa90193f551739c20cab085bd1e24cc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}