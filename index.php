<?php
session_start();
include("connect.php");

$showLogin = false;
if (isset($_GET['login'])) {
    $showLogin = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link href="popup.css" rel="stylesheet"> <!-- popup styles -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>@import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap');</style>
</head>
<body>
    <div class="wrapper <?php echo $showLogin ? '' : ''; ?>">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <!-- Login form -->
        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:29;">Log In</h2>
            <form action="login.php" method="POST" autocomplete="off">
                <div class="input-box animation" style="--i:1; --j:30;">
                    <input type="text" name="username" id="login-username" required>
                    <label for="login-username">Username</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:2; --j:31;">
                    <input type="password" name="password" id="login-password" required>
                    <label for="login-password">Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div id="logRole" class="logRole animation" style="--i:3; --j:32;">
                    <div class="input-row">
                        <label class="role-label">Log In As:</label>
                        <select name="role" class="role-select" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div> 
                </div>

                <button type="submit" class="btn animation" value="Login" name="login" style="--i:4; --j:33;">Login</button>

                <div class="logreg-link animation" style="--i:5; --j:34;">
                    <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
                <p class="logreg-link animation recover" style="--i:5; --j:34;"><a href="#">Forgot password?</a></p>
            </form>
        </div>
        
        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:29;">Welcome Back!</h2>
            <p class="animation" style="--i:1; --j:30;">Join the Champions' team of money.</p>
        </div>

        <!-- Register form -->
        <div class="form-box register">
            <h2 class="animation" style="--i:23; --j:0;">Sign Up</h2>
            <form action="register.php" method="POST">
                <div class="input-box animation" style="--i:24; --j:1;" >
                    <input type="text" name="username" id="register-username" required autocomplete="username">
                    <label for="register-username">Username</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:25; --j:2;">
                    <input type="email" name="email" id="register-email" required autocomplete="email">
                    <label for="register-email">E-mail</label>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box animation" style="--i:26; --j:3;">
                    <input type="tel" name="phone" id="register-phone" required pattern="[0-9+]{7,20}" autocomplete="tel">
                    <label for="register-phone">Phone Number</label>
                    <i class='bx bxs-phone'></i>
                </div>

                <div class="input-box animation" style="--i:27; --j:4;">
                    <input type="password" name="password" id="register-password" required autocomplete="new-password">
                    <label for="register-password">Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn animation" value="Sign Up" name="signup" style="--i:28; --j:5;">Sign Up</button>

                <div class="logreg-link animation" style="--i:29; --j:6;">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>

        <div class="info-text register">
            <h2 class="animation" style="--i:24; --j:0;">Welcome!</h2>
            <p class="animation" style="--i:25; --j:1;">Join the Champions' team of money.</p>
        </div>
    </div>

    <!-- Popup container -->
    <div id="popup" class="popup"></div>

    <!-- External JS -->
    <script src="popup.js"></script>
    <script src="script.js"></script>

    <!-- Trigger popups from PHP session messages -->
    <?php if (isset($_SESSION['reg_success'])): ?>
      <script>showPopup("<?php echo $_SESSION['reg_success']; ?>", "success");</script>
      <?php unset($_SESSION['reg_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['reg_error'])): ?>
      <script>showPopup("<?php echo $_SESSION['reg_error']; ?>", "error");</script>
      <?php unset($_SESSION['reg_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['login_error'])): ?>
      <script>showPopup("<?php echo $_SESSION['login_error']; ?>", "error");</script>
      <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['login_success'])): ?>
      <script>showPopup("<?php echo $_SESSION['login_success']; ?>", "success");</script>
      <?php unset($_SESSION['login_success']); ?>
    <?php endif; ?>
</body>
</html>