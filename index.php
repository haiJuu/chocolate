<!doctype html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChoColate</title>
    <!-- Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=LXGW+WenKai+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="container-fluid fixed-top">
        <div id="logo" class="row">
            <div class="col-md-4 offset-md-4 text-center"><a href="./index.php">
                    Choose Chocolate
                </a>
            </div>
            <div class="col-md-2 offset-md-2 align-content-end text-center">
                <a href="#">
                    <i class="fas fa-regular fa-cart-shopping"></i>
                </a>
                <a href="#">
                    <i class="fas fa-regular fa-user"></i>
                </a>
            </div>
        </div>
        <div id="nav" class="row">
            <nav class="navbar navbar-expand-lg bg-light ">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">

                            <li class="nav-item ms-5 me-5 dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    品牌介紹
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">起源</a></li>
                                    <li><a class="dropdown-item" href="#">土庫驛可可莊園</a></li>
                                    <li><a class="dropdown-item" href="#">好田家</a></li>
                                    <li><a class="dropdown-item" href="#">福灣巧克力</a></li>
                                </ul>
                            </li>

                            <li class="nav-item ms-5 me-5 dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    商品分類
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="nav-item dropend"><a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">起源
                                    </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">牛奶巧克力</a></li>
                                        </ul>
                                    </li>

                                    <li><a class="dropdown-item" href="#">牛奶巧克力</a></li>

                                    <li><a class="dropdown-item" href="#">白巧克力</a></li>

                                    <li><a class="dropdown-item" href="#">紅寶石巧克力</a></li>

                                </ul>
                            </li>
                            <li class="nav-item ms-5 me-5">
                                <a class="nav-link" href="#">最新消息</a>
                            </li>
                            <li class="nav-item ms-5 me-5">
                                <a class="nav-link" href="#">關於我們</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section id="carousel">
        <div id="carouselExampleCaptions" class="carousel slide col-md-11 col-11" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/carousels/origintcc.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>一片巧克力
                            感受人生層次</h5>
                        <p>透過獨家專利的微米粉碎技術
                            將茶葉、咖啡甚至其他香料
                            與巧克力做到完美的結合</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carousels/tukuyicocoa.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carousels/goodfarms.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carousels/fuwanchocolate.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="cards">

        <div class="row">
            <div class="card text-bg-light col-md-5 col-sm-10 text-end">
                <img src="./images/brand/origintcc.jpg" class="card-img img-fluid" alt="">
                <div class="card-img-overlay ">

                    <p class="card-text">
                        ORIGIN，<br>帶你深入產地，<br>了解這些美好的風味從何而來，<br>我們相信當你親身體驗了這些職人以及土地的故事，<br>手中的那一抹滋味將截然不同。
                    </p>
                    <a href="#">
                        <button class="card-title">更多關於 ORIGIN</button>
                    </a>
                </div>

                <div class="incards">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                </div>
            </div>

            <div class="card text-bg-light col-md-5 col-sm-10 text-end">
                <img src="./images/brand/tukuyicocoa.jpg" class="card-img img-fluid" alt="">
                <div class="card-img-overlay ">
                    <p class="card-text">
                        土庫驛可可莊園，<br>承載了世界頂尖的人與技術，<br>致力於帶動地方小鎮重生的可能，<br>希望您用心感受這裡的美好。
                    </p>
                    <a href="#">
                        <button class="card-title">更多關於 土庫驛可可莊園</button>
                    </a>
                </div>
                <div class="incards">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card text-bg-light col-md-5 col-sm-10 text-end">
                <img src="./images/brand/goodfarms.jpg" class="card-img img-fluid" alt="">
                <div class="card-img-overlay ">
                    <p class="card-text">
                        好田家，<br>是以 "好" 跟 "田" 為出發，<br>好的田能生產出好的原料，<br>好的原料再經過好的加工，<br>則能成為好的食物。
                    </p>
                    <a href="#">
                        <button class="card-title">更多關於 好田家</button>
                    </a>
                </div>
                <div class="incards">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                </div>
            </div>
            <div class="card text-bg-light col-md-5 col-sm-10 text-end">
                <img src="./images/brand/fuwanchocolate.jpg" class="card-img img-fluid" alt="送禮諮詢">
                <div class="card-img-overlay ">
                    <p class="card-text">
                        福灣巧克力，<br>致力於以突破性的巧克力製作工藝，<br>帶給世界美妙的巧克力飲食文化體驗，<br>期望讓巧克力為每個靈魂帶來美好愉悅的生命時刻。
                    </p>
                    <a href="#">
                        <button class="card-title">更多關於 福灣巧克力</button>
                    </a>
                </div>
                <div class="incards">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." title="">
                    </div>
                </div>

            </div>
        </div>

    </section>

    <footer>
        <div class="row">
            <div class="col-md-4 col-sm-10 text-center">
                <div class="logo text-start align-content-center">
                    <a href="./index.php">Choose Chocolate</a>
                </div>
            </div>
            <div id="contact" class="col-md-4 col-sm-10 text-center">
                <div>
                    <i class="fas fa-regular fa-phone"></i> 0900999000<br>
                    <i class="fas fa-regular fa-clock"></i> 星期一至日 10:00～18:00<br>
                    <i class="fa-solid fa-envelope"></i> chocolate@gmail.com.tw<br>
                    <i class="fa-solid fa-location-arrow"></i> 南投縣草屯鎮
                </div>
            </div>
            <div class="col-md-4 col-sm-10 text-center align-content-end pe-5">
                Copyright © 2024 Haijuu
            </div>
        </div>
    </footer>

    <!-- Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script src="./bootstrap-5.2.3-dist/js/bootstrap.bundle.js"></script> -->
</body>

</html>