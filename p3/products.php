<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='styles.css'>
   
    <title>Products</title>
    <style type="text/css">

        #productsPage{
            padding: 40px 20px;
            background-color: #0b6b02;
            text-align: center;
        }

        #productsPage h1{
            font-size: 60px;
            margin-bottom: 80px;
            color: #ffffff;
        }

        .productsGrid{
            display: grid;
            grid-template-columns: repeat(3, 280px);
            gap: 50px;
            padding-bottom: 40px;
            justify-content: center;
        }

        /*Creates a white background to create a product card to hold
          the product information */
        .productCard{
            background-color: #ffffff;
            color: #000000;
            padding: 15px;
            text-align: center;
        }

        .productCard h3{
            margin: 20px 0;
            font-size: 24px;
            color: #000000;
        }

        .productCard p{
            margin: 10px 0 20px;
            font-size: 20px;
            color: #000000;
        }

        /*Style rules to make sure all the product images are the same size */
        .productImg{
            width: 100%;
            height: 275px;
            background-color: #ffffff;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .productImg img{
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        /*Makes the product buttons adjacent to eachother */
        .productBtns{
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .productBtns button{
            font-size: 16px;
            padding: 10px 15px;
            margin: 15px 0;
            background-color: #dad6d6;
            border: 1px solid #000000;
        }

        /*Hover effect for product buttons */
        .productBtns button:hover{
            background-color: #000000;
            color: #ffffff;
        }

        @media(max-width: 1000px){
            .productsGrid{
                display: grid;
                grid-template-columns: repeat(2, 280px);
                gap: 30px;
                padding-bottom: 40px;
                justify-content: center;
            }
        }

        @media(max-width: 625px){
            .productsGrid{
                display: grid;
                grid-template-columns: repeat(1, 280px);
                gap: 30px;
                padding-bottom: 40px;
                justify-content: center;
            }
        }

        /*sets the desc default to none to make sure no product
          descriptions are shown when the page loads */
        .productDesc{
            display: none;
            margin-top: 15px;
            font-size: 16px;
            text-align: left;
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

        <div id="productsPage">
            <h1>Products</h1>

            <div class="productsGrid">
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
                    $sql = "SELECT * FROM ProductData";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $name = $row["name"];
                            $price = $row["price"];
                            $img = $row["imgURL"];
                            $id = $row["id"];
                            $desc = $row["description"];

                            // for every product in ProductData, creates a productCard div containing
                            // the product image, name, price, two buttons, and descriptions 
                            echo <<<EOT
                                <div class="productCard" id="productCard_$id">
                                    <div class="productImg">
                                        <img src="$img" alt="$name">
                                    </div>
                                    <h3>$name</h3>
                                    <p>\$$price</p>

                                    <div class="productBtns">
                                        <button class="addToCart" id="$id">Add To Cart</button>
                                        <button class="moreInfo" id="$id">More</button>
                                    </div>

                                    <div class="productDesc" id="productDesc_$id">
                                        $desc
                                    </div>
                                </div>
                            EOT;
                        }
                    } else{
                        echo "<p> No products found <p>";
                    }

                    $conn->close();
                ?>
            </div>
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

        // event listener for the more info functionality. when clicked, the event listener assesses
        // if the product description is visible or not and makes the appropriate style change
        const moreBtn = document.querySelectorAll(".moreInfo");
        moreBtn.forEach(function(button){
            button.addEventListener("click", function(){
                let id = this.id;
                let desc = document.getElementById("productDesc_" + id);

                /* Style rule that assesses if the desc block is open. Depending on the state
                of the desc block, it will show or hide the desc while also changing the text
                of the button*/
                if(desc.style.display === "block"){
                    desc.style.display = "none";
                    this.textContent = "More";
                } else{
                    desc.style.display = "block";
                    this.textContent = "Less";
                }
            })
        })

        // event listener that creates a cart and utilizes local storage to make sure
        // the data persist while the user is using the site. Additonally, the event listener
        // increments or adds a new item to the cart when the add to cart button is pushed
        const cartBtn = document.querySelectorAll(".addToCart");
        cartBtn.forEach(function(button){
            button.addEventListener("click", function(){
                let id = this.id;
                let productItem = document.getElementById("productCard_" + id);
                let name = productItem.querySelector("h3").textContent;
                let price = parseFloat(productItem.querySelector("p").textContent.replace("$", ""));

                //Checks if a cart already exist, if not it creates an empty cart/array
                let cart = localStorage.getItem("cart");
                if(cart){
                    cart = JSON.parse(cart);
                } else {
                    cart = [];
                }

                // Gets the id of the item associated with the particular add to cart button
                // from the cart
                let curItem = cart.find(function(item){
                    return item.id === id;
                })

                // Checks if the item exist in the cart and increments quantity, if not
                // creates an object for the item and pushes it to the cart array
                if(curItem){
                    curItem.quantity += 1;
                    // TEST console.log(name + " quantity increased to " + curItem.quantity);
                } else{
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1
                    });
                    // TEST console.log(name + " added to cart");
                }

                localStorage.setItem("cart", JSON.stringify(cart));

            })
        })
        
    </script>

</body>