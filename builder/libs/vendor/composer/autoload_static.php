<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa9edb03547b184117357aa78b52f1ba
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa9edb03547b184117357aa78b52f1ba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa9edb03547b184117357aa78b52f1ba::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfa9edb03547b184117357aa78b52f1ba::$classMap;

        }, null, ClassLoader::class);
    }
}
