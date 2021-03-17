<?php
    session_start();
?>

<div class="header_bar">
        <div class="logo_container">
            <h3>Crono<span>TASK</span></h3>
        </div>
        <nav class="settings_menu">
        <?php  
            if(isset($_SESSION["username"])){ ?>
                <a href="#"><?php echo $_SESSION["username"] ?><img src="img/avatar.png"> </a>
                <a href="functions/auth/logout.php">Logout</a>
        <?php
            } else{ ?>
                <a href="login.php">Log In <img src="img/avatar.png"> </a>
                <a href="#">Logout</a>
        <?php        
            }
        ?>

        </nav>
    </div>