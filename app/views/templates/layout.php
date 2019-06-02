<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data["title"]; ?></title>
    <meta name="description" content="<?php META_DESC ?>">
    <meta name="keywords" content="<?php META_KEYWORDS ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>public/css/style.css"  type="text/css">
</head>
<body>
    <header> 
        <div class="header-box">
            <div class="container"> 
                <div class="row"> 
                     <div class="demo_site-nav">
                       <nav class="navbar navbar-expand-lg navbar-dark bg-primary demo_navbar">
                            <a class="navbar-brand demo_navbar-brand" href="<?php echo URL_ROOT; ?>"> DEMO STORE </a> 
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav mr-auto demo_navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo URL_ROOT ?>">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0)">Inactive Link 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0)">Inactive Link 2</a>
                                    </li> 
                                </ul>
                                <span class="navbar-text">
                                 <a href="<?php echo URL_ROOT ?>cart">Shopping Cart <i class="fa fa-shopping-cart"></i>
                                     <span class="badge badge-light demo_cart-counter"><?php echo $data["count_carts"] ?></span>
                                     <i class="fa fa-university"></i>  <span class="badge badge-light demo_wallet-balance-display"><?php echo DOLLAR . ' '. $data["user_wallet_balance"] ?></span>
                                 </a>
                                </span>
                            </div>
                        </nav> 
                    </div>  
                </div> 
            </div>
        </div>

        
    </header>

    <section>
        <?php echo $main_Content; ?>
    </section>
    
    <div class="modal fade" id="demo_modal" tabindex="-1" role="dialog" aria-labelledby="demo_modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
            </div>
            </div>
        </div>
    </div> 

    <footer>
        &copy; <?php echo date("Y"); ?>
        <p> Developed By: Ilemona Success Ibrahim</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
    <script src="<?php echo URL_ROOT ?>public/js/home.js"></script>
    <script src="<?php echo URL_ROOT ?>public/js/cart.js"></script>
    
</body>
</html> 
 	