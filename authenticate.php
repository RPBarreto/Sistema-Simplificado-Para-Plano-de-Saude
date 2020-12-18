<?php
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $logged = false;

    libxml_use_internal_errors(true);

    $xml = simplexml_load_file("users.xml");
    
    
    if ($xml === false) {
        echo ("Falha ao carregar o código XML: ");
          
        foreach(libxml_get_errors() as $error) {
            echo ("<br>". $error->message);
    
        }
      
    } else {

        for ($i = 0; $i < sizeof($xml); $i++) {
            if ($xml->user[$i]->Email == $user && $xml->user[$i]->Pass == $pass) {
                session_start();
                
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;

                if ($xml->user[$i]->Type == '1'){
                    
                    $_SESSION['type'] = 1;

                    header("Location: home_admin.php");
                    $logged = true;
                    break;
                }
                if ($xml->user[$i]->Type == '2'){
                    $_SESSION['type'] = 2;

                    header("Location: home_md.php");
                    $logged = true;
                    break;
                }
                if ($xml->user[$i]->Type == '3'){
                    $_SESSION['type'] = 3;
                    $_SESSION['unique'] = "";

                    header("Location: home_lab.php");
                    $logged = true;
                    break;
                }
                if ($xml->user[$i]->Type == '4'){
                    $_SESSION['type'] = 4;

                    header("Location: home_pac.php");
                    $logged = true;
                    break;
                } 

            }
    
        }
    
    }

    if (!$logged) {
        header("Location: index.php?error=invalid_user");
    }



?>