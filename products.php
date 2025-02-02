<?php
include '../include/connect.php';

session_start();



if (isset($_POST['add_product'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $price = htmlspecialchars(trim($_POST['price'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../images/products/' . basename($image);

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
            exit;
        }

        if ($image_size > 2 * 1024 * 1024) {
            echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
            exit;
        }

        // Move the uploaded file
        if (move_uploaded_file($image_tmp_name, $image_folder)) {
            $query = "INSERT INTO products (name, price, description, image) 
                      VALUES ('$name', '$price', '$description', '$image')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Product added successfully and saved in database.');</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Failed to move the uploaded file.');</script>";
        }
    } else {
        echo "<script>alert('Please upload an image.');</script>";
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $query = "SELECT * FROM products WHERE id='$delete_id'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        unlink('../images/products/' . $row['images']);
    }

    //delete from db.
    $query = "DELETE from products where id='$delete_id'";
    mysqli_query($conn, $query);

    //delete from cart
    $query = "DELETE from cart where pid='$delete_id'";
    mysqli_query($conn, $query);

    header('location:products.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


    <link rel="stylesheet" href="../css/admin_part.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!--Bootstrap Link-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /*nav bar*/
        .container-box {
            width: 100%;
            background-color: #2a9d8f;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .top-header-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            color: #fff;
            font-family: "Arial", sans-serif;
        }

        .top-header-navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .top-header-navbar a:hover {
            color: #e9c46a;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #e76f51;
        }

        .header i {
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .header i:hover {
            color: #e9c46a;

        }

        /* other code */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Heading */
        .heading {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Section */
        .orders {
            width: 80%;
            margin: 2rem auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .inputBox {
            display: flex;
            flex-direction: column;
        }

        .inputBox span {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .inputBox input,
        .inputBox textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .inputBox input[type="file"] {
            padding: 3px;
        }

        textarea {
            resize: vertical;
        }

        .btns {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btns:hover {
            background-color: #45a049;
        }

        /* Show Products Section */
        .show-products {
            width: 80%;
            margin: 40px auto;
            text-align: center;
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            padding: 20px 0;
        }

        .boxs {
            width: 250px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }

        .boxs img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .boxs h3 {
            font-size: 1.5em;
            margin: 15px 0;
            color: #333;
        }

        .price {
            font-size: 1.2em;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .price span {
            font-weight: bold;
        }

        .boxs p {
            font-size: 1em;
            color: #777;
            margin-bottom: 20px;
        }

        .flex-btn {
            display: flex;
            justify-content: space-between;
        }

        .option-btn,
        .delete-btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .option-btn {
            background-color: #007BFF;
        }

        .option-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #FF5733;
        }

        .delete-btn:hover {
            background-color: #cc4626;
        }
    </style>
</head>

<body>
    <!--Navbar Header-->

    <div class="container-box">
        <div class="top-header-navbar">
            <a href="#">Hike Gear NEPAL </a>
            <div class="header">
                <i class="fa-solid fa-bell"></i>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </div>

    <div class="swiper products-slider">
        <section class="orders">
            <h1 class="heading">Add Products</h1>

            <form action="" method="post" enctype="multipart/form-data" class="form">
                <div class="inputBox">
                    <span>Product Name</span>
                    <input type="text" class="box" required name="name" placeholder="Name">
                </div>
                <div class="inputBox">
                    <span>Price</span>
                    <input type="number" class="box" required name="price" placeholder="Price">
                </div>
                <div class="inputBox">
                    <span>Image</span>
                    <input type="file" class="box" required accept="image/*" name="image">
                </div>
                <div class="inputBox">
                    <span>Description</span>
                    <textarea name="description" class="box" required placeholder="Description"></textarea>
                </div>
                <input type="submit" name="add_product" class="btns" value="Add Product">
            </form>

        </section>
        <div class="swiper-pagination"></div>
    </div>

    <section class="show-products">
        <h1 class="heading">Added Products</h1>

        <div class="box-container">
            <?php

            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($product = mysqli_fetch_assoc($result)) {
            ?>

                    <div class="boxs">
                        <img src="../images/products/<?= htmlspecialchars($product['image']); ?>" alt="">
                        <h3><?= htmlspecialchars($product['name']); ?></h3>
                        <div class="price">Rs.<span><?= htmlspecialchars($product['price']); ?></span></div>
                        <p><?= htmlspecialchars($product['description']); ?></p>

                        <div class="flex-btn">
                            <a href="update_products.php?update=<?= ($product['id']); ?>" class="option-btn">Update</a>
                            <a href="products.php?delete=<?= $product['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<script type='text/javascript'>
                alert('No Products Found.');
                
                </script>";
            }
            ?>
        </div>
    </section>

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