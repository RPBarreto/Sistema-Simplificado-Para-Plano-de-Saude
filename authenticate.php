<?php
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $logged = false;

    libxml_use_internal_errors(true);

    $xml = simplexml_load_file("admins.xml");
    
    if ($xml === false) {
        echo ("Falha ao carregar o código XML: ");
          
        foreach(libxml_get_errors() as $error) {
            echo ("<br>". $error->message);
    
        }
      
    } else {

        for ($i = 0; $i < sizeof($xml); $i++) {
            
            if ($xml->medico[$i]->Email == $user && $xml->admin[$i]->Pass == $pass) {
                session_start();
                
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;

                header("Location: home_admin.php");
                $logged = true;
                break;

            }
    
        }
    
    }

    if (!$logged) {
        header("Location: index.php?error=invalid_user");
    }



?>