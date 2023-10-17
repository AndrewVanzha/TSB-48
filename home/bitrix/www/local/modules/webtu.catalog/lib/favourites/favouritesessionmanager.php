<?php
namespace Webtu\Catalog\Favourites;

class FavouriteSessionManager extends FavouriteManager
{
    public function all()
    {
        if (isset($_SESSION['ifavourites']) && count($_SESSION['ifavourites'] > 0)) {
            return $_SESSION['ifavourites'];
        }

        return array();
    }

    public function check($product_id)
    {
        $product_id = (int)$product_id;

        if (isset($_SESSION['ifavourites'][$product_id])) {
            return true;
        }

        return false;
    }

    public function add($product_id)
    {
        $product_id = (int)$product_id;

        if (!isset($_SESSION['ifavourites'])) {
            $_SESSION['ifavourites'] = array();
        }

        $_SESSION['ifavourites'][$product_id] = $product_id;

        return true;
    }

    public function remove($product_id)
    {
        $product_id = (int)$product_id;

        if (isset($_SESSION['ifavourites'][$product_id])) {
            unset($_SESSION['ifavourites'][$product_id]);
        }

        return true;
    }
}