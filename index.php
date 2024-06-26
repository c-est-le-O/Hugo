<?php
session_start();
include('includes/header.php');
include('../includes/navbar.php'); 

?>

<?php if (isset($_SESSION['username'])): 
include('includes/navbar.php'); 
?>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="login/logout.php">Logout</a>
    <br>
    <a href="friends/friends.php">View Friends</a>
    <br>
    <a href="friends/search.php">Search Users</a>
    <br>
    <a href="friends/friend_requests.php">Friend Requests</a>
<?php else: ?>
    <div class="container_main_index">
        <div class="container_index">
            <h1 class="h1_index">Bienvenue !</h1>
            <div class="boutons_index">
                <a class="bouton_index inscription" href="register/register.php">Register</a>
                <a class="bouton_index" href="login/login.php">Login</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include('includes/footer.php'); ?>
