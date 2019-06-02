<?php
 
class Cart extends Model 
{   
 
    public function checkCart(int $product_Id):bool
    {   
        if (!$this->session->checkCart($product_Id)) 
        {
            return false;
        }
        return true;
    }

    public function getAllCartRecords() 
    {
        if ($this->countUniqueCarts() > 0) 
        {
            return $this->session->getAllCarts();
        } 
        return [];
    }

    public function saveCart(int $product_Id):bool
    {
        if ($this->session->saveCart($product_Id))
        {
            return true;
        }
        return false;
    }

    public function updateCart(int $product_Id, int $quantity):bool
    { 

        if ($this->session->updateCart($product_Id, $quantity))
        {
            return true;
        }
        return false;
    }

    public function removeCartItem(int $product_Id)
    {
        return $this->session->removeCartItem($product_Id);
    }

    public function removeAllCarts()
    {
        return $this->session->removeAllCarts();
    }
 

    public function countUniqueCarts()
    {
        return $this->session->countUniqueCarts();
    }

    public function countAllCarts()
    {
        return $this->session->countAllCarts();
    }

    public function countUniqueCartQty(int $product_Id)
    {   
        return $this->session->countUniqueCartQty($product_Id);
    }


}	