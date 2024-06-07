<?php
include('include/header.php');
include('include/extensions.php');
?>
<link rel="stylesheet" href="stylesheets/index_Style.css">
<body>
<div class="container-fluid pt-3">
           <!-- Navigation Bar Start -->
           <nav class="navbar navbar-expand-sm navbar-dark bg-transparent px-3 pt-1 py-0">
           <a class="nav-brand h1 display-4 m-0 text-decoration-none text-light" href="index.php">Food<span>Hub</span></a>
           <button class="navbar-toggler" type="collapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
           aria-controls="navbarSupportedContent" aria-expanded="false">
           <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ms-auto text-center">
                   <li class="nav-item">
                       <a class="nav-link text-light mx-3 link-danger" href="#aboutUs">About Us</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link text-light mx-3 link-danger" href="#services">Services</a>
                   </li>
               </ul>
           </div>
           </nav>
           <!-- Navigation Bar End -->
       </div>
       <!-- Order Now and Track Order Button Start -->
       <div class="position-absolute translate-middle-y end-0 top-50">
           <p class="display-5 text-light text-end mx-5" style="cursor: default;">
               Savor the flavor of our world-class cuisine.
           </p>
           <div class="text-center">
               <a href="order.php"><button type="button" class="btn btn-outline-secondary btn-lg py-2 px-3 mx-2 border-light">Order Now</button></a>
               <a href="trackorder.php" class="btn btn-outline-secondary btn-lg py-2 px-3 border-light">Track Order</a>
           </div>
       </div>
       <!-- Order Now and Track Order Button End -->

   <!-- About Us Section -->
    <section id="aboutUs" class="bground2 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3">
                    <p class="display-4 text-light text-center" style="cursor: default;">About Us</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <p class="justify text-center mb-0" style="font-size: 2vw; cursor: default;">
                                    We are a team of food enthusiasts who are passionate about
                                    making the process of ordering food as convenient and enjoyable as possible.
                                    Our platform was created with the goal of providing a seamless experience
                                    for both restaurants and customers alike.
                                    <br><br>
                                    Our system is designed to be user-friendly, allowing customers
                                    to easily browse menus, place orders, and track delivery status.
                                    We understand that customer satisfaction is crucial, which is why
                                    we strive to provide exceptional service every step of the way.
                                    <br><br>
                                    Thank you for choosing our food ordering system for your next meal.
                                    We look forward to serving you!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Start -->
    <section id="services" class="bground3 pb-5">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-12">
                    <p class="display-4 text-light text-center pb-3" style="cursor: default;">Services</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <label class="text-light" style="font-size: 2vw;">Payment Method</label>
                    </div>
                    <div class="card bg-transparent" style="border: 0px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col" style="text-align: center;">
                                    <img class="rounded-4" src="assets/others/gcash.jpg" width="80%" alt="Payment Method">
                                </div>
                                <div class="col" style="text-align: center;">
                                    <img src="assets/others/cod.png" width="80%" alt="Payment Method">
                                </div>
                                <div class="col" style="text-align: center;">
                                    <img class="rounded-4" src="assets/others/paymaya.png" width="80%" alt="Payment Method">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <label class="text-light" style="font-size: 2vw;">Contact Us</label>
                    </div>
                    <div class="card bg-transparent">
                        <div class="card-body">
                            <div class="text-center">
                                <a style="font-size: 2vw;" class="text-decoration-none text-light link-primary"
                                href="mailto:foodhub042@gmail.com" title="Email Us">foodhub042@gmail.com</a>
                            </div>
                            <div class="text-center">
                                <label style="font-size: 2vw;" class="text-light">09917329267</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->
</body>
    <footer class="footer bg-dark">
        <p class="text-center text-light pb-2 pt-2 m-0" 
            style="font-size: 1vw; cursor: default;">
            <a style="cursor: default;" class="text-decoration-none text-light" href="login.php">&copy;</a> 2023 Foodhub. All Rights Reserved.
        </p>
    </footer>
</html>