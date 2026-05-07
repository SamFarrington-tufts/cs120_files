<?php
    $server = "localhost";
    $userid = "uag2patbfpn0k";
    $pw = "DBPASSWRD3";
    $db = "dbyaob60wtfkrt";

    $conn = new mysqli($server, $userid, $pw);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db($db);

    $cart = [];
    $total = 0;
    $orderDate = date("Y-m-d");
    $orderID = null;

    // Sees if the cart data from the cart page exists. If so, the json is decoded and
    // stored in a variable
    if(isset($_POST["cartData"])){
        $cart = json_decode($_POST["cartData"], true);
    }

    if(!empty($cart)){
        
        //Increments the orderID
        $sql = "INSERT INTO orderIdAssignment () VALUES ()";

        if(!$conn->query($sql)){
                die("Insert failed for order ID");
        }

        //Found on Stack Overflow, gets the id of the last record inserted
        $orderID = $conn->insert_id;

        // Loops through each item in the cart and creates an insert query to log
        // the item id, quantity, price, and order date for each item into the orders
        // database table. The total price is also calculated, which is used in the html
        // to display the total for the order
        foreach($cart as $item){
            $itemId = $item["id"];
            $quantity = $item["quantity"];
            $price = $item["price"];
            $total += $price * $quantity;

            $sql = "INSERT INTO orders (orderID,itemID, orderDate, quantity) 
                    VALUES ($orderID, $itemId, '$orderDate', $quantity)";

            if(!$conn->query($sql)){
                die("Insert failed into orders table");
            }
        }
    }

    $conn->close();
?>




<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='styles.css'>
   
    <title>Thank You</title>
    <style type="text/css">
        #wrap{
            background-color: #0b6b02;
        }

        /* Creates a white block to display the thank you message, cart total,
           and estimates shipping date for the order */
        #thankYouPage{
            display: block;
            background-color: #ffffff;
            max-width: 800px;
            padding: 40px 80px;
            align-items: center;
            text-align: center;
            margin: auto;
        }

        .thankYouBox h1{
            font-size: 50px;
            margin-bottom: 15px;
        }

        .thankYouBox p{
            font-size: 25px;
            margin-top: 0;
        }

        .orderInfo{
            font-size: 25px;
            text-align: left;
            margin: 40px auto;
        }

        #thankYouPage a{
            border: 1px solid #000000;
            padding: 10px;
            font-size: 25px;
            text-decoration: none;
            color: #000000;
            background-color: #dad6d6;
        }

        /* Hover effect for the continue shopping button */
        #thankYouPage a:hover{
            color: #ffffff;
            background-color: #000000;
        }


        
    </style>
</head>

<body>
    <div id="wrap">

        <div id = "nav">
            <ul>
                <li class = 'logo'><a href = 'home.php'><img src="images/logo.jpg" alt="ffdg"></a></li>
                <li><a href = 'products.php'>Products</a></li>
                <li><a href = 'cart.php'>Cart</a></li>
                <li><a href = 'orders.php'>Orders</a></li>
            </ul>
        </div>

        <div id="mobile_menu">
                <div class="hamburger_icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div id = "mobile_nav">
                    <ul>
                        <li><a href = 'home.php'>Home</a></li>
                        <li><a href = 'products.php'>Products</a></li>
                        <li><a href = 'cart.php'>Cart</a></li>
                        <li><a href = 'orders.php'>Orders</a></li>
                    </ul>
                </div>
        </div>

        <div id="thankYouPage">
            
            <div class="thankYouBox">
                <h1>Thank You for Your Order!</h1>
                <p>Your order has been placed successfully.</p>
            </div>

            <div class="orderInfo">
                <p><strong>Order Total: </strong> $<?= number_format($total, 2) ?></p>
                <p id="shipDate"></p>
            </div>

            <a href="products.php">Continue Shopping</a>

        </div>


        <div id="footer">
            <h3>Fairway Flight Disc Golf</h3>
            <p>
                <a href="mailto:onecityblock@gmail.com">ffdiscgolf@gmail.com</a> 
                <a href="tel:12125550147">(212) 555-0147</a>
            </p>
        </div>
    </div>

    <script>

        // Stores the current date in a variable and adds two days for the estimated shipping
        // date. Then gets the ship date and alters the innerHtml to display the appropriate message
        let date = new Date();
        let shippingDate = new Date(date);
        shippingDate.setDate(date.getDate() + 2);

        document.getElementById("shipDate").innerHTML = "<strong>Expected Shipping Date:</strong> " 
                                                        + shippingDate.toDateString();

        //clears the cart
        localStorage.removeItem("cart");
    </script>
</body>