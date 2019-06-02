<?php
   
class Session 
{ 
    public function checkSession($name)
    {
        if (isset($_SESSION[$name]))
        {
			return true;
		}
		else {
			return false;
		}
	}	
   
    public function createSession($name, $value)
    {		
        if (!isset($_SESSION[$name])) 
        {
		    $_SESSION[$name] = $value;
		    return true;
		}
			return false;
	}	
					
    public function getSession($name)
    {		
        if (isset($_SESSION[$name])) 
        {  
            return $_SESSION[$name];	
		}
		return false;	
	}	
			 
    public  function removeSession($name) 
    {	 
		if ($this->sessionCheck($name)){
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    } 

    public function checkUserWalletBalance()
    {
        if (isset($_SESSION[USER_WALLET_TAG])){
            return true;
        }
        return false;
    }

    public function getUserWalletBalance()
    { 
        return (float) $_SESSION[USER_WALLET_TAG];
        
    }

    public function createUserWalletBalance()
    {
        $_SESSION[USER_WALLET_TAG] = DEFAULT_WALLET_BALANCE;
        return DEFAULT_WALLET_BALANCE;
    }

    public function updateUserWalletBalance($newBalance)
    {
        $_SESSION[USER_WALLET_TAG] = $newBalance;
        return true;
    }

    public  function saveUserRatings($product_Id, $user_Rating)
    {
        if ($_SESSION[PRODUCT_RATING_ARR][$product_Id] = $user_Rating)
        {
            return true;
        }
        return  false;
    }

    public  function getUserRatings()
    {
        if (isset($_SESSION[PRODUCT_RATING_ARR])) 
        {  
            return $_SESSION[PRODUCT_RATING_ARR];	
		}
		return false;	
    }

    /**
    * Array Key =  product id 
    * Array Value = total quantity of that very product in cart
    */
    public function saveCart($product_Id)
    {   
        if ( !isset($_SESSION[USER_CART_TAG]) )
        {
            $_SESSION[USER_CART_TAG] = array();
        }
        $_SESSION[USER_CART_TAG][$product_Id] = 1;
    }

    public function getCart()
    {
        if (isset($_SESSION[USER_CART_TAG])) 
        {  
            return $_SESSION[USER_CART_TAG];	
		}
		return false;
    }

    public function updateCart($product_Id, $quantity)
    {
        if ( array_key_exists($product_Id,  $_SESSION[USER_CART_TAG] ))
        {
            $_SESSION[USER_CART_TAG][$product_Id] = $quantity;
            return true;
        }
        return false;
    }

    public function checkCart($product_Id)
    {
        if (isset($_SESSION[USER_CART_TAG][$product_Id]))
        {
            return true;
        } 
        return false;
    }

    public function removeAllCarts()
    {
        unset($_SESSION[USER_CART_TAG]);
        return true;
    }

    public function getAllCarts()
    {
        if (isset($_SESSION[USER_CART_TAG])) 
        {
            return $_SESSION[USER_CART_TAG];
        }
        return false;
    }

    public function removeCartItem($product_Id)
    {
        unset($_SESSION[USER_CART_TAG][$product_Id]);
        return true;
    }

    public function countUniqueCarts()
    {
        if (isset($_SESSION[USER_CART_TAG])) 
        {
            return count($_SESSION[USER_CART_TAG]);
        }
        return 0;
    }


    public function countAllCarts()
    {
        if ( isset($_SESSION[USER_CART_TAG]) )
        {
            $total = 0;
            foreach ($_SESSION[USER_CART_TAG] as $key => $value) 
            {
                $total += $value;
            }
            return $total;
        }
        return 0;
    }

    public function countUniqueCartQty($product_Id)
    {
        if (isset($_SESSION[USER_CART_TAG][$product_Id]))
        {
            return $_SESSION[USER_CART_TAG][$product_Id];
        } 
        return 0;
    } 
}