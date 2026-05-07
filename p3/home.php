<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='styles.css'>
   
    <title>Home</title>
    <style type="text/css">

        /*Sets a background image for the hero and about us section*/
        #introWrap{
            background-image: url("images/about_bkgrd.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        #hero{
            display: block;
            color: #ffffff;
            justify-content: center;
            text-align: center;
            padding: 70px;
            min-height: 250px;
        }

        #hero h1{
            font-size: 95px;
            margin-bottom: 10px;
        }

        #hero p{
            font-size: 25px;
            padding-bottom: 40px;
        }

        #aboutUs{
            display: block;
            color: #ffffff;
            justify-content: center;
            text-align: center;
            font-size: 25px;
            margin: 0;
            padding: 70px;
            min-height: 250px;
        }

        #aboutUs h2, #whyChoose h2{
            font-size: 40px;
        }

        #aboutUs p, #whyChoose p{
            display: block;
            margin: 0 auto;
            width: 70%;
            padding-bottom: 40px;
        }

        #featuredProd{
            display: block;
            background-color: #0b6b02;
            color: #ffffff;
            justify-content: center;
            text-align: center;
            font-size: 25px;
            margin: 0;
            padding: 70px;
        }
        #featuredProd h2{
            font-size: 40px;
            margin-bottom: 50px;
        }

        /* Button styling for the featured products section*/
        #featuredProd a{
            display: block;
            width: fit-content;
            border: 1px solid #000000;
            padding: 10px;
            font-size: 25px;
            text-decoration: none;
            color: #000000;
            background-color: #dad6d6;
            margin: 25px auto 0;
        }

        /* Hover effect for featured products button */
        #featuredProd a:hover{
            color: #ffffff;
            background-color: #000000;
        }

        /* Displays the featured products adjacent to eachother */
        .featuredRow{
            display: flex;
            justify-content: center;
            gap: 40px;
            padding-bottom: 40px;
        }

        /* Product card styling and sizing*/
        .productCard{
            background-color: #ffffff;
            color: #ffffff;
            width: 280px;
            min-width: 240px;
            padding: 15px;
            text-align: center;
        }

        .productCard h3{
            margin: 30px 0;
            font-size: 24px;
            color: #000000;
        }

        /*Makes all featured product images the same size */
        .productImg{
            width: 100%;
            height: 275px;
            background-color: #ffffff;
        }

        .productImg img{
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        #whyChoose{
            display: block;
            background-image: url("images/whyChs.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            justify-content: center;
            text-align: center;
            font-size: 25px;
            margin: 0;
            padding: 70px;
            min-height: 250px;
        }

        
        @media(max-width: 600px){
            #aboutUs, #whyChoose{
                font-size: 20px;
            }
            #aboutUs h2, #whyChoose h2{
                font-size: 28px;
            }
        }

        /* Causes the featured product cards to stack vertically when the
           screen size is less than 900px*/
        @media(max-width: 900px){
            .featuredRow{
                flex-direction: column;
                align-items: center;
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

        <div id = "introWrap">
            <div id="hero">
                <h1>Fairway Flight Disc Golf</h1>
                <p>Your one-stop shop for discs, bags, baskets, and disc golf essentials.</p>
            </div>

            <div id="aboutUs">
                <h2>What We Sell</h2>
                <p>We aim to make it easy for players to find the disc golf gear they need 
                    all in one place. From discs, bags, baskets, and 
                    other accessories, our store is built to provide the essentials for 
                    every part of the game. Whether someone is just getting started or has 
                    been playing for years, we want to offer useful equipment for practice, 
                    casual rounds, and competitive play.</p>
            </div>
        </div>

        <div id="featuredProd">
            <h2>Featured Products</h2>
            <div class="featuredRow">

                <?php
                    $server = "localhost";
                    $userid = "uag2patbfpn0k";
                    $pw = "DBPASSWRD3";
                    $db = "dbyaob60wtfkrt";

                    $conn = new mysqli($server, $userid, $pw);

                    if($conn->connect_error){
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Connects to the database and sends a query to get the name and image url
                    // for all featured products
                    $conn->select_db($db);
                    $sql = "SELECT name,imgURL FROM ProductData where featured = 1";
                    $result = $conn->query($sql);

                    // Processes the result query string and gets the name and image for each featured product.
                    // Creates a product card div for each item
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $name = $row["name"];
                            $img = $row["imgURL"];

                            echo <<<EOT
                                <div class="productCard">
                                    <div class="productImg">
                                        <img src="$img" alt="$name">
                                    </div>
                                    <h3>$name</h3>
                                </div>
                            EOT;
                        }
                    } else{
                        echo "<p> No products found <p>";
                    }

                    $conn->close();
                ?>

            </div>

            <a href="products.php">Shop Products</a>

        </div>

        <div id="whyChoose">
            <h2>Why Choose Us</h2>
            <p>Shopping for disc golf gear online can be difficult when you cannot see 
               products in person, which is why we focus on giving clear product information 
               and a simple shopping experience. Our goal is to help customers shop with 
               confidence by making products easy to browse and by offering a reliable place 
               to find quality disc golf gear. By combining convenience, helpful details, and 
               a range of products for different types of players, we hope to make it easier for 
               people to enjoy and improve their game.</p>
        </div>

        <div id="footer">
            <h3>Fairway Flight Disc Golf</h3>
            <p>
                <a href="mailto:ffdiscgolf@gmail.com.com">ffdiscgolf@gmail.com</a> 
                <a href="tel:12125550147">(212) 555-0147</a>
            </p>
        </div>
    </div>
</body>