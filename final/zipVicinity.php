<?php

    function getZipVicinity($zip){
        $url = "https://app.zipcodebase.com/api/v1/radius?apikey=dafe7f40-44a6-11f1-9a2e-67d09cfea1d7"
                . "&code=" . "$zip" . "&radius=30&country=us";

        
        // found on Stack Overflow, supposed to store the contents of the api as a string
        // in the variable
        $response = file_get_contents($url);
        
        // php documentation says that file_get_contents returns false on failure
        if($response === false){
            return [];
        }

        // converts the json string into an array
        $data = json_decode($response, true);

        // if there is no results data set within the vicinity, return an empty array
        if(!isset($data['results'])){
            return [];
        }

        // creates an array to hold nearby zips
        $nearby = [];

        // goes through every result object in the JSON and adds the zip
        // to the nearby array
        foreach($data['results'] as $item){
            $nearby[] = $item['code'];
        }

        return $nearby;
    }


    // checks if the zipcode already exists in the VICINITY table and returns a boolean
    // to prevent redundant api calls
    function checkZipExists($conn, $zip){
        $sql = "SELECT id FROM VICINITY WHERE zipcode = '$zip'";
        $result = $conn->query($sql);

        if(!$result){
            die("Zipcode check failed");
        }

        return ($result->num_rows > 0);
    }

    // goes through and inserts every zipcode in the nearby array into the VICINITY table.
    // One line per zip
    function insertZip($conn, $zip, $nearby){
        foreach($nearby as $entry){
            $sql = "INSERT INTO VICINITY (zipcode, nearby) VALUES ('$zip', '$entry')";

            if(!$conn->query($sql)){
                die("Failed to insert zips into VICINITY table");
            }
        }
    }



?>