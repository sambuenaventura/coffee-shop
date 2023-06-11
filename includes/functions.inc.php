<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    unset($result);
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    unset($result);
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    unset($result);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    unset($result);
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
    
}

// function pwdStrength($pwd) {
//     unset($result);
//     foreach ($pwd as $Password) {

//         if (strlen($Password) < 8) {
//             echo "<p>Password is too short. Minimum of (8)</p>";
//             $result = true;
//         }
//         elseif (strlen($Password) > 16) {
//             echo "<p>Password is too long. Maximum of (16)</p>";
//             $result = true;
//         }
//         elseif(!preg_match("#[0-9]+#",$Password)) {
//             echo "<p>Your password must contain at least 1 Number!</p>";
//             $result = true;
//         }
//         elseif(!preg_match("#[A-Z]+#",$Password)) {
//             echo "<p>Your password must contain at least 1 Uppercase Letter!</p>";
//             $result = true;
//         }
//         elseif(!preg_match("#[a-z]+#",$Password)) {
//             echo "<p>Your password must contain at least 1 Lowercase Letter!</p>";
//             $result = true;
//         } 
//         elseif(!preg_match('/[^0-9A-Za-z]/',$Password)) {
//             echo "<p>Your password must contain at least 1 Special Character!</p>";
//             $result = true;
//         }
//         elseif(preg_match('/\\s/',$Password)) {
//             echo "<p>Your password contains a space(s). Please remove them!</p>";
//             $result = true;
//         }                                                       
//         else {
//             echo "<p>Strong Password!";
//             $result = false;
//         }
//     }
// }

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();        
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();        

}

function emptyInputLogin($username, $pwd) {
    unset($result);
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();        
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    
    mysqli_stmt_close($stmt);

}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        if ($uidExists["usertype"]=="user") {
            session_start();
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];
            header("location: ../index.php");
            exit(); 
        }
        elseif ($uidExists["usertype"]=="admin") {
            session_start();
            $_SESSION["adminid"] = $uidExists["usersId"];
            $_SESSION["adminuid"] = $uidExists["usersUid"];
            header("location: ../index.php");
            exit(); 
        }
    }

    
}
