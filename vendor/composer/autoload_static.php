<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit01f39ea28b5395fa5b01629988ab6644
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit01f39ea28b5395fa5b01629988ab6644::$fallbackDirsPsr4;

        }, null, ClassLoader::class);
    }
}
