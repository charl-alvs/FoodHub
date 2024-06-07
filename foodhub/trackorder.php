<?php
include('include/header.php');
include('include/extensions.php');
?>
<link rel="stylesheet" href="stylesheets/trackorder.css">
<body>
    <!-- Navigation Bar Start -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-transparent fixed-top px-3 pt-1 py-0">
       <a class="nav-brand h1 display-4 m-0 text-decoration-none text-light" href="index.php">Food<span>Hub</span></a>
       <button class="navbar-toggler" type="collapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent" aria-expanded="false">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                   <a class="nav-link text-light mx-3 link-danger" href="index.php">Home</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link text-light mx-3 link-danger" href="index.php#aboutUs">About Us</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link text-light mx-3 link-danger" href="index.php#services">Services</a>
               </li>
           </ul>
       </div>
    </nav>
    <!-- Navigation Bar End -->
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="justify-content-center" style="width: 70%;">
                <div class="card card-body">
                    <div class="text-center">
                        <h4 class="m-0">Enter Your Order Code</h4>
                    </div>
                    <form action="confirmed_track.php" method="POST">
                        <div class="form-group mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <input class="form-control text-center" type="number" name="cus_code" min="1" 
                                value="<?php if (!empty($_GET['code'])) { echo $_GET['code']; } else { echo $_GET['code'] = null; } ?>" 
                                placeholder="######" style="width: 30%;" onKeyPress="if(this.value.length==6) return false;" required>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="submit" class="btn btn-primary" name="submit_code" value="Submit Code">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>