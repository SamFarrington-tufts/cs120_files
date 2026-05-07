<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='styles.css'>
   
    <title>Orders</title>
    <style type="text/css">
        #wrap{
            background-color: #0b6b02;
        }

        h1{
            text-align: center;
            padding: 20px;
            margin: 15px;
            font-size: 50px;
            color: #ffffff;
        }

        /*Creates a white block that contrast with the background to display the
          order information. outlines each order block with a 2px solid black border*/
        .orderBlock{
            background-color: #ffffff;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #000000;
        }

        .orderBlock h2{
            margin: 0;
            font-size: 28px;
        }

        .orderTotal{
            margin: 10px 0;
            font-size: 24px;
        }

        /* Creates a 1px solid black border for each item in the order to create
           a distinction between items in an order block*/
        .orderItems{
            border: 1px solid #000000;
            padding: 10px;
        }

        /* Displays the information pertaining to an item adjacent to eachother */
        .orderItem{
            display: flex;
            gap: 25px;
            align-items: center;
            padding: 10px;
        }

        .orderItem p{
            margin: 0;
            font-size: 18px;
        }

        .itemQ{
            width: 100px;
            text-align: right;
            margin: 0 10px;
        }

        .itemTotal{
            width: 200px;
            text-align: left;
        }

        .itemName{
            width: 380px;
            text-align: left;
        }

        @media(max-width: 850px){
            h1{
            font-size: 36px;
            }

            .orderBlock{
                padding: 15px;
                max-width: 90%;
            }

            .orderBlock h2{
                font-size: 20px;
            }

            .orderTotal{
                font-size: 16px;
            }

            .orderItem{
                display: flex;
                gap: 15px;
                padding: 8px;
            }

            .orderItem p{
                font-size: 15px;
            }

            .itemQ{
                width: auto;
            }

            .itemTotal{
                width: auto;
            }

            .itemName{
                width: auto;
            }
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

        <h1>Orders</h1>


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

            // Creates a sql that gets orderID, order date, quantity, name, and price from orders where
            // the itemId from orders and id from ProductData match. Orders them in descending order
            // so the most recent order appears on top of the page
            $sql = "SELECT orders.orderID, orders.orderDate, orders.quantity, ProductData.name, ProductData.price
                    FROM orders JOIN ProductData on orders.itemID = ProductData.id
                    ORDER BY orders.orderID DESC";

            $result = $conn->query($sql);

            // Variables to hold the current order id, total, item total,
            // date, and the html for all the items in a single order
            $curOrderID = null;
            $orderTotal = 0;
            $itemTotal = 0;
            $orderDate = "";
            $orderItemsHtml = "";

            if($result-> num_rows > 0){
                while($row = $result -> fetch_assoc()){

                    // A new order is reached if the curOrderId is not equal to the 
                    // orderId of the current row in the table, prints the order block
                    // of the curOrderId before moving on to the next order
                    if($curOrderID !== null && $curOrderID != $row["orderID"]){
                         echo <<<EOT
                                <div class="orderBlock">
                                    <h2>Order ID: $curOrderID</h2>
                                    <p><strong>Order Date:</strong> $orderDate</p>
                                    <p><strong>Order Total</strong>: \$$orderTotal</p>
                                    <div class="orderItems">$orderItemsHtml</div>
                                </div>
                            EOT;

                            // Clears the order total and variable holding all the item
                            // html info
                            $orderTotal = 0;
                            $orderItemsHtml = "";
                    }

                    // updates the curOrderID and order date when reaching a new order
                    if($curOrderID != $row["orderID"]){
                        $curOrderID = $row["orderID"];
                        $orderDate = $row["orderDate"];
                    }

                    // Gets the name and quantity of the current item, calculates the item total,
                    // and adds the item total to the cart total
                    $itemTotal = $row["price"] * $row["quantity"];
                    $orderTotal += $itemTotal;
                    $name = $row["name"];
                    $quantity = $row["quantity"];

                    // Appends an orderItem div to the variable holding the item info for a single
                    // order. The div contains the item's name, quantity, and item total
                    $orderItemsHtml .= "
                        <div class = 'orderItem'>
                            <p class ='itemName'><strong>$name</strong></p>
                            <p class= 'itemQ'><strong>Quantity:</strong> $quantity</p>
                            <p class = 'itemTotal'><strong>Item Total: </strong>$" . number_format($itemTotal,2) . "</p>
                        </div>
                    ";
                }
            }

            // Extra print statement becuase the first if statement in the loop above only
            // prints an order when the orderID changes. This prevents the first order from
            // being printed without this if statement
            if($curOrderID !== null){
                echo <<<EOT
                    <div class="orderBlock">
                        <h2>Order ID: $curOrderID</h2>
                        <p>Order Date: $orderDate</p>
                        <p><strong>Order Total</strong>: \$$orderTotal</p>
                        <div class="orderItems">$orderItemsHtml</div>
                    </div>
                EOT;
            }

            $conn->close();
        ?>



        <div id="footer">
            <h3>Fairway Flight Disc Golf</h3>
            <p>
                <a href="mailto:onecityblock@gmail.com">ffdiscgolf@gmail.com</a> 
                <a href="tel:12125550147">(212) 555-0147</a>
            </p>
        </div>
    </div>
</body>