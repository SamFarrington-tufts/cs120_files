<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='styles.css'>
   
    <title>Cart</title>
    <style type="text/css">
        body{
            background-color: #0b6b02;
            justify-content: center;
        }

        /*Creates a white block for the cart information to be displayed,
          adds constrast to the background color */
        #cartPage{
            background-color: #ffffff;
            display: block;
            padding: 40px 20px;
            margin: 20px auto;
        }

        #cartPage h1{
            color: #000000;
            text-align: center;
            font-size: 50px;
            margin: 30px;
        }

        /* Sets the width of each individual cart item*/
        #cartItems{
            max-width: 800px;
            margin: 0 auto;
        }

        /*Causes all the items in an invidual cart item to be displayed adjacent to eachother*/
        .cartItem{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
            margin: 15px;
            border: 1px solid #000000;
        }

        .cartItem h3, .cartItem p{
            margin: 0;
            font-size: 18px;
            min-width: 140px;
            text-align: left;
        }

        .cartItem button{
            font-size: 16px;
            padding: 10px 15px;
            margin: 15px 0;
            background-color: #dad6d6;
            border: 1px solid #000000;
        }

        /* Adds hover effect to button*/
        .cartItem button:hover{
            background-color: #000000;
            color: #ffffff;
        }

        #cartTotal{
            text-align: center;
            font-size: 32px;
            margin: 30px;
        }

        /*Positions cart buttons next to each other*/
        #cartBtns{
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        #cartBtns a, #cartBtns button{
            display: flex;
            font-size: 24px;
            padding: 10px 15px;
            margin: 15px 0;
            background-color: #dad6d6;
            border: 1px solid #000000;
            text-decoration: none;
            color: #000000;
        }
        
        /*Hover effect for cart buttons */
        #cartBtns a:hover, #cartBtns button:hover{
            background-color: #000000;
            color: #ffffff;
        }

        /*Centers the empty cart message */
        .emptyCart{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 30px;
            margin-bottom: 30px;
        }
        
        @media(max-width: 900px){
           #cartPage{
            padding: 20px 10px;
            }

            #cartPage h1{
                font-size: 35px;
                margin: 20px;
            }

            .cartItem{
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                padding: 15px;
                margin: 10px 0;
            }

            .cartItem h3, .cartItem p{
                margin: 0;
                font-size: 14px;
                min-width: 0;
                text-align: left;
            }

            .cartItem button{
                font-size: 14px;
                padding: 8px 12px;
                margin: 10px 0;
            }

            #cartTotal{
                font-size: 24px;
                margin: 15px;
            }

            #cartBtns{
                gap: 10px;
                margin-bottom: 15px;
            }

            #cartBtns a, #cartBtns button{
                font-size: 16px;
                padding: 8px 12px;
                margin: 10px 0;
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

        <div id="cartPage">
            <h1>Your Cart</h1>
            <div id="cartItems"></div>
            <div id="cartTotal">Cart Total: $0.00</div>
            <div id="cartBtns">
                <a href="products.php">Continue Shopping</a>
                <button id="checkoutBtn">Check Out</button>
            </div>

            <!--Hidden form to pass the cart data to the thank you page-->
            <form method="post" action="thankYou.php" id="checkoutForm" style="display: none;">
                <input type="hidden" name="cartData" id="cartData">
            </form>

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
        //Checks if a cart already exist, if not it creates an empty cart/array
        let cart = localStorage.getItem("cart");
        if(cart){
            cart = JSON.parse(cart);
        } else {
            cart = [];
        }

        let cartItemsInfo = document.getElementById("cartItems");
        let cartTotal = document.getElementById("cartTotal");

        function printCart(){
            cartItemsInfo.innerHTML = "";

            //initalizes total to 0 for cart total calculations
            let total = 0;

            // If the cart is empty, display a empty message and total of $0.00
            if(cart.length === 0){
                cartItemsInfo.innerHTML = "<p class = 'emptyCart'>Your cart is empty.</p>";
                cartTotal.innerHTML = "Cart Total: $0.00";
                return;
            }

            // Goes through each item in the cart and creates a cartItem, containing the name, price,
            // quantity, and item total. also includes a remove button
            cart.forEach(function(item){

                //Calculates the item total and adds it to the cart total 
                let itemTotal = item.price * item.quantity;
                total += itemTotal;

                cartItemsInfo.innerHTML += `
                    <div class = "cartItem">
                        <h3>${item.name}</h3>
                        <p>Price: $${item.price.toFixed(2)}</p>
                        <p>Quantity: ${item.quantity}</p>
                        <p>Item Total: $${itemTotal.toFixed(2)}</p>
                        <button onclick="removeItem('${item.id}')">Remove</button>
                    </div>
                `;
            });

            cartTotal.innerHTML = "Cart Total: $" + total.toFixed(2);
        }

        function removeItem(id){
            let curItem = cart.find(function(item){
                    return item.id === id;
                })

                // Checks if the item exist in the cart and removes it, if not
                // it does nothing (shouldnt be a remove button for an item that DNE)
                if(curItem){
                    let index = cart.indexOf(curItem);
                    cart.splice(index, 1);
                }

                localStorage.setItem("cart", JSON.stringify(cart));
                printCart();
        }

        // Event listener for the checkout button that converts the cart info to a json string
        // and stores it within the hidden form, which is then submitted to thankyou.php
        document.getElementById("checkoutBtn").addEventListener("click", function(){
            if(cart.length === 0){
                alert("You cannot check out with an empty cart");
                return;
            }

            document.getElementById("cartData").value = JSON.stringify(cart);
            document.getElementById("checkoutForm").submit();
        });

        printCart();
    </script>
</body>