<?php

if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
        if (strlen($pwd) < 8) {
            echo "<p>Password is too short. Minimum of (8)</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        }
        // elseif (strlen($pwd) > 16) {
        //     echo "<p>Password is too long. Maximum of (16)</p>";
        //     header("location: ../signup.php?error=passwordstrength");
        //     exit();
        // }
        elseif(!preg_match("#[0-9]+#",$pwd)) {
            echo "<p>Your password must contain at least 1 Number!</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        }
        elseif(!preg_match("#[A-Z]+#",$pwd)) {
            echo "<p>Your password must contain at least 1 Uppercase Letter!</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        }
        elseif(!preg_match("#[a-z]+#",$pwd)) {
            echo "<p>Your password must contain at least 1 Lowercase Letter!</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        } 
        elseif(!preg_match('/[^0-9A-Za-z]/',$pwd)) {
            echo "<p>Your password must contain at least 1 Special Character!</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        }
        elseif(preg_match('/\\s/',$pwd)) {
            echo "<p>Your password contains a space(s). Please remove them!</p>";
            header("location: ../signup.php?error=passwordstrength");
            exit();
        }                                                       
    

    createUser($conn, $name, $email, $username, $pwd);

}
else {
    header("location: ../signup.php");
    exit();
}