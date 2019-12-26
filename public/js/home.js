var home = 
{ 
    currStarred: [],

    ratingAlternator: function (currElem, altType) { 
        
        //Run a count to hold current state for this product rating
        const [self, currWrap] = [this, $(currElem).parent()];
    
        self.getStarred(currWrap); 
        
        switch (altType) {
            case "hover":   
                $(currElem).prevAll().addClass('demo_rating-rated');
                $(currElem).nextAll().removeClass('demo_rating-rated'); 
                $(currElem).addClass('demo_rating-rated'); 
                break;
            case "click":
                self.clickedIndex = parseInt ($(currElem).index() ) + 1; 
                for (var i = 0; i < $(currElem).index(); i++)
                { 
                    $(currWrap).children('.fa').eq(i).addClass("demo_rating-rated");
                }    
                self.productID = parseInt( $(currWrap).parents().eq(3).attr('id').replace(/\D/g, ''));
                return self.theTransporter(currWrap, currElem, "rate");
                break;
            case "exit":
                var defaultStarred = parseInt($(currWrap).children('number').html().replace(/\D/g, '')); 
                $(currWrap).children('.fa').removeClass("demo_rating-rated");
                for (var i = 0; i < defaultStarred; i++)
                { 
                    $(currWrap).children('.fa').eq(i).addClass("demo_rating-rated");
                }   
        }                     
    },

    getStarred: function(currWrap) {
        const self = this; 
        // Reset class property to [] -- pereadventure there werre previously stored elems
        self.currStarred = []; 
        $(currWrap).find('i.demo_rating-rated').each(function(k, elem)
        {
            self.currStarred.push($(currWrap).hasClass('demo_rating-rated'));
        }); 
    },

    propHolder: [],
    productID: 1,
    clickedIndex: '',

    asyncFileExt: function (type) { 
        return type === 1 ? '.php' : '';
    },

    asyncServiceRoot: function () {
        const root = window.location.href.toLowerCase();
        return root;
    },

    addToCart: function (currBtn) {
        const self = this;
        $(currBtn).html('Updating cart...').attr('disabled', true);
        const currWrap = $(currBtn).parent();
        self.productID = parseInt( $(currBtn).attr('id').replace(/\D/g, '')); 
        self.theTransporter(currWrap, currBtn, "addToCart");
    },

 
    theTransporter: function(currWrap, currElem, action) {
        const self = this; 
        $.ajax({ 
            dataType: 'json',
            type: 'POST',  
            url: self.asyncServiceRoot()+"home/"+action+"/"+parseInt("2")+"/"+parseInt(self.productID)+"/"+self.clickedIndex,
            contentType: 'application/x-www-form-urlencoded',
            success: function (response, status, xhr) { 
                //alert(response);
                switch (action) 
                {
                    case "rate":
                        $("#demo_modal").modal(); 
                        if (response.message === "Duplicate") { 
                            $("#demo_modal .modal-body").html(  'You have already submitted a rating for this product' );
                        }
                        else if (response.message === "Failed") {
                            $("#demo_modal .modal-body").html(  'An error occured. Please try again later');
                        } 
                        else {
                            $("#demo_modal .modal-body").html(  'Thank you for rating this product ');
                            $(currWrap).children('number').html( '('+response.new_rating+')');
                            for (var i = 0; i < parseInt(response.new_rating); i++)
                            { 
                            $(currWrap).children('.fa').eq(i).addClass("demo_rating-rated");
                            }  
                        }
                        break;
                    case "addToCart": 
                        $(currElem).html('Add To Cart').attr('disabled', false); 
                        if (response.message === "Failed") {
                            $("#demo_modal").modal(); 
                            $("#demo_modal .modal-body").html('An error occured. Please refresh the page anf try again');
                        } 
                        else {
                            $(".demo_cart-counter").html(response.new_Count); 
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
    $(".demo_list-rating-info i").mouseenter(function(){ home.ratingAlternator(this, "hover")});
    $(".demo_list-rating-info i").click(function(){ home.ratingAlternator(this, "click")});
    $(".demo_list-rating-info i").mouseleave(function(){ home.ratingAlternator(this, "exit");});
    $(".demo_cart-add-btn").click(function(){ home.addToCart(this)}); 
     
    $('.demo_list-my-ratings').css('display', 'none');
}
); 
