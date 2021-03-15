<?php
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $logged = false;

    $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

    $sql = "SELECT * FROM users as u WHERE u.email = '".$user."' AND u.pass = '".$pass."'";

    $res = $conn->query($sql);

    if ($res) {
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);
        $userInfo = $rows[0];

    }
    

    if ($res) {
        session_start();
        
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;

        if ($userInfo["type"] == '1'){     
            $_SESSION['type'] = 1;
            $_SESSION['unique1'] = "";
            $_SESSION['unique2'] = "";

            header("Location: home_admin.php");
            $logged = true;

        }

        if ($userInfo["type"] == '2'){
            $_SESSION['type'] = 2;
            $_SESSION['unique'] = "";

            header("Location: home_md.php");
            $logged = true;

        }
        
        if ($userInfo["type"] == '3'){
            $_SESSION['type'] = 3;
            $_SESSION['unique'] = "";

            header("Location: home_lab.php");
            $logged = true;
        
        }
            
        if ($userInfo["type"] == '4'){
            $_SESSION['type'] = 4;

            header("Location: home_pac.php");
            $logged = true;

        } 
    
    }

    if (!$logged) {
        header("Location: index.php?error=invalid_user");

    }



?>