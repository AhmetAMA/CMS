<?php include "includes/admin_header.php" ?>

<?php

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {

        $user_id            = $row['user_id'];
        $username           = $row['username'];
        $user_password      = $row['user_password'];
        $user_firstname     = $row['user_firstname'];
        $user_lastname      = $row['user_lastname'];
        $user_email         = $row['user_email'];
        $user_image         = $row['user_image'];
        $user_role          = $row['user_role'];
    }
}


?>

<?php


if (isset($_POST['edit_user'])) {
    $user_firstname         =        $_POST['user_firstname'];
    $user_lastname          =        $_POST['user_lastname'];
    $user_role              =        $_POST['user_role'];

    $user_image             =        $_FILES['image']['name'];
    $user_image_temp        =        $_FILES['image']['tmp_name'];

    $username               =        $_POST['username'];
    $user_email             =        $_POST['user_email'];
    $user_password          =        $_POST['user_password'];


    move_uploaded_file($user_image_temp, "../images/$user_image");
    // dit voor het  foto bekijken 
    if (empty($user_image)) {

        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_user_image = mysqli_query($connection, $query);

        while ($row  = mysqli_fetch_assoc($select_user_image)) {

            $user_image = $row['image'];
        }
    }


    $query = "UPDATE users SET ";
    $query .= "user_firstname       = '{$user_firstname}', ";
    $query .= "user_lastname        = '{$user_lastname}', ";
    $query .= "user_role            =  '{$user_role}', ";
    $query .= "username             = '{$username}', ";
    $query .= "user_email           = '{$user_email}', ";
    $query .= "user_image           = '{$user_image}', ";
    $query .= "user_password        = '{$user_password}' ";
    $query .= "WHERE username        = {$username} ";
}
?>


<div id="wrapper">



    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>




                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Firstname</label>
                            <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Lastname</label>
                            <input value="<?php echo $user_lastname; ?>" type=" text" class="form-control" name="user_lastname">
                        </div>

                        <div class="form-group">

                            <select name="user_role" id="">

                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php

                                if ($user_role == 'admin') {

                                    echo "<option value='subscriber'>subscriber</option>";
                                    echo "<option value='moderator'>moderator</option>";
                                    echo "<option value='content_manager'>content-manager</option>";
                                    echo "<option value='docent'>docent</option>";
                                    echo "<option value='admin'>admin</option>";
                                } else {
                                    echo "<option value='admin'>admin</option>";
                                }



                                ?>






                            </select>




                        </div>





                        <div class="form-group">
                            <img width="100" file="image" src="../images/<?php echo $user_image; ?>" alt="">
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="post_tags">User name</label>
                            <input value="<?php echo $username; ?>" type=" text" class="form-control" name="username">
                        </div>


                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input value="<?php echo $user_email; ?>" type=" email" name="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input value="<?php echo $user_password; ?>" type=" password" name="user_password" class="form-control">
                        </div>


                        <div class="form-group">
                            <input type="submit" name="edit_user" class="btn btn-primary" value="Update Profile">
                        </div>


                    </form>





                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>





    <!-- /#page-wrapper -->



    <?php include "includes/admin_footer.php" ?>