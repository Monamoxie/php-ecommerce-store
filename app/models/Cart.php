<?php
class Cart extends Model 
{   
 
    public function checkCart($product_Id)
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
        return false;
    }

    public function saveCart($product_Id)
    {
        if ($this->session->saveCart($product_Id))
        {
            return true;
        }
        return false;
    }

    public function updateCart($product_Id, $quantity)
    { 

        if ($this->session->updateCart($product_Id, $quantity))
        {
            return true;
        }
        return false;
    }

    public function removeCartItem($product_Id)
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

    public function countUniqueCartQty($product_Id)
    {   
        return $this->session->countUniqueCartQty($product_Id);
    }


}	