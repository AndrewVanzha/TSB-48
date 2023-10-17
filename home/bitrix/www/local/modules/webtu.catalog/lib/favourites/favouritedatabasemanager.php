<?php
namespace Webtu\Catalog\Favourites;

class FavouriteDatabaseManager extends FavouriteManager
{
    protected $table = 'webtu_catalog_favourites';

    public function all()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE USER_ID = '{$this->user->GetID()}'");
        $items = array();
        while ($row = $result->GetNext()) {
            $items[] = $row['PRODUCT_ID'];
        }

        return $items;
    }

    public function check($product_id)
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE USER_ID = '{$this->user->GetID()}' AND PRODUCT_ID = '$product_id'");
        if ($row = $result->GetNext()) {
            return true;
        }

        return false;
    }

    public function add($product_id)
    {
        $product_id = (int)$product_id;

        $result = $this->db->query("SELECT * FROM {$this->table} WHERE USER_ID = '{$this->user->GetID()}' AND PRODUCT_ID = '$product_id'");
        if ($row = $result->GetNext()) {
            return true;
        }

        $this->db->query("INSERT INTO {$this->table} (USER_ID, PRODUCT_ID) VALUES ('{$this->user->GetID()}', '$product_id');");

        return true;
    }

    public function remove($product_id)
    {
        $product_id = (int)$product_id;
        $this->db->query("DELETE FROM {$this->table} WHERE USER_ID = '{$this->user->GetID()}' AND PRODUCT_ID = '$product_id'");
        return true;
    }
}