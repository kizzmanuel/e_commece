<?php
    require "assets/config/dbConnect.php";
    require_once "assets/includes/sessions.php";
    include_once "assets/includes/header.php";
?>

<div class="container my-4">
    <div class="card shadow p-3 mx-auto" style="max-width: 500px;">
        <?php echo success_msg(); echo error_msg(); ?>
        <form action="assets/config/login_config" method="post" id="loginForm">
            <h4 class="text-center py-3">Login to your Account</h4>
            <input type="email" name="email" placeholder="Email.." class="form-control mb-4">
            <div class="d-flex">
                <input type="password" name="password" id="pass1" placeholder="Password.." class="form-control">
                <button type="button" id="btn1" onclick="showPass('#pass1','#btn1')" class="btn btn-primary icon-eye"></button>
            </div>

            <div class="text-right my-3">
                <button name="login" type="submit" class="btn btn-primary">Login</button>
            </div>
            <p>
                Don't have an account? <a href="#" onclick="changeForm()">Create Account</a> <br>
                Forgot Password? <a href="reset" >Reset</a>
            </p>
        </form>
        <form action="assets/config/reg_config" method="post" id="signupForm" class="d-none">
            <h4 class="text-center py-3">Create a new Account</h4>
            <input type="text" name="fname" placeholder="First Name.." class="form-control mb-4" required>
            <input type="text" name="lname" placeholder="Last Name.." class="form-control mb-4" required>
            <input type="tel" name="phone" placeholder="Phone.." class="form-control mb-4" required>
            <input type="email" name="email" placeholder="Email.." class="form-control mb-4" required>
            <div class="d-flex my-2">
                <input type="password" name="password" id="pass2" placeholder="Password.." class="form-control" required>
                <button type="button" id="btn2" onclick="showPass('#pass2','#btn2')" class="btn btn-primary icon-eye"></button>
            </div>
            <div class="d-flex">
                <input type="password" name="conPass" placeholder="Password.." id="con" class="form-control" required>
                <button type="button" id="btn3" onclick="showPass('#con', '#btn3')" class="btn btn-primary icon-eye"></button>
            </div>

            <div class="text-right my-3">
                <button name="register" class="btn btn-primary">Create</button>
            </div>
            <p>
                Already have an account? <a href="#" onclick="changeForm()">Login</a>
            </p>
        </form>
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