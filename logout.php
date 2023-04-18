<?php ob_start(); ?>
<?php session_start(); ?>

<?php 
// $_SESSION['username'] = null;
// $_SESSION['firstname'] = null;
// $_SESSION['lastname'] = null;
// $_SESSION['user_role'] = null;

// header("Location: ../index.php");
?>

<?php

class Logout {
    public function __construct() {
        $this->logout();
    }
    
    public function logout() {
        $_SESSION['username'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
        $_SESSION['user_role'] = null;

        header("Location: ../index.php");
        exit();
    }
}

$logout = new Logout();

?>