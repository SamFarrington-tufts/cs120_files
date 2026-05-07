<!doctype html>
<html>
<head>
<title>Test</title>
</head>

<body>
<?php
	$server = "localhost";
    $userid = "uag2patbfpn0k";
    $pw = "DBPASSWRD3";
    $db = "dbyaob60wtfkrt";

    $conn = new mysqli($server, $userid, $pw);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected Successfully";

    $conn->select_db($db);
    $sql = "SELECT * FROM ProductData";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<br>" . $row["name"] . "<br>";
            echo '<img src ="' . $row["imgURL"] . '">';
        }
    } else{
        echo "no results";
    }

    $conn->close();

?>

	
</body>
</html>