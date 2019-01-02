<!DOCTYPE html>
<html>
    <head>
            <?php include "Unirest.php" ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="Css/index.css" />
    </head>
    <body>
        <?php
            $name = $_GET['name'];
            
            $response = Unirest\Request::get("https://omgvamp-hearthstone-v1.p.mashape.com/cards/sets/" . rawurlencode($name) . "?collectible=1",
            array(
                "X-Mashape-Key" => "WIn8D1aVHgmshmfQKvu0TCf7oIXap1k7JoPjsnXogBBeLe8Q8X",
                "Accept" => "application/json"
            )
            );

            $cardObject = json_decode($response -> raw_body);

            echo "<br>";
            echo "<br>";

            var_dump($cardObject);

            // echo $cardObject[0] -> cost;

            echo "<br>";
            // echo $cardObject -> type;
            // echo "<br>";
            // echo $cardObject -> playerClass;

            // echo '<h1>' . $weatherObject -> name . '</h1>';
            // echo '<h2>' . $weatherObject -> cardObject . '</h2>';
            // echo '<h3>' . $weatherObject -> playerClass . '</h3>';
        ?>
    </body>
</html>

