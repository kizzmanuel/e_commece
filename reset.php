<?php
require "assets/config/dbConnect.php";
require_once "assets/includes/sessions.php";
include_once "assets/includes/header.php";
?>

<div class="container my-4">
    <div class="card shadow p-3 mx-auto" style="max-width: 500px;">
        <?php echo success_msg();
        echo error_msg();

        if (!isset($_GET['tokenSent'])) {
        ?>
            <form action="assets/config/reset_config" method="post" id="loginForm">
                <h4 class="text-center py-3">Enter your Email to Reset your Password</h4>
                <input type="email" name="email" placeholder="Email.." class="form-control mb-4">
                <!-- <div class="d-flex">
                <input type="password" name="password" id="pass1" placeholder="Password.." class="form-control">
                <button type="button" id="btn1" onclick="showPass('#pass1','#btn1')" class="btn btn-primary icon-eye"></button>
            </div> -->

                <div class="text-right my-3">
                    <button name="sendTOKEN" type="submit" class="btn btn-primary">Send Token</button>
                </div>
                <p>

                    <a href="signin">Login Instead</a>
                </p>
            </form>

        <?php }elseif(isset($_GET['tokenSent'])){ ?>
            <form action="assets/config/reset_config" method="post" id="loginForm">
            <h4 class="text-center py-3">Enter your Valid Token to Reset your Password</h4>
            <input type="text" name="token" placeholder="Token.." class="form-control mb-4">
            
            <div class="d-flex">
                <input type="password" name="password" id="pass1" placeholder="New Password.." class="form-control">
                <button type="button" id="btn1" onclick="showPass('#pass1','#btn1')" class="btn btn-primary icon-eye"></button>
            </div>

            <div class="text-right my-3">
                <button name="resetPassword" type="submit" class="btn btn-primary">Reset Password</button>
            </div>
            <p>
               
                <a href="signin" >Login Instead</a>
            </p>
        </form>

        <?php } ?>

    </div>
</div>

<script>
    function changeForm() {
        document.querySelector('#loginForm').classList.toggle('d-none');
        document.querySelector('#signupForm').classList.toggle('d-none');
    }

    function showPass(input, btn) {
        const pass = document.querySelector(input);
        const button = document.querySelector(btn);

        if (pass.type === 'password') {
            pass.type = 'text'
            button.classList.toggle('icon-eye')
            button.classList.toggle('icon-eye-slash')
        } else {
            pass.type = 'password'
            button.classList.toggle('icon-eye')
            button.classList.toggle('icon-eye-slash')
        }
    }
</script>
<?php include_once "assets/includes/footer.php"; ?>