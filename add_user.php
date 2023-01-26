<?php

if (isset($_POST['create_user'])) {
    echo  $user_firsname           =        $_POST['user_firstname'];
    $user_lastname           =        $_POST['user_lastname'];
    $user_role               =        $_POST['user_role'];

    $user_image               =        $_FILES['image']['name'];
    $user_image_temp               =        $_FILES['image']['tmp_name'];

    $username               =        $_POST['username'];
    $user_email             =        $_POST['user_email'];
    $user_password          =        $_POST['user_password'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(
 
    username,
    user_password ,
    user_firstname,
    user_lastname,
    user_email,
    user_image,
    user_role ) ";

    $query .= "VALUES(

        '{$username}',
        '{$user_password}',
        '{$user_firsname}',
        '{$user_lastname}',
        '{$user_email}',
        '{$user_image}',
        '{$user_role}'
    ) ";

    $create_user_query = mysqli_query($connection, $query);

    // this function checks if there is en error in the query
    confirmQuery($create_user_query);
}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">
        <option value="subscriber">student</option>
        <option value="admin">admin</option>
        <option value="subscriber">subscriber</option>
        <option value="content_manager">content-manager</option>
        <option value="moderator">moderator</option>
        <option value="docent">docent</option>


    </select>




    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">User name</label>
        <input type="text" class="form-control" name="username">
    </div>


    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>


    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-primary" value="Add Post">
    </div>


</form>