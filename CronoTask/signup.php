<?php
    include_once 'includes/header.php';
?>
<body>
    <div class="auth_container">
        <h1>Crono<span>Task</span></h1>

        <?php
            $error = '';
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    $error = "Fill in all the fields";
                } else if($_GET['error'] == 'invalidemail'){
                    $error = 'Invalid Email';
                } else if($_GET['error'] == 'dontmatch'){
                    $error = "Passwords don't match";
                } else if($_GET['error'] == 'emailtaken'){
                    $error = "This email is already in use";
                }
            }
        ?>
        <p class="validation_error"><?php echo $error ?></p>
        <form id="signForm" class="auth_box" method="post" action="functions/auth/signValidation.php">
            <div class="field">
                <label for="name">UserName</label>
                <input type="text" name="name" id="name" placeholder="Your UserName">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Your Email">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your Password">
            </div>
            <div class="field">
                <label for="password">Repeat Password</label>
                <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Repeat Your Password">
            </div>
            <div class="field">
                <input type="submit" class="form_button" value="Sign Up" name="submit">     
            </div>
        </form>

    </div>

    <script src="js/sweetAlert/sweetalert2.all.min.js"></script>
    <script src="js/auth/signup.js"></script>
</body>
</html>