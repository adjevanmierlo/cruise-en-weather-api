<?php
$urlCurrent = "http://api.openweathermap.org/data/2.5/weather?id=7267904&APPID=fd49c0873f64dd64ec341e1d58aa2bbe&units=metric";
$urlUpcomming = "https://api.openweathermap.org/data/2.5/forecast?id=4795467&appid=fd49c0873f64dd64ec341e1d58aa2bbe&units=metric";

$jsonCurrent = file_get_contents($urlCurrent);  //api voor 1 dag
$jsonUpcomming = file_get_contents($urlUpcomming);  // api 5 days forcast

$weatherObject = json_decode($jsonCurrent);  // hier maak ik een object aan om de gegevens uit json te halen
$dayObjects = json_decode($jsonUpcomming); // 5 dagen forcast

$temp = (int)$weatherObject -> main -> temp; // int is om een heel getaal te maken 
$id =$weatherObject ->weather[0]->icon.".png";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/weer.css ">
    <link href="https://fonts.googleapis.com/css?family=Cabin|Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="card">
       
        <h2><?php echo $weatherObject -> name; ?></h2>
       
        <h3>Wind <?php echo $weatherObject -> wind -> speed. "km/h";?>  <span class="dot"></span><?php echo "luchtvochtigheid " . $weatherObject -> main -> humidity . "%"; ?></span></h3>
        <h1><?php echo $temp . " &#8451;"; ?></h1>

        <div class="sky">
        <?php
            echo "<img src='http://openweathermap.org/img/w/" . $id ."'/ >";
        ?>
            <!-- <div class="sun"></div>
            <div class="cloud">
                <div class="circle-small"></div>
                <div class="circle-tall"></div>
                <div class="circle-medium"></div>
            </div> -->
        </div>
        <table>
            <tr>
         <?php   for($j = 0; $j < 40; $j+=8){ //  3x8 is 24 uur en 8x5 is 40 dus totaal moet het 40 zijn
        $datumVanDag = new DateTime ($dayObjects -> list[$j] -> dt_txt); // dt_txt is in unix formaat door new datetime zet je dit om darum + tijd
        $createDag = $datumVanDag->format('Y-m-d'); 
        $datetime = DateTime::createFromFormat('Y-m-d', $createDag);
        echo  "<td>"  . $datetime->format('D') . "</td>";
        }  
        ?>
                <!-- loop hier -->
            </tr>
            <tr>
               <?php for($j = 0; $j < 40; $j+=8){
        $tempDagen = (int)$dayObjects -> list[$j] -> main -> temp;    
          echo "<td>"  . $tempDagen . " " . "</td>"; 
        }  ?>
                <!-- loop -->
            </tr>
            <!-- <tr>
                <td>17°</td>
                <td>22°</td>
                <td>19°</td>
                <td>23°</td>
                <td>19°</td>
            </tr> -->
        </table>
    </div>
</body>
</html>
