<?php
namespace App\Controllers;
use Core\Controller; 
use App\Models\User; 
use App\Models\Cart; 
use App\Models\Product; 

class HomeController extends Controller
{
    private $user;
    private $product;
    private $cart;

    public function __construct() 
    {
        $this->user = new User(); 
        $this->product = new Product(); 
        $this->cart = new Cart();  
    }

    public function index()
    {
        
        $all_Products = $this->product->getAllProducts();
        $count_Carts = $this->cart->countAllCarts();
        $prev_Rated = $this->user->getUserRatingActivities();

        if (!$prev_Rated) {
            $prev_Rated = [];
        } 
    
        $this->render("home", [
            'title' => 'Welcome to Demo Store',
            'rows' =>  $all_Products,
            'prev_rated' => $prev_Rated,
            'user_wallet_balance' => $this->user->getUserWalletBalance(),
            'count_carts' => $count_Carts 
        ]);
    }

    public function rate(int $retType, int $product_Id,  int $rating):array
    {
        
        $existing_Ratings = $this->product->getProductRating($product_Id);
        // Run check to double check user is not making a duplicate rating 
        // for same prioduct per session
        $updateStatus = $new_Average_Product_Rating = '';

        $user_Rating_Activity = $this->user->getUserRatingActivities();   

        if ( $user_Rating_Activity && gettype( $user_Rating_Activity ) === "array" && 
            array_key_exists($product_Id,  $user_Rating_Activity )  ) 
        {
            $updateStatus = 'Duplicate';
        }
        else { 
            if (gettype($existing_Ratings) === "array" && count($existing_Ratings) > 0)
            {
                // If successful, I should be expecting an integer
                $new_Average_Product_Rating = $this->product->updateProductRating($product_Id, $existing_Ratings, $rating);
                if (is_numeric($new_Average_Product_Rating)) 
                {
                    $updateStatus = 'Success';
                    $this->user->saveUserRatingActivity( $product_Id, $rating );
                }
                else
                {
                    $updateStatus = 'Fail';
                }  
            }

        }

        // Render
        switch ($retType) {
            case 2: 
                echo json_encode(array( "message" => $updateStatus, 'new_rating' => $new_Average_Product_Rating )); exit();
                break;
            default:
                $this->render("home", [ 
                    'message' => $updateStatus,  
                ]);
                break;
        }
    }

    public function addToCart(int $retType, int $product_Id):array
    {      
        $unique_Carts_Qty = $this->cart->countUniqueCartQty($product_Id);

        if (!$this->cart->checkCart($product_Id))
        { 
            $this->cart->saveCart($product_Id);
        }
        else { 

            $this->cart->updateCart($product_Id, $unique_Carts_Qty + 1);
        } 
        echo json_encode(array( 'message' => 'Success', 'new_Count' =>  $this->cart->countAllCarts() )); exit();
    }

    
}