<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit187949e814921677b7997e70227565df
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit187949e814921677b7997e70227565df::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit187949e814921677b7997e70227565df::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}