<!doctype html>
<html>
<head>
<title>Office Hours</title>
</head>
<style>
    body{
        font-size: 20px;
    }

    /*Outlines the schedule and centers it*/
    #schedule{
        display: block;
        text-align: center;
        border: 1px solid #000000;
        padding: 20px;
        width: fit-content;  
        margin: 0 auto;
    }

    /*Puts items inside adjacent to each other and adds a gap*/
    .singleDay{
        display: flex;
        gap: 20px;
        margin: 10px 0;
    }

    .dayInfo{
        width: 200px;
    }

    .dayHours{
        width: 200px;
        text-align: left;
    }



</style>

<body>
    <?php
        // Assoc array with days as keys and hours as values
        $officeHours = array(
            "Monday" => "9am - 4pm",
            "Tuesday" => "9am - 4pm",
            "Wednesday" => "9am - 4pm",
            "Thursday" => "9am - 4pm",
            "Friday" => "9am - 4pm",
            "Saturday" => "None",
            "Sunday" => "None",
        );

        // Loops through every item in the array and creates a div for each day and
        // its associated hours. Returns a string containing all the days and their hours
        function printHours($hours){
            $output = "<div id = 'schedule'>";
            foreach($hours as $day => $time){
                $output .= "<div class = 'singleDay'>";
                $output .= "<div class = 'dayInfo'>$day</div>";
                $output .= "<div class = 'dayHours'>$time</div>";
                $output .= "</div>";
            }
            $output .= "</div>";
            return $output;
        }

        echo printHours($officeHours);
    ?>
	
</body>
</html>