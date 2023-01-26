<?php

if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
}


$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_user_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user_by_id)) {
    $user_id                 =          $row['user_id'];
    $username                =          $row['username'];
    $user_password           =          $row['user_password'];
    $user_firstname           =          $row['user_firstname'];
    $user_lastname           =          $row['user_lastname'];
    $user_role               =          $row['user_role'];
    $user_image              =          $row['user_image'];
    $user_email              =          $row['user_email'];




    if (isset($_POST['edit_user'])) {
        $user_firstname           =        $_POST['user_firstname'];
        $user_lastname           =        $_POST['user_lastname'];
        $user_role               =        $_POST['user_role'];

        $user_image               =        $_FILES['image']['name'];
        $user_image_temp               =        $_FILES['image']['tmp_name'];

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
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role   =  '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image   = '{$user_image}', ";
        $query .= "user_password   = '{$user_password}' ";
        $query .= "WHERE user_id = {$the_user_id} ";



        $edit_user_query = mysqli_query($connection, $query);

        // this function checks if there is en error in the query
        confirmQuery($edit_user_query);
    }
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" type=" text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">




        <?php

        // keuze admin
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
        <input type="submit" name="edit_user" class="btn btn-primary" value="edit Post">
    </div>


</form>