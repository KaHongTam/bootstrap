<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.html"><img src="img/Hearthstone_logo1.png" height="65"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="nav-link" href="index.html">Articles</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Set</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="set.php?set=Rastakhan's Rumble">Rastakhan's Rumble</a>
                                <a class="dropdown-item" href="set.php?set=The Boomsday Project">The Boomsday Project</a>
                                <a class="dropdown-item" href="set.php?set=The Witchwood">The Witchwood</a>
                                <a class="dropdown-item" href="set.php?set=Kobolds %26 Catacombs">Kobolds & Catacombs</a>
                                <a class="dropdown-item" href="set.php?set=Knights of the Frozen Throne">Knights of the Frozen Throne</a>
                                <a class="dropdown-item" href="set.php?set=Journey to Un'Goro">Journey to Un'Goro</a>
                                <a class="dropdown-item" href="set.php?set=Hall of Fame">Hall of Fame</a>
                                <a class="dropdown-item" href="set.php?set=Classic">Classic</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Wild Sets</a>
                            </div>
                        </li>
                        <!-- <li>
                            <a class="nav-link" href="#">Meta Decks</a>
                        </li> -->
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="card.php" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search by card" aria-label="Search" name="name">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
    <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            include "Unirest.php";
                            $name = $_GET['name'];

                            $response = Unirest\Request::get("https://omgvamp-hearthstone-v1.p.mashape.com/cards/" . rawurlencode($name),
                            array(
                                "X-Mashape-Key" => "WIn8D1aVHgmshmfQKvu0TCf7oIXap1k7JoPjsnXogBBeLe8Q8X",
                                "Accept" => "application/json"
                            )
                            );

                            $cardObject = json_decode($response -> raw_body); 
                            // var_dump ($cardObject);
                            if (is_array($cardObject) == 0) {
                                echo '<h1 class="text-center">No results, please try again.</h1>';
                            }
                            else {
                                $cardRarity = $cardObject[0] -> rarity;
                                if ( $cardRarity == 'Legendary') {
                                    $cardCraft = 1600;
                                    $cardCraftGold = 3200;
                                    $cardDust = 400;
                                    $cardDustGold = 1600;
                                }
                                else if ($cardRarity == 'Epic') {
                                    $cardCraft = 400;
                                    $cardCraftGold = 1600;
                                    $cardDust = 100;
                                    $cardDustGold = 400;
                                }
                                else if ($cardRarity == 'Rare') {
                                    $cardCraft = 100;
                                    $cardCraftGold = 800;
                                    $cardDust = 20;
                                    $cardDustGold = 100;
                                }
                                else if ($cardRarity == 'Common') {
                                    $cardCraft = 40;
                                    $cardCraftGold = 400;
                                    $cardDust = 5;
                                    $cardDustGold = 50;
                                }
                                else {
                                    $cardCraft = "N/A";
                                    $cardCraftGold = "N/A";
                                    $cardDust = "N/A";
                                    $cardDustGold = "N/A";
                                }

                                echo '<h1 class="text-center">' . $cardObject[0] -> name . '</h1><br><div class="row"><div class="col-md-1"></div>
                                <div class="col-md-5 text-center"><img id="normal_card" src="' . $cardObject[0] -> img . '" class="img-fluid mx-auto normal_card">
                                <img id="golden_card" src="' . $cardObject[0] -> imgGold . '" class="img-fluid mx-auto golden_card">
                                <div class="btn-group btn-group-toggle d-block" data-toggle="buttons"><label class="btn btn-secondary btn-lg active" id="option1">
                                <input type="radio" name="options"  autocomplete="off" checked> Normal</label><label class="btn btn-secondary btn-lg" id="option2">
                                <input type="radio" name="options"  autocomplete="off"> Golden</label></div></div><div class="col-md-4"><br>
                                <p><b>Mana Cost:</b> ' . $cardObject[0] -> cost . '</p>';
                                if (isset($cardObject[0] -> attack)) {
                                    echo '<p><b>Attack:</b> ' . $cardObject[0] -> attack . '</p>';
                                }
                                else {
                                    echo '<p><b>Attack:</b> N/A (' . $cardObject[0] -> type . ')</p>';
                                }
                                if (isset($cardObject[0] -> health)) {
                                    echo '<p><b>Health:</b> ' . $cardObject[0] -> health . '</p>';
                                }
                                else {
                                    echo '<p><b>Health:</b> N/A (' . $cardObject[0] -> type . ')</p>';
                                }
                                echo '<p><b>Crafting Cost: </b><span class="normal_card">' . $cardCraft . '</span><span class="golden_card">' . $cardCraftGold . '</span></p>
                                <p><b>Arcane Dust gained: </b><span class="normal_card">' . $cardDust . '</span><span class="golden_card">' . $cardDustGold . '</span></p>
                                <p><b>Rarity:</b> ' . $cardObject[0] -> rarity . '</p><p><b>Class:</b> <span id="' . $cardObject[0] -> playerClass . 
                                '">' . $cardObject[0] -> playerClass . '</span></p><p><b>Type:</b> ' . $cardObject[0] -> type . '</p><p><b>Set:</b> '
                                . $cardObject[0] -> cardSet . '</p>';
                                if (isset($cardObject[0] -> text)) {
                                    echo '<p><b>Text:</b> ' . $cardObject[0] -> text . '</p>';
                                }
                                else {
                                    echo "<p><b>Text</b>: N/A</p>";
                                }
                                echo '<p><b>Quotes:</b> ' . $cardObject[0] -> flavor . '</p><p><b>Artist:</b> ' . $cardObject[0] -> artist
                                . '</p></div><div class="col-md-1"></div></div></div> ';
                            };
                        ?>
                    </div> <!-- col-lg-12 -->
                </div>
            </div>
        </div>
    <footer class="footer">
        <img src="img/social_email.png" height="30px">
        <img src="img/social_facebook3.png" height="30px">
        <img src="img/social_twitter.png" height="30px">
    </footer>
</body>
<script src="index.js"></script>
</html>