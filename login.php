<?php
session_start();
require_once("classes\user.php");
$user = new User("123", "456");
if (!empty($_SESSION['login_status'])) {
    header('location: input.php');
}
if (!empty($_POST)) {
    $_SESSION['employee_id'] = $_POST['employee_id'];
    if ($user->id == $_POST['employee_id'] && $user->password == $_POST['password']) {
        $_SESSION['login_status'] = 'success';
        header('location: input.php');
    } else {
        echo "<script>alert(\"You've entered wrong Employee ID or Password\!\!\!\");</script>";
    }
}
?>

<?php
$pageTitle = "Login Page";
require_once("pages\header.php");
?>
<script src="scripts\toggle-password.js"></script>
<section class="hero is-primary is-fullheight is-bold">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-4">
                    <form action="" method="post" class="box">
                        <h1 class="title has-text-centered has-text-primary">Login</h1>
                        <hr>
                        <div class="field">
                            <div class="control has-icons-left">
                                <input type="text" name="employee_id" placeholder="Employee ID" class="input" value="<?php if (!empty($_SESSION['employee_id'])) echo $_SESSION['employee_id'] ?>" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <div class="control has-icons-left is-expanded">
                                <input type="password" name="password" placeholder="Password" class="input" id="password" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <div class="control" onclick="togglePassword();">
                                <a class="button">
                                    <i class="fa fa-eye-slash" id="eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="field">
                            <button type="submit" class="button is-primary is-fullwidth"><i class="fa fa-sign-in-alt"></i>&ensp; Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('pages\footer.php'); ?>