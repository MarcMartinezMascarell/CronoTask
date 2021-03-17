<?php
    include_once 'includes/header.php';
?>
<body>
    <div class="auth_container">
        <h1>Crono<span>Task</span></h1>

        <?php  
            $error = "";
            if(isset($_GET["error"])){
                if($_GET["error"] == 'emptyinput'){
                    $error = "Fill in all the fields";
                } else if($_GET['error'] == 'noemail'){
                    $error = "This email doesn't exist";
                } else if($_GET["error"] == 'wronglogin'){
                    $error = "Password is wrong";
                }
            }
        
        ?>
        <p class="validation_error"><?php echo $error ?></p>
        <form id="login_form" class="auth_box" method="post" action="functions/auth/loginValidation.php">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Your Email">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your Password">
            </div>
            <div class="field">
                <input type="submit" class="form_button" value="LogIn" name="submit">     
            </div>
        </form>

    </div>
</body>
</html>