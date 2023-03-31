<?php
require_once("./db/db.php");
$id_product = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/media.css">

    <link rel="stylesheet" href="./style/owl.carousel.min.css">
    <link rel="stylesheet" href="./style/owl.theme.default.min.css">

    <script src="./js/jquery.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <title>Главная</title>
</head>
<body>
    <header class="header">
        <div class="header-contact">
            <div class="hc-wrapper">
                <div class="hcw-left">
                    <a href="mailto: clean@house.com" class="hcwl-a hcwl-aleft"><i class="fa-solid fa-envelope"></i> <span>clean@house.com</span></a>
                    <a href="tel: +7 (999) 999-99-99" class="hcwl-a"><i class="fa-solid fa-phone"></i> <span>+7 (999) 999-99-99</span></a>
                </div>
                <div class="hcw-right">
                    <a href="#!" class="hcwr-left"><i class="fa-brands fa-telegram fa-xl"></i></a>
                    <a href="#!"><i class="fa-brands fa-whatsapp fa-xl"></i></a>
                </div>
            </div>
        </div>
        <nav class="menu">
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="./index.php">Чистый дом</a>
                </div>
                <ul class="menu-list">
                    <li class="menu-item"><a href="./catalog.php">Категории Товаров</a></li>
                    <li class="menu-item"><a href="./about.php">О компании</a></li>
                    <li class="menu-item"><a href="./contacts.php">Контакты</a></li>
                </ul>
                <?php 
                    if(!isset($_COOKIE["id"])) { ?>
                        <div class="login">
                            <a href="./login.php">Авторизация</a>
                        </div>
                    <?php } else { ?>
                        <div class="login">
                        <a href="./logout.php">Выйти</a>
                        </div>
                    <?php }
                ?>
            </div>
            <div class="mobile-logo">
                <div class="logo">
                    <a href="./index.php">Чистый дом</a>
                </div>
            </div>
            
            <div class="mobile-bar">
                <div class="mb-wrapper">
                    <span><img src="./img/svg/menu.svg"></span>
                </div>
            </div>
        </nav>
        
    </header>
    <main>
        <?php
            $select_cart = mysqli_query($link, "SELECT * FROM `product` WHERE `id` = '$id_product'");
            $select_cart = mysqli_fetch_assoc($select_cart);
        ?>
        <div class="cart-product">
            <div class="cp-wrapper">
                <div class="cpw-left">
                    <img src="<?php print("./" . $select_cart['imgpath']); ?>">
                </div>
                <div class="cpw-right">
                    <div class="cpwr-main">
                        <p class="cpwr-title"><?php echo $select_cart['title']; ?></p>
                        <?php 
                        if (($_COOKIE["idgroup"] ?? '') === ''); else {
                            if($_COOKIE["idgroup"] == 1) { ?>
                                <a href="./help/update-product.php?id=<?php echo $select_cart['id']; ?>"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
                                <a href="./help/delete-product.php?id=<?php echo $select_cart['id']; ?>"><i class="fa-solid fa-trash-can fa-2xl"></i></a>
                            <?php }
                        } ?>
                        
                    </div>
                    
                    <p class="cpwr-price"><?php echo $select_cart['price']; ?> ₽</p>
                    <p class="cpwr-description"><?php echo $select_cart['descrip']; ?></p>
                    <div class="cpwr-buy">
                        <a href="./buy.php?id=<?php echo $select_cart['id']; ?>">Купить</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bestsellers">
            <div class="bestsellers-wrapper">
                <p class="bw-title">новые товары</p>
                <div class="owl-carousel owl-theme owl-2" id="owl-2">
                    <?php
                        $select_product = mysqli_query($link, "SELECT * FROM `product` ORDER BY `id` DESC LIMIT 10");
                        $select_product = mysqli_fetch_all($select_product);

                        foreach($select_product as $sp) { ?>
                            <div class="bw-item">
                                <div class="bwi-wrapper">
                                    <div class="bwiw-img">
                                        <img src="<?php print("./" . $sp[5]); ?>">
                                    </div>
                                    <div class="bwiw-info">
                                        <p class="bwiwi-title"><?php echo $sp[2]; ?></p>
                                        <p class="bwiwi-price"><?php echo $sp[4]; ?> ₽</p>
                                        <a href="./cart-product.php?id=<?php echo $sp[0]; ?>" class="bwiwi-link">Купить в 1 клик</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="footer-wrapper">
                <div class="fw-first">
                    <a href="./index.php">MEIN MINER</a>
                    <p>© Mein Miner, 2022</p>
                </div>
                <div class="fw-second">
                    <div class="fws-title">
                        <p>Покупателям</p>
                    </div>
                    <div class="fws-about">
                        <a href="./catalog.php">Каталог Товаров</a>
                        <a href="./about.php">О компании</a>
                        <a href="./contacts.php">Контакты</a>
                    </div>
                </div>
                <div class="fw-third">
                    <div class="fwt-title">
                        <p>категории товаров</p>
                    </div>
                    <div class="fwt-category">
                        <?php
                            $select_category = mysqli_query($link, "SELECT * FROM `category` ORDER BY `id` DESC LIMIT 6");
                            $select_category = mysqli_fetch_all($select_category);

                            foreach($select_category as $scy) { ?>
                                <a href="./product.php?id=<?php echo $scy[0]; ?>"><?php echo $scy[1]; ?></a>
                            <?php }
                        ?>
                    </div>
                    
                </div>
                <div class="fw-fouth">
                    <div class="fwf-urls">
                        <a href="#!">Публичная оферта</a>
                        <a href="#!">Политика конфиденциальности</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="mobile-menu">
        <div class="mn-wrapper">
            <div class="mnw-top">
                <div class="logo">
                    <a href="./index.php">Чистый дом</a>
                </div>
                <div class="mobile-bar-close">
                    <div class="mb-wrapper">
                        <span><img src="./img/svg/menu.svg"></span>
                    </div>
                </div>
            </div>
            
            <nav class="mnw-links">
                <ul class="mnwl-link">
                    <li class="mnwll-point"><a href="./catalog.php">Категории Товаров</a></li>
                    <hr>
                    <li class="mnwll-point"><a href="./about.php">О компании</a></li>
                    <hr>
                    <li class="mnwll-point"><a href="./contacts.php">Контакты</a></li>
                    <hr>
                </ul>
            </nav>
            <div class="mnw-contact">
                <a href="mailto: clean@house.com"><i class="fa-solid fa-envelope"></i><span>clean@house.com</span></a>
                <a href="tel: +7 (999) 999-99-99"><i class="fa-solid fa-phone"></i><span>+7 (999) 999-99-99</span></a>
            </div>
            <div class="mnw-social">
                <a href="#!" class="hcwr-left"><img src="./img/svg/tg.svg"></a>
                <a href="#!"><img src="./img/svg/wp.svg"></a>
            </div>
        </div>
    </div>

    <script src="./js/hamburger.js"></script>
    <script src="./js/owl.js"></script>
</body>
</html>