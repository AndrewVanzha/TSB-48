<?php
namespace Webtu\Catalog\Favourites;

class FavouriteFabric
{
    public static function getInstance($user, $db)
    {
        if ($user->isAuthorized()) {
            return new FavouriteDatabaseManager($user, $db);
        } else {
            return new FavouriteSessionManager($user, $db);
        }
    }
}