<?php
    session_start();

    include './models/database.php';
    
    include './classes/User.php';
    include './classes/Product.php';
    include './classes/Category.php';
    include './classes/Cart.php';
    include './classes/purchase.php';

    include './models/userdb.php';
    include './models/productdb.php';
    include './models/categorydb.php';
    include './models/cartdb.php';
    include './models/purchasedb.php';

    include './controllers/user_controller.php';
    include './controllers/product_controller.php';
    include './controllers/category_controller.php';
    include './controllers/cart_controller.php';
    include './controllers/purchase_controller.php';

    $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    $action = filter_input(INPUT_POST, 'action');    

    /*$https = filter_input(INPUT_SERVER, 'HTTPS');
    
    if (!$https) {
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $url = 'https://' . $host . $uri;
        header("Location: " . $url);
        exit;
    }*/
    

    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'home_page';
        }
    }

    $controller = null;
    switch ($action) {
        case 'home_page':
            $controller = new ProductController();
            $controller->list_all_products();
            break;
        
        case 'show_add_product_form':
            $controller = new ProductController();
            $controller->show_add_product_form();
            break;

        case 'add_product':
            $controller = new ProductController();
            $controller->add_product();
            break;

        case 'edit_product':
            $controller = new ProductController();
            $controller->edit_product();
            break;

        case 'delete_product':
            $controller = new ProductController();
            $controller->delete_product();
            break;

        case 'show_product':
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
            $controller = new ProductController();
            if (!isset($productID)) { $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT); }
            $controller->show_product($productID);
            break;

        case 'filter_products':
            $search = filter_input(INPUT_POST, 'search');
            $controller = new ProductController();
            $controller->filter_products($search);
            break;
        
        case 'show_categories':
            $controller = new CategoryController();
            $controller->show_all_categories();
            break;

        case 'show_category_products':
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
            $controller = new CategoryController();
            $controller->show_category_products($categoryID);
            break;

        case 'show_add_category_form':
            $controller = new CategoryController();
            $controller->show_add_category_form();
            break;

        case 'add_category':
            $controller = new CategoryController();
            $controller->add_category();
            break;

        case 'show_edit_category_form':
            $controller = new CategoryController();
            $controller->show_edit_category_form();
            break;
            
        case 'edit_category':
            $controller = new CategoryController();
            $controller->edit_category();
            break;

        case 'delete_category':
            $controller = new CategoryController();
            $controller->delete_category();
            break;

        case 'show_register_form':
            $controller = new UserController();
            $controller->show_register_form();
            break;

        case 'register':
            $controller = new UserController();
            $controller->register();
            break;

        case 'show_login_form':
            $controller = new UserController();
            $controller->show_login_form();
            break;

        case 'login':
            $controller = new UserController();
            $controller->login();
            break;

        case 'logout':
            $controller = new UserController();
            $controller->logout();
            break;

        case 'profile':
            $controller = new UserController();
            $controller->show_profile();
            break;

        case 'show_cart':
            $controller = new CartController();
            $controller->show_cart();
            break;

        case 'add_to_cart':
            $controller = new CartController();
            $controller->add_product();
            break;

        case 'remove_from_cart':
            $controller = new CartController();
            $controller->delete_product();
            break;
        
        case 'update_quantity':
            $controller = new CartController();
            $controller->update_quantity();
            break;

        case 'clear_cart':
            $controller = new CartController();
            $controller->clear_cart();
            break;

        case 'checkout':
            $controller = new purchaseController();
            $controller->checkout();
            break;

        case 'remove_purchase':
            $purchaseID = filter_input(INPUT_POST, 'purchaseID', FILTER_VALIDATE_INT);
            $controller = new purchaseController();
            $controller->remove_purchase($purchaseID);
            break;

        case 'view_purchase':
            $purchaseID = filter_input(INPUT_POST, 'purchaseID', FILTER_VALIDATE_INT);
            $controller = new purchaseController();
            $controller->view_purchase($purchaseID);
            break;

        case 'view_user_purchases':
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);
            $controller = new purchaseController();
            $controller->view_user_purchases($userID);
            break;
        }
?>