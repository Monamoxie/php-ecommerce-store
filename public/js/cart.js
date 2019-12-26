var cart = { 
    update: function(currElem) { 
        const [self, currWrap] = [this,  $(currElem).parent()];
        
        self.productID = parseInt( $(currElem).attr('id').replace(/\D/g, '')); 

        const updateQty = parseInt($("#input-"+self.productID).val().replace(/\D/g, '')); 
        
        if (updateQty < 1 || updateQty === "" || isNaN(updateQty)) {
            $("#demo_modal").modal();  
            $("#demo_modal .modal-body").html('Quantity must not be less than 1 and must be a number');
            $("#input-"+self.productID).val(1); 
            return false;
        }

        $(currElem).html('processing').attr('disabled', true);
        
        self.theTransporter(currWrap, currElem, updateQty, "updateCart");
    },

    remove: function(currElem) { 
        const [self, currWrap] = [this, $(currElem).parent()];

        self.productID = parseInt( $(currElem).attr('id').replace(/\D/g, '')); 
        
        const conf = confirm('Are you sure you wish to proceed');
        if (!conf) return false;

        $(currElem).html('processing...').attr('disabled', true);
        
        self.theTransporter(currWrap, currElem, "", "removeCart");
    },

    productID: 0,

    asyncFileExt: function (type) { 
        return type === 1 ? '.php' : '';
    },

    asyncServiceRoot: function() { 
        return window.location.href.toLowerCase();
    },

    preCheckout: function (currElem) { 
        const currWrap = $(currElem).parent();
        const shippingType = $(".demo_shipping-type").val();
        const productCost = parseFloat($(".demo_checkout-product-cost").html());
        const walletBalance = parseFloat($(".demo_checkout-wallet-balance").html());
        const shippingCost = parseFloat($(".demo_checkout-shipping-cost").html());
        const grossTotal = parseFloat($(".demo_checkout-gross-total").html());
        if (shippingType === "") {
            $('#demo_modal').modal();
            $("#demo_modal .modal-body").html('Please select your preferred mode of shipping');
            return false;
        }
        else if (grossTotal > walletBalance) {
            $('#demo_modal').modal();
            $("#demo_modal .modal-body").html('You do not have enough cash left in your wallet for this transaction!!!');
            return false;
        }
        $(currElem).html('processing...').attr('disabled', true);
        window.location.href = "checkout/2/0/"+shippingType;
    },
 

    checkout: function (currWrap, currElem, param3, action) { 
        this.theTransporter(currWrap, currElem, param3, action);
    },

    updateShippingCost: function (currElem) {
        var newGross = 0;
        const shippingType = $(currElem).val();
        const productCost = parseFloat($(".demo_checkout-product-cost").html()); 

        switch (shippingType) {
            case "":
                $('#demo_modal').modal();
                $(".demo_checkout-shipping-cost, .demo_checkout-gross-total").html('')
                $("#demo_modal .modal-body").html('Please select your preferred mode of shipping'); 
                break;
            case "PickUp":
                newGross = parseFloat(productCost + 0);
                $(".demo_checkout-shipping-cost").html(0)
                $(".demo_checkout-gross-total").html(newGross)
                break;
            default:
                newGross = parseFloat(productCost + 5);
                $(".demo_checkout-shipping-cost").html(5)
                $(".demo_checkout-gross-total").html(newGross)
                break;
        } 
    },

    theTransporter: function(currWrap, currElem, param3, action) {
        const self = this; 
        $.ajax({ 
            dataType: 'json',
            type: 'POST',  
            url: self.asyncServiceRoot()+"/"+action+"/2/"+self.productID+"/"+param3,
            contentType: 'application/x-www-form-urlencoded',
            success: function (response, status, xhr) { 

                switch (action) {
                    case "updateCart":
                        $(currElem).html('Update').attr('disabled', false); 
                        if (response.message === "Success")
                        { 
                            $(".demo_cart-counter").html(response.new_Total_Count);
                            const unit_Cost = $("#demo_cart-unit-cost-"+self.productID).html();
                            const new_Uniqe_Cost = parseFloat(unit_Cost * response.new_Unique_Count).toFixed(2);
                            $("#demo_cart-single-total-cost-"+self.productID).html(new_Uniqe_Cost);
                            $(".demo_cart-total-cost").html(response.new_Total_Cart_Cost);
                        }
                        break;
                    case "removeCart":
                        if (response.message === "Success")
                        {     
                            $(currElem).html('Remove Product').attr('disabled', false); 
                            $("#cart-"+self.productID).fadeOut(1000);
                            $(".demo_cart-counter").html(response.new_Total_Count);
                            const unit_Cost = $("#demo_cart-unit-cost-"+self.productID).html();
                            const new_Uniqe_Cost = parseFloat(unit_Cost * response.new_Unique_Count).toFixed(2);
                            $("#demo_cart-single-total-cost-"+self.productID).html(new_Uniqe_Cost);
                            $(".demo_cart-total-cost").html(response.new_Total_Cart_Cost);
                            
                        }
                    break;
                    default:
                        break;
                }
                
            },
            error: function (xhr, status, error) { 
                alert(error); return false;
            }, 
        });
    },

    

}

$(document).ready(function() {
    $(".demo_cart-update-btn").click(function(){ cart.update(this)});
    $(".demo_cart-remove").click(function(){ cart.remove(this)}); 
    $(".demo_shipping-type").change(function(){ cart.updateShippingCost(this)}); 
    $('.demo_list-my-ratings').css('display', 'none'); 
    $(".demo_checkout-summary").click(function(){ cart.summary(this)}); 
    $(".demo_checkout-btn").click(function(){ cart.preCheckout(this)});
}
); 	