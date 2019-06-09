<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\User; 
use App\Models\Cart; 
use App\Models\Product;  

class CartController extends Controller 
{
    private $user, $product, $cart;

    public function __construct() 
    {
        $this->user = new User(); 
        $this->product = new Product(); 
        $this->cart = new Cart(); 
    }

    public function index()
    { 
         
        $all_Cart_Records = $this->cart->getAllCartRecords();
        $count_Carts = $this->cart->countAllCarts();
        $cart_Products = [];

        if ($count_Carts > 0) 
        {   
            foreach ($all_Cart_Records as $key => $value)
                {
                $cart_Products[] = $this->product->getSingleProduct($key);
            } 
        }
        
        $all_Product_Records = $this->product->getAllProducts();

        $total_Cart_Cost = $this->computeCartCost($all_Cart_Records);
          
        $this->render("cart", [
            'title' => 'My Shopping Cart',
            'all_cart_products' =>  $cart_Products, 
            'all_cart_quantity' => $all_Cart_Records,
            'count_carts' => $count_Carts,
            'user_wallet_balance' => $this->user->getUserWalletBalance(),
            'cart_cost' =>  $total_Cart_Cost
        ]);
    }


    public function updateCart(int $retType, int $product_Id, int $quantity )
    {   

        if ( (int) $quantity < 1 || !is_numeric($quantity) ) 
        {
            echo json_encode(array( 
                'message' => 'Quantity must not be less than 1 and it must be an integer' ));exit();
        }  
         $this->cart->updateCart($product_Id, $quantity);
  
        echo json_encode(array( 
            'message' => 'Success', 
            'new_Total_Count' => $this->cart->countAllCarts(),
            'new_Unique_Count' => $this->cart->countUniqueCartQty($product_Id),
            'new_Total_Cart_Cost' => $this->computeCartCost($this->cart->getAllCartRecords()),
        )); exit();
    }

    public function removeCart(int $retType, int $product_Id):array
    {
         
        if ( $this->cart->removeCartItem($product_Id) )
        {
            echo json_encode(array( 
                'message' => 'Success', 
                'new_Total_Count' => $this->cart->countAllCarts(),
                'new_Unique_Count' => $this->cart->countUniqueCartQty($product_Id),
                'new_Total_Cart_Cost' => $this->computeCartCost($this->cart->getAllCartRecords()),
            )); exit();
        }
        else 
        {
            echo json_encode(array( 
                'message' => 'Failed'
            )); exit();
        }
    }

    public function computeCartCost(array $cart_Records)
    {
        $total_Cost = 0;
        $i = 0;
        if (gettype($cart_Records) === "array" && count($cart_Records)){
            foreach ($cart_Records as $key => $value) 
            {
                $total_Cost +=  (float)$this->product->getSingleProductPrice($key) * (int)$value;
            }
        }
    
        return round((float) $total_Cost, 2);
    }   

     public function summary()
     {    
        $all_Cart_Records = $this->cart->getAllCartRecords(); 
        $total_Cart_Cost = $this->computeCartCost($all_Cart_Records); 
        $this->render("summary", [
            'title' => 'Cart Summary', 
            'cart_cost' =>  $total_Cart_Cost,
            'user_wallet_balance' => $this->user->getUserWalletBalance(),
            'count_carts' => $this->cart->countAllCarts()
        ]);
     }

     public function checkout(int $retType, int $product_Id, string $pick_up_type )
     {
        
        $all_Cart_Records = $this->cart->getAllCartRecords();
        $total_Cart_Cost = (gettype($all_Cart_Records) === "array") ? $this->computeCartCost($all_Cart_Records) : 0;
         
        if ($this->cart->removeAllCarts()) 
        {   
            $shipping_Cost =  $pick_up_type ==  "UPS" ? 5 : 0;
            $balance = $this->user->getUserWalletBalance() - ($total_Cart_Cost + $shipping_Cost);
            $newUserWalletBalance = $balance < 1 ? 0 : (float) $balance;
            $this->user->updateUserWalletBalance($newUserWalletBalance);
        }
        
        $this->render("checkout", [
            'title' => 'Checkout',
            'thank_you_message' => '
            <i class="fa fa-check"></i>
            We just received your order. You\'ll hear from us shortly.<br/> 
            Thank you once again.', 
            'cart_cost' =>  $total_Cart_Cost,
            'user_wallet_balance' => $this->user->getUserWalletBalance(),
            'count_carts' => $this->cart->countAllCarts()
        ]);
     }
}			