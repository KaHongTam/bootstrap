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
                        aria-haspopup="true" aria-expanded="false">Set</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="set.php?set=Rastakhan's Rumble&page=1">Rastakhan's Rumble</a>
                        <a class="dropdown-item" href="set.php?set=The Boomsday Project&page=1">The Boomsday Project</a>
                        <a class="dropdown-item" href="set.php?set=The Witchwood&page=1">The Witchwood</a>
                        <a class="dropdown-item" href="set.php?set=Kobolds %26 Catacombs&page=1">Kobolds & Catacombs</a>
                        <a class="dropdown-item" href="set.php?set=Knights of the Frozen Throne&page=1">Knights of the Frozen Throne</a>
                        <a class="dropdown-item" href="set.php?set=Journey to Un'Goro&page=1">Journey to Un'Goro</a>
                        <a class="dropdown-item" href="set.php?set=Hall of Fame&page=1">Hall of Fame</a>
                        <a class="dropdown-item" href="set.php?set=Classic&page=1">Classic</a>
                        <a class="dropdown-item" href="set.php?set=Basic&page=1">Basic</a>
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
                <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <?php
                            include "Unirest.php";

                            // These code snippets use an open-source library. http://unirest.io/php
                            $set = $_GET['set'];
                            $pageIndex = $_GET['page'];
                            $response = Unirest\Request::get('https://omgvamp-hearthstone-v1.p.mashape.com/cards/sets/' . rawurlencode($set) . '?collectible=1',
                            array(
                                "X-Mashape-Key" => "WIn8D1aVHgmshmfQKvu0TCf7oIXap1k7JoPjsnXogBBeLe8Q8X"
                            )
                            );
                            $cardObject = json_decode($response -> raw_body); 
                            echo '<h1>All ' . count($cardObject) . ' cards of ' . $set . '</h1>';
                            if ($pageIndex == 1) {
                                $startIndex = 0;
                                $size = 50;
                            }
                            else if ($pageIndex == 2) {
                                $startIndex = 50;
                                $size = 100;
                            }
                            else if ($pageIndex == 3) {
                                $startIndex = 100;
                                $size = 135;
                            }
                            // Dit is de loop om de name van alle kaarten te zien
                            for($i = $startIndex; $i < $size; ++$i) {
                                echo $i . '<a href=card.php?name=' . rawurlencode($cardObject[$i] -> name) . '>' . $cardObject[$i] -> name . '</a><br>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <?php
                                echo '<li class="page-item"><a class="page-link active" href="set.php?set=' . rawurlencode($set) . '&page=1">1-50</a></li>';
                                echo '<li class="page-item"><a class="page-link active" href="set.php?set=' . rawurlencode($set) . '&page=2">51-100</a></li>';
                                echo '<li class="page-item"><a class="page-link active" href="set.php?set=' . rawurlencode($set) . '&page=3">100-135</a></li>';
                            ?>
                        </ul>
                    </nav>
                </div>
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