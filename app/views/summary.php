<div class="demo_shopping-cart-wrapper">
    <div class="container">
        <div class="demo_listing-title">
            <h2> CART SUMMARY</h2>
        </div>
        <div class="row">
            <div class="col-md-7 col-lg-7">
                 <h4> Shipping details </h4> 
                        <div class="form-group">
                        <select class="form-control demo_shipping-type" >
                            <option value="">Please select an option</option>
                            <option value="PickUp">Pick Up (<?php echo DOLLAR . PICK_UP_COST ?>)</option>
                            <option value="UPS"> UPS (<?php echo DOLLAR . UPS_SHIPPING_COST ?>) </option> 
                            </select>
                        </div> 
                        
            </div>
            <div class="col-md-5 col-lg-5">
                <h4 class="float-left"> Cart Review </h4>
                <button type="button" class="btn btn-primary float-right">
                    Wallet Balance <span class="badge badge-light"> 
                       <?php echo DOLLAR  ?> <span class="demo_checkout-wallet-balance">
                           <?php echo $data["user_wallet_balance"];
                       ?></span> </span> 
                </button>
                <div class="clearfix"></div>
                <table class="table table-striped demo_cart-summary ">
                    <tr>
                        <td> Cost of Products </td> 
                        <td> <?php echo DOLLAR ?> 
                            <span class="demo_checkout-product-cost"><?php echo $data["cart_cost"]; ?></span> 
                        </td>
                    </tr>
                    <tr>
                        <td> Shipping Cost </td>
                        <td> <?php echo DOLLAR ?> 
                         <span class="demo_checkout-shipping-cost"></span> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> Gross Total</b>
                        </td>
                        <td> 
                            <?php echo DOLLAR ?> 
                            <span class="demo_checkout-gross-total"></span> 
                        </td>
                    </tr>

                </table>

                <button type="submit" class="btn btn-primary demo_checkout-btn">Checkout Now</button> 
                </div>
            </div>
        </div>

    </div>
</div>