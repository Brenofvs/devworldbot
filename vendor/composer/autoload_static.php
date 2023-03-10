<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee818e831aaf723609905d39c99efc46
{
    public static $files = array (
        '2a09168da471bf4df7d53617af661436' => __DIR__ . '/../..' . '/source/Support/Config.php',
        'e67f7497e654cf1b0bf1a60b9ec6f0f6' => __DIR__ . '/../..' . '/source/Support/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee818e831aaf723609905d39c99efc46::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee818e831aaf723609905d39c99efc46::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitee818e831aaf723609905d39c99efc46::$classMap;

        }, null, ClassLoader::class);
    }
}
