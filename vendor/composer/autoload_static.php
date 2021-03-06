<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite7877270b8a0286e7717da8143629e38
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Authentication' => __DIR__ . '/../..' . '/app/controllers/auth/authentication.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Controller' => __DIR__ . '/../..' . '/app/core/controller.php',
        'Controller_About' => __DIR__ . '/../..' . '/app/controllers/controller_about.php',
        'Controller_Contacts' => __DIR__ . '/../..' . '/app/controllers/controller_contacts.php',
        'Controller_Gallery' => __DIR__ . '/../..' . '/app/controllers/controller_gallery.php',
        'Controller_Login' => __DIR__ . '/../..' . '/app/controllers/controller_login.php',
        'Controller_Logout' => __DIR__ . '/../..' . '/app/controllers/controller_logout.php',
        'Controller_Main' => __DIR__ . '/../..' . '/app/controllers/controller_main.php',
        'Controller_Portfolio' => __DIR__ . '/../..' . '/app/controllers/controller_portfolio.php',
        'Controller_Register' => __DIR__ . '/../..' . '/app/controllers/controller_register.php',
        'Controller_User' => __DIR__ . '/../..' . '/app/controllers/controller_user.php',
        'DatabaseTable' => __DIR__ . '/../..' . '/app/controllers/db/databaseTable.php',
        'Model' => __DIR__ . '/../..' . '/app/core/model.php',
        'Model_About' => __DIR__ . '/../..' . '/app/models/model_about.php',
        'Model_Contacts' => __DIR__ . '/../..' . '/app/models/model_contacts.php',
        'Model_Gallery' => __DIR__ . '/../..' . '/app/models/model_gallery.php',
        'Model_Login' => __DIR__ . '/../..' . '/app/models/model_login.php',
        'Model_Main' => __DIR__ . '/../..' . '/app/models/model_main.php',
        'Model_Portfolio' => __DIR__ . '/../..' . '/app/models/model_portfolio.php',
        'Model_User' => __DIR__ . '/../..' . '/app/models/model_user.php',
        'Route' => __DIR__ . '/../..' . '/app/core/route.php',
        'View' => __DIR__ . '/../..' . '/app/core/view.php',
        'old_Model_User' => __DIR__ . '/../..' . '/app/models/model_user_old.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite7877270b8a0286e7717da8143629e38::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite7877270b8a0286e7717da8143629e38::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite7877270b8a0286e7717da8143629e38::$classMap;

        }, null, ClassLoader::class);
    }
}
