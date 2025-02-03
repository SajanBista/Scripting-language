<?php
include 'include/connect.php';

session_start();
if (isset($_POST['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!--Bootstrap Link-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Hike Gear Nepal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
                <ul class="navbar-nav nav ms-">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Rents</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="blog.php">Blog</a> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>


            <form class="d-flex" action="search_page.php" method="post">
                <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required>
                <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button>
            </form>

            <div class="icon">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a>
                <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </nav>

    <div class="home-bg">
        <section class="home">
            <div class="home-slider">
                <!-- <div class="swiper-wrapper"> -->
                <div class="slide">
                    <div class="image">
                        <img src="images/banner/banner1.jpg" alt="" style="height: 50rem; object-fit: cover; width: 100%;">
                    </div>
                    <div class="content">
                        <span>Shop the latest Today</span>
                        <!-- <h3>Sustainability starts at Home</h3> -->
                        <!-- <a href="index.php" class="btn">Rent Now</a> -->
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="swiper-pagination"></div>
        </section>
    </div>

    <section class="category">
        <h1 class="heading">Shop by category</h1>
        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                <a href="category.php?name=Bamboo" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-1.png" alt=""> -->
                    <h3>TENT</h3>
                </a>

                <a href="category.php?name=New Products" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-2.png" alt=""> -->
                    <h3>New Product</h3>
                </a>

                <a href="category.php?name=Bamboo" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-1.png" alt=""> -->
                    <h3>New Product</h3>
                </a>

                <a href="category.php?name=New Products" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-2.png" alt=""> -->
                    <h3>New Product</h3>
                </a>

                <a href="category.php?name=Bamboo" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-1.png" alt=""> -->
                    <h3>New Product</h3>
                </a>

                <a href="category.php?name=New Products" class="swiper-slide slide" style="width: 217.6px; height:10rem;">
                    <!-- <img src="images/categories/icon-2.png" alt=""> -->
                    <h3>New Product</h3>
                </a>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <h1 class="heading">Latest products</h1>

    <div class="box-container">

        <?php

        $query = "SELECT * FROM products LIMIT 6";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($result)) {
        ?>
                <div class="boxs">
                    <form action="cart.php" method="post" class="slides">
                        <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_product['id']); ?>">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_product['name']); ?>">
                        <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_product['price']); ?>">
                        <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_product['image']); ?>">
                        <!-- image  -->
                        <img src="images/products/<?= htmlspecialchars($fetch_product['image']); ?>" alt="">

                        <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>

                        <div class="flex">
                            <div class="price">
                                <span>Rs.</span><?= htmlspecialchars($fetch_product['price']); ?><span>/-</span>
                            </div>
                            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length==2) return false;" value="1">
                        </div>

                        <input type="submit" value="Rent " class="btns" name="add_to_cart">
                    </form>

                </div>

        <?php
            }
        } else {
            echo '<p class="empty">No Produts Found.</p>';
        }

        ?>
    </div>


    <footer class="bg-secondary text-center text-white">

        <div class="container p-4 pb-0">

            <section class="mb-4">

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
            </section>

        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Hike gear Nepal</a>
        </div>

    </footer>


    <script src="js/script.js"></script>

    <script>
        // var swiper = new Swiper(".home-slider", {
        //     loop: true,
        //     spaceBetween: 20,
        //     pagination: {
        //         el: ".swiper-pagination",
        //         clickable: true,
        //     },
        // });

        var swiper = new Swiper(".category-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
        });

        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>