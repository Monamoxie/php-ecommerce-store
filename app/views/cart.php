<div class="demo_shopping-cart-wrapper">
    <div class="container">
        <div class="demo_listing-title">
            <h2> MY SHOPPING CART </h2>
        </div>
        <table class="table demo_cart-table">
            <thead>
                <tr>
                <th scope="col"></></th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Cost (<?php echo DOLLAR; ?>)</th>
                <th scope="col">Total Cost (<?php echo DOLLAR; ?>)</th>
                </tr>
            </thead>
            
                <?php 
                if ($data["count_carts"] > 0)
                {
                    $i = 0;
                    echo '<tbody>';
                    foreach ($data["all_cart_products"] as $cart) {
                        echo ' 
                            <tr id="cart-'.$cart["id"].'">
                            <th scope="row"> <img src="'.URL_ROOT.'public/img/'.$cart["image"].'" alt="'.$cart["name"].'"> </th>
                            <td>'.$cart["name"].'</td>
                            <td>  
                                <div class="demo_cart-qty-wrapper">    
                                    <div class="input-group">
                                        <input type="text" value="'.$data["all_cart_quantity"][$cart["id"]].'" id="input-'.$cart["id"].'">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary demo_cart-update-btn" type="button" 
                                            id="demo_cart-update-btn-'.$cart["id"].'">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><span id="demo_cart-unit-cost-'.$cart["id"].'">'.$cart["price"].'</td>
                            <td>
                                <span id="demo_cart-single-total-cost-'.$cart["id"].'">'. (float) $cart["price"] * $data["all_cart_quantity"][$cart["id"]].' </span>
                                 <br/>
                                  <span class="badge badge-danger demo_cart-remove" id="demo_cart-remove'.$cart["id"].'"> Remove Product </span>  
                            </td>
                            </tr>
                        ';
                        $i += 1;
                    }
                    echo '</tbody>';
                }

                else {
                    echo '
                    <div class="demo_list-cart-empty">
                        <div class="alert alert-warning"> 
                            Your cart is empty.
                        </div>
                    </div>';
                } 
                ?>
            
        </table>
        <?php 
             if ($data["count_carts"] > 0)
             {
                echo '
                    <div class="float-right"> 
                        <a href="'.URL_ROOT.'cart/summary" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
                            Check Out ('. DOLLAR . '<span class="demo_cart-total-cost">'. $data["cart_cost"] .'</span>)</a> 
                    </div>';
             }
        ?>
        
        <div class="clearfix"></div>
         
    </div>
</div>
