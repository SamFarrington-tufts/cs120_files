<?php

    include 'sqlconnect.php';
    include 'zipVicinity.php';

    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $phone = $_POST['user_phone'];
    $state = $_POST['user_state'];
    $city = $_POST['user_city'];
    $zip = $_POST['user_zip'];
    $cardNum = $_POST['user_cardNum'];
    $cardExp = $_POST['card_exp'];
    $cardCCV = $_POST['card_ccv'];
    $uniID = $_POST['uni_id'];

    // makes sure all fields of the form are completed
    if($first === '' || $last === '' || $email === '' || $pass === '' || 
       $phone === '' || $state === '' || $city === '' || $zip === '' || 
       $cardNum === '' || $cardExp === '' || $cardCCV === '' || $uniID === ''){
        echo "<script>
            alert('One of the required fields is empty');
            window.location.href = 'accountCreate.php';
            </script>";
        die();
    }

    // checks to make sure an account with the same email or card number
    //doesnt already exist
    $checkEmail_sql = "SELECT id FROM USERS WHERE email = '$email'";
    $checkCard_sql = "SELECT id FROM CREDITCARD WHERE card_num = '$cardNum'";
    $checkEmail = $conn->query($checkEmail_sql);
    $checkCard = $conn->query($checkCard_sql);

    if($checkEmail->num_rows > 0){
        echo "<script>
            alert('Email already exists with another account');
            window.location.href = 'accountCreate.php';
            </script>";
        die();
    }

    if($checkCard->num_rows > 0){
        echo "<script>
            alert('Credit card already exists with another account');
            window.location.href = 'accountCreate.php';
            </script>";
        die();
    }

    // determines if the user's zip exists in the vicinity table. If it doesnt exists,
    // does an api call to get and store all the zipcodes within the vicinity of the user's
    // zip
    if(!checkZipExists($conn, $zip)){
        $nearby = getZipVicinity($zip);
        insertZip($conn, $zip, $nearby);
    }


    $sql = "INSERT into USERS (first_name, last_name, email, password, phone, state, city, zip, uni_id)
            VALUES('$first','$last','$email','$pass','$phone','$state','$city','$zip', '$uniID')";

    //inserts user into into the USERS table
    if(!$conn->query($sql)){
        die("User insert failed");
    }

    //gets the id of the last user inserted
    $userID = $conn -> insert_id;


    $card_sql = "INSERT into CREDITCARD (user_id, card_num, exp_date, CCV)
            VALUES('$userID','$cardNum','$cardExp','$cardCCV')";
    
    //inserts card into into the CREDITCARD table
    if(!$conn->query($card_sql)){
        die("Card info insert failed");
    }

    echo "<script>
            window.location.href = 'index.php';
          </script>";

?>