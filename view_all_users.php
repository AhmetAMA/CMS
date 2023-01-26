<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>image</th>
            <th>password</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php



        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id          =      $row['user_id'];
            $username         =      $row['username'];
            $user_firstname   =      $row['user_firstname'];
            $user_lastname    =      $row['user_lastname'];
            $user_email       =      $row['user_email'];
            $user_image       =      $row['user_image'];
            $user_role        =      $row['user_role'];
            $user_password    =      $row['user_password'];



            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img width='100' src='../images/{$user_image}' alt='image'></td>";
            echo "<td>{$user_password}</td>";
            echo "<td>{$user_role}</td>";


            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
            // $select_post_id_query = mysqli_query($connection, $query);

            // while ($row  = mysqli_fetch_assoc($select_post_id_query)) {

            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];

            //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }



            echo "<td><a href='users.php?change_to_admin={$user_id}'>admin</a></td>";
            echo "<td><a href='users.php?change_to_docent={$user_id}'>docent</a></td>";
            echo "<td><a href='users.php?change_to_content_manager={$user_id}'>content-manager</a></td>";
            echo "<td><a href='users.php?change_to_moderator={$user_id}'>moderator</a></td>";
            echo "<td><a href='users.php?change_to_subscriber={$user_id}'>subscribe</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>update</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }


        ?>


    </tbody>
</table>

<?php

// dit is voor admin
if (isset($_GET['change_to_admin'])) {

    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $admin_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}


// dit is voor docent
if (isset($_GET['change_to_docent'])) {

    $the_user_id = $_GET['change_to_docent'];

    $query = "UPDATE users SET user_role = 'docent' WHERE user_id = $the_user_id ";
    $docent_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}




// dit is voor content-manager
if (isset($_GET['change_to_content_manager'])) {

    $the_user_id = $_GET['change_to_content_manager'];

    $query = "UPDATE users SET user_role = 'content-manager' WHERE user_id = $the_user_id ";
    $content_manager_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

// dit is voor moderator
if (isset($_GET['change_to_moderator'])) {

    $the_user_id = $_GET['change_to_moderator'];

    $query = "UPDATE users SET user_role = 'moderator' WHERE user_id = $the_user_id ";
    $moderator_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}








if (isset($_GET['change_to_subscriber'])) {

    $the_user_id = $_GET['change_to_subscriber'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $subscribe_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}








if (isset($_GET['delete'])) {

    $the_user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}
?>