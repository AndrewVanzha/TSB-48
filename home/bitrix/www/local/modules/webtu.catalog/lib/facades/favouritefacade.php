<?php
namespace Webtu\Catalog\Facades;

class FavouriteFacade
{
    protected static $manager = NULL;
    protected static $isInitialized = false;

    public static function __callStatic($name, $arguments) {
        self::init();
        return call_user_func_array(array(self::$manager, $name), $arguments);
    }

    public static function init()
    {
        if (self::$isInitialized) {
            return;
        }

        global $DB, $USER;

        self::$manager = \Webtu\Catalog\Favourites\FavouriteFabric::getInstance($USER, $DB);
        self::$isInitialized = true;
    }
}