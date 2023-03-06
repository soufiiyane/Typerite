<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc489fd759460e39b638e86c70d28432
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'E' => 
        array (
            'Embera\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Embera\\' => 
        array (
            0 => __DIR__ . '/..' . '/mpratt/embera/src/Embera',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc489fd759460e39b638e86c70d28432::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc489fd759460e39b638e86c70d28432::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc489fd759460e39b638e86c70d28432::$classMap;

        }, null, ClassLoader::class);
    }
}
