<?php  
define('MODE', 'DEVELOPMENT');

//define("APP_ROOT", dirname(__FILE__) . '/');  

define("APP_ROOT", dirname(__DIR__ ) . '/');
define("DEVELOPMENT_PUBLIC_FOLDER", "store");

define("URL_ROOT", "https://localhost/store/");
define('VIEW_ROOT', APP_ROOT . '/app/views/'); 
define("SITE_NAME", "Demo Store");
 

// DATABASE
define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB", "demo_store"); 

// SEO
define("META_DESC", " A demo web store I built for ABC Hosting for demo web things  ");
define("META_KEYWORDS", "Most afforfable online store, apple, samsung, nokia, free shipping online stores");
 
// CURRENCIES IN USE
define("DOLLAR", "$");

// USER
define("USER_ID_TAG", "user_id");
define("USER_WALLET_TAG", "user_wallet");    
define("USER_IP", $_SERVER['REMOTE_ADDR']);

//PRODUCT
define("PRODUCT_RATING_ARR", "product_rate_arr"); 

//cart
define("USER_CART_TAG", "cart_id");

// check out defaults
define("PICK_UP_COST", 0);
define("UPS_SHIPPING_COST", 5);

define("DEFAULT_WALLET_BALANCE", 100);