<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
// if (isset($_POST['login'])) {
//     $username = $_POST['username']; //naam van de input zelf in de sidebar.php bestand
//     $password = $_POST['password']; //password van de input zelf in de sidebar.php bestand

//     $username = mysqli_real_escape_string($connection, $username);
//     $password = mysqli_real_escape_string($connection, $password);

//     $query = "SELECT * FROM users WHERE username = '{$username}' ";
//     $select_user_query = mysqli_query($connection, $query);
//     if (!$select_user_query) {
//         die("Query failed" . mysqli_error($connection));
//     }

//     while ($row = mysqli_fetch_array($select_user_query)) {
//         $db_user_id = $row['user_id'];
//         $db_username = $row['username'];
//         $db_user_password = $row['user_password'];
//         $db_user_firstname = $row['user_firstname'];
//         $db_user_lastname = $row['user_lastname'];
//         $db_user_role = $row['user_role'];
//     }

//     if ($username === $db_username && $password === $db_user_password) {
//         $_SESSION['username'] = $db_username;
//         $_SESSION['firstname'] = $db_user_firstname;
//         $_SESSION['lastname'] = $db_user_lasstname;
//         $_SESSION['user_role'] = $db_user_role;
//         header("Location: ../admin");
//     } else {
//         header("Location: ../index.php");
//     }
// }
?>

<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cms";

    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function escape($string) {
        return mysqli_real_escape_string($this->connection, $string);
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->connection));
        }
        return $result;
    }

    public function fetch_array($result) {
        return mysqli_fetch_array($result);
    }

    public function close() {
        mysqli_close($this->connection);
    }
}

class User {
    private $db;

    public $user_id;
    public $username;
    public $user_password;
    public $user_firstname;
    public $user_lastname;
    public $user_role;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $username = $this->db->escape($username);
        $password = $this->db->escape($password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = $this->db->query($query);

        while ($row = $this->db->fetch_array($select_user_query)) {
            $this->user_id = $row['user_id'];
            $this->username = $row['username'];
            $this->user_password = $row['user_password'];
            $this->user_firstname = $row['user_firstname'];
            $this->user_lastname = $row['user_lastname'];
            $this->user_role = $row['user_role'];
        }

        if ($username === $this->username && $password === $this->user_password) {
            session_start();
            $_SESSION['username'] = $this->username;
            $_SESSION['firstname'] = $this->user_firstname;
            $_SESSION['lastname'] = $this->user_lastname;
            $_SESSION['user_role'] = $this->user_role;
            header("Location: ../admin");
        } else {
            header("Location: ../index.php");
        }
    }
}

$db = new Database();
$user = new User($db);

if (isset($_POST['login'])) {
    $user->login($_POST['username'], $_POST['password']);
}

$db->close();