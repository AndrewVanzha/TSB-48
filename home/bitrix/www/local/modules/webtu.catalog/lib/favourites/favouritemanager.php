<?php
namespace Webtu\Catalog\Favourites;

abstract class FavouriteManager
{
    abstract public function all();
    abstract public function check($product_id);
    abstract public function add($product_id);
    abstract public function remove($product_id);

    public function __construct($user, $db)
    {
        $this->user = $user;
        $this->db = $db;
    }
}