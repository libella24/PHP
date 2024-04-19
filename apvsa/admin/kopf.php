<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobbörse</title>
    <link rel="stylesheet" href="css/base.css" />
</head>
<body>
<div class="wrapper">
            <header id="main-header">
                <div class="row h-space inner-wrapper">
                    <div id="logo">
                        <a href="index.php">
                            <img
                                src="img/Logo-placeholder.png"
                                alt="Logo Bakery"
                            />
                        </a>
                    </div>

                    <nav>

                        <ul id="desktop-menu">
                            <li><a href="job_liste.php">Jobliste</a></li>               
                            <li><a href="login.php">Firmen Login</a></li>
                            <li><a href="#">Job-Ticker</a></li>
                            <li><a href="#">Kontakt</a></li>
                            <li><a href="#">Impressum</a></li>
                        </ul>

                        <a href="#" id="burger">
                            <img src="img/nav.svg" alt="" />
                        </a>
                    </nav>
                </div>

                <div class="row">
                    <div id="hero">
                        <!-- Adaptive / Responsive Images -->
                        <picture>
                            <source
                                media="(min-width: 420px)"
                                srcset="
                                    img/content/pexels-hasan-berkant-12259559_w768.jpg
                                "
                            />
                            <source
                                media="(min-width: 1300px)"
                                srcset="
                                    img/content/pexels-hasan-berkant-12259559_w1920.jpg
                                "
                            />

                            <img
                                src="img/content/pexels-hasan-berkant-12259559_w200.jpg"
                                alt=""
                            />
                        </picture>
                    </div>
                </div>
    
</body>
</html>