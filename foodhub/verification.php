<?php
include('include/header.php');
include('include/extensions.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

    if (isset($_POST['sendCode'])) {

        if (!empty($_POST['customer_email'])) {

            try {
                $cusEmail = $_POST['customer_email'];
                $code = random_int(1, 999999);

                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'foodhub042@gmail.com';
                $mail->Password = 'yvdsbzqqrmfknyhi';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('foodhub042@gmail.com');
                $mail->addAddress($cusEmail);
                $mail->isHTML(true);

                $mail->Subject = "Verification Code";
                $mail->Body = "Your verification code is " . $code;
                if ($mail->send()) {
                    ?>
                    <script>
                        alert("Send Successfully! Check your email and get the code!");
                    </script>
                    <?php
                    $_SESSION['verification_code'] = $code;
                }
            } catch (Exception $e) {
                ?>
                <script>
                    alert("Unable to send! Check your internet connection!");
                </script>
                <?php
            }

        } else {
            ?>
            <script>
                alert("Please provide a email!");
            </script>
            <?php
        }

    }

    if (isset($_POST['verify'])) {

        if ($_POST['codeSend'] == $_SESSION['verification_code']) {
            header("Location: checkout_order.php");
        } else {
            ?>
            <script>
                alert("Incorrect Code! Please Try Again!");
            </script>
            <?php
        }

    }

?>
<link rel="stylesheet" href="stylesheets/verification.css">
<script>
    function able() {
        document.getElementById("sendCodeBtn").disabled = false;
        document.getElementById("mail").disabled = false;
    }

    function disable() {
        document.getElementById("sendCodeBtn").disabled = true;
        document.getElementById("mail").disabled = true;
    }

    function BackToLastPage() {
        window.history.go(-1);
    }
</script>
<body>
    <div class="container">
        <h1 class="text-center text-light display-2" style="font-weight: 600;">Food<span>Hub</span></h1>
        <div class="d-flex justify-content-center align-items-center">
            <div style="width: 50%;">
                <div class="card card-body">
                    <div class="bg-dark text-light mb-3 py-2 px-3 rounded text-center">
                        Enter your valid email and we must send you a verification code to confirm your order.
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" id="mail" type="email" name="customer_email" placeholder="admin@foodhub.com" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-success w-100" id="sendCodeBtn" name="sendCode"><i class="bi bi-send-fill"></i> Send Code</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <input class="form-control text-center w-50" onclick=disable() onblur=able() onKeyPress="if(this.value.length==6) return false;" min=1 type="number" name="codeSend" placeholder="######">
                            <input class="btn btn-dark ms-2" type="submit" name="verify" value="Verify Code">
                        </div>
                    </form>
                </div>
                <button class="btn btn-danger mt-2" onclick="BackToLastPage()" style="width: 25%;">Back</button>
            </div>
        </div>
    </div>
</body>
</html>