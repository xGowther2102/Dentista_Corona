<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4b5d18ff96865c2a9667c07472a61d80
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4b5d18ff96865c2a9667c07472a61d80::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4b5d18ff96865c2a9667c07472a61d80::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4b5d18ff96865c2a9667c07472a61d80::$classMap;

        }, null, ClassLoader::class);
    }
}
