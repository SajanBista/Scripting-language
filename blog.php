<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .blog-post {
            background: #fff;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .blog-post img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .blog-post h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .blog-post .meta {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .blog-post p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .blog-post .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .blog-post .btn:hover {
            background-color: #218838;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .blog-post h1 {
                font-size: 2rem;
            }

            .blog-post p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Eco-Planet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
                <ul class="navbar-nav nav ms-">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Blog</a>
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
                    <div class="image" style="width: 100%; height: 50rem; overflow: hidden;">
                        <img src="images/about/banner.png" alt="Banner Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="content" style="margin-top:4rem;">
                        <h3 style="font-family: sans-serif; text-transform: none; font-size:9rem;">Make an Impact</h3>
                        <a href="index.php" class="btn">Shop Now</a>
                    </div>

                </div>
            </div>

            <div class="container">
                <!-- Blog Post Section -->
                <div class="blog-post">
                    <img src="images/about/banner2.png" alt="Earth Saving Blog Image">
                    <h1>Make an Impact: Why Sustainability Matters</h1>
                    <div class="meta">
                        <span>Posted on December 25, 2024 by <strong>John Doe</strong></span>
                    </div>
                    <p>
                        Sustainability is no longer just a trend, but a necessity for our planet's survival. The way we consume, produce, and interact with the environment has a lasting impact. In this post, we’ll explore why making eco-friendly choices is important and how you can contribute to a greener world.
                    </p>
                    <p>
                        The demand for sustainable products and solutions is growing as more people realize the importance of preserving the environment. From reducing plastic waste to supporting renewable energy sources, there are numerous ways we can all play a part.
                    </p>
                    <a href="#" class="btn">Read More</a>
                </div>
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
                    <a class="text-white" href="https://mdbootstrap.com/">eco-planet.com</a>
                </div>

            </footer>

            <script src="js/script.js"></script>

            <script>
                var swiper = new Swiper(".home-slider", {
                    loop: true,
                    spaceBetween: 20,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });

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