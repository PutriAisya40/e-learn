<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>e-Learning</title>
</head>

<body>
    <div id="header">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white; height: 65px;">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="../pens.png" width="130px" height="50px"></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#header">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Our Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="p-5 text-center bg-image" style="background-image: url('../4.png'); height: 600px;">
            <div class="d-flex justify-content align-items-center h-100" style="padding-left: 80px;">
                <div class="row">
                    <div class="col-md-6">
                        <div style="display: flex; margin-top: -20px;">
                            <h1 style="color: #f5c805;font-weight: 900; font-size: 90px;">e-Learning</h1>
                        </div>
                        <p style="text-align: justify; margin-top:10px; margin-bottom: 20px; color: white; font-weight:500">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, quis, saepe sequi velit distinctio est praesentium, obcaecati architecto ipsam pariatur labore porro eum asperiores illum inventore! Voluptate reprehenderit nihil
                            officiis. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit nisi nam dolorem dolore numquam necessitatibus molestias rerum nemo officiis
                        </p>
                        <div style="text-align: left">
                            <a href="#about" class="btn btn-outline-light" style="color: white;" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">More Info</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section id="about">
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-6">
                    <img src="../5.jpg" class="img-fluid" style="margin-top: 60px;">
                </div>
                <div class="col-md-6">
                    <h1>About Us</h1>
                    <hr>
                    <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum totam nobis aperiam repudiandae, asperiores pariatur molestias incidunt nemo non vitae iure voluptatum dolor, placeat animi, velit explicabo numquam rerum! Ab? Lorem ipsum
                        dolor sit amet consectetur adipisicing elit. Facilis rem sapiente quidem possimus explicabo error, itaque vel eum eius ab ex dicta tempore facere quae aperiam vitae ipsam provident architecto?Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores eius excepturi necessitatibus eveniet dolorem, esse officia nostrum assumenda repudiandae</p>
                    <a href="#products" type="button" class="btn btn-outline-info">More Info</a>
                </div>
            </div>
        </div>
    </section>


    <section style="margin-top: 135px; background-color: #f5f5f5; padding-top: 50px; padding-bottom: 100px" id="products">
        <div class="container">
            <div class="title">
                <h1>Our Services
                    <hr style="width: 100px;">
                </h1>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="../6.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify; font-size: 15px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="../6.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify; font-size: 15px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="../6.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify; font-size: 15px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>

    <aside class="footerHolder" style="margin-bottom: 30px;" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-4">
                    <img src="assets/pens.png" alt="">
                </div>
                <div class="col-12 col-sm-6 col-lg-3 pl-xl-14 mb-lg-0 mb-4">
                    <h3>Contact Us</h3><br>
                    <ul class="list-unstyled footerContactList mb-3">
                        <li><span class="fa fa-map-marker" style="margin-right: 8px;"></span>Address: Embong Malang Street, 32-36 Surabaya.</li><br>
                        <li><span class="fa fa-phone"></span> Phone : (+031) 3456 7890</li><br>
                        <li><span class="fa fa-envelope"></span> Email : ourstore@gmail.com</li>
                    </ul>
                    <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
                        <li>Follow us:</li>
                        <li style="margin-right: 10px;">
                            <a href="#" class="fa fa-facebook"></a>
                        </li>
                        <li style="margin-right: 10px;">
                            <a href="#" class="fa fa-twitter"></a>
                        </li>
                        <li style="margin-right: 10px;">
                            <a href="#" class="fa fa-pinterest"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function success() {
            swal("Success!", "Item has been added to cart", "success");
        }
    </script>
</body>

</html>