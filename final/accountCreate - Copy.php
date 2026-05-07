
<!doctype html>
<html>
<head>

    <meta charset="utf-8">
   
    <title>Create An Account</title>
    <style type="text/css">
        body{
            background-color: #2013cf;
            justify-content: center;
        }

        h1{
            color: #ffffff;
            text-align: center;
        }

        #userForm{
            display: block;
            background-color: #ffffff;
            width: fit-content;
            justify-content: center;
            margin: 0 auto;
            font-size: 18px;
        }

        #user_info{
            display: block;
            justify-content: center;
            text-align: center;
            width: fit-content;
            align-items: center;
            padding: 30px;
        }

        #userForm label, #userForm input{
            display: inline-block;
            font-size: 18px;
            margin: 0 5px;
        }

        .formElement{
            display: block;
            text-align: right;
            padding: 10px;
            margin: 10px;
        }

        .formElement label{
            text-align: right;
            width: 120px;
        }

        .formElement input,
        .formElement select{
            width: 200px;
            padding: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .formBtn button{
            display: block;
            margin: 15px auto;
            font-size: 18px;
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #000000;
        }

        .formBtn button:hover{
            color: #ffffff;
            background-color: #000000;
        }

        #user_card{
            display: none;
            justify-content: center;
            text-align: center;
            width: fit-content;
            align-items: center;
            padding: 30px;
        }


    </style>
</head>


<body>

    <?php
        include 'header.php';
        include 'sqlconnect.php';

        $sql = "SELECT id,name FROM UNIVERSITIES ";
        $results = $conn->query($sql);
        
        if(!$results){
            die("Failed to load universities from UNIVERSITIES");
        }

    ?>

    <div id="wrap">
        <h1>Create An Account</h1>

        <form id="userForm" method="POST" action="insertUserInfo.php">
            <div id="user_info">
                <div class="formElement"> 
                    <label for="first_name">First Name:</label>
                    <input type="text" name='first_name' id='first_name'> 
                </div>

                <div class="formElement">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name='last_name' id='last_name'> 
                </div>

                <div class="formElement">
                    <label for="user_email">Email:</label>
                    <input type="email" name='user_email' id='user_email'>
                </div>

                <div class="formElement">
                    <label for="user_pass">Password:</label>
                    <input type="text" name='user_pass' id='user_pass' maxlength='15'>
                </div>

                <div class="formElement">
                    <label for="user_phone">Phone:</label>
                    <input type="tel" name='user_phone' id='user_phone' placeholder="XXX-XXX-XXXX">
                </div>

                <div class="formElement">
                    <label for="user_state">State:</label>
                    <input type="text" name='user_state' id='user_state'>
                </div>

                <div class="formElement">
                    <label for="user_city">City:</label>
                    <input type="text" name='user_city' id='user_city'>
                </div>

                <div class="formElement">
                    <label for="user_zip">Zip:</label>
                    <input type="text" name='user_zip' id='user_zip' maxlength='5'>
                </div> 

                <div class="formElement">
                    <label for="user_uni">University:</label>
                    <select name = 'uni_id' id = 'uni_id'>
                        <option value="">Select University</option>
                        <?php
                            if($results->num_rows > 0){
                                while($row = $results->fetch_assoc()){
                                    echo "<option value ='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                            }
                        ?>
                    </select>

                </div>

                <div class="formNext">
                    <input type="button" id="nextButton" value="Next">
                </div> 
            </div>

            <div id="user_card">
                <div class="formElement"> 
                    <label for="user_cardNum">Credit Card:</label>
                    <input type="text" name='user_cardNum' id='user_cardNum' maxlength='16'> 
                </div>

                <div class="formElement">
                    <label for="card_exp">Expiration Date:</label>
                    <input type="text" name='card_exp' id='card_exp' placeholder='XX/XX'> 
                </div>

                <div class="formElement">
                    <label for="card_ccv">CCV:</label>
                    <input type="text" name='card_ccv' id='card_ccv' maxlength='3'>
                </div>

                <div class="formSubmit">
                    <input type="submit" id="formSubmitBtn" value="Create Account">
                </div> 
            </div>
        </form>

    </div>


    <script>
        document.getElementById("nextButton").addEventListener("click", function(){

            const email = document.getElementById("user_email").value;

            if(!email.endsWith(".edu")){
                alert("Only academic emails are allowed");
                return;
            }

            document.getElementById("user_info").style.display = "none";
            document.getElementById("user_card").style.display = "block";
        });
    </script>

    <?php
        include 'footer.php'
    ?>

</body>

