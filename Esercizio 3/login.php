<?php

    // connessione al database
    $servername = "localhost";
    $username = "scoltomare";
    $dbpassword = "Seiscemo1!StefanoLmao";
    $dbname = "my_scoltomare";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname) OR die("Connessione non riuscita.");

    // recupero valori login
    $namelogin = $_POST["namelogin"]; 
    $passwordlogin = $_POST["passwordlogin"];

    // cerca l'utente nel database
    if(stripos($namelogin, "@") !== false)
    {
        $sql = "SELECT * FROM utente WHERE email = '$namelogin'";
    }
    else
    {
        $sql = "SELECT * FROM utente WHERE username = '$namelogin'";
    }

    $risultato = $conn->query($sql); // risultato della ricerca

    // l'utente esiste
    if($risultato -> num_rows == 1)
    {
        $row = $risultato -> fetch_assoc();
        // avvia la sessione e reindirizza l'utente alla pagina d'accesso
        if(password_verify($passwordlogin, $row['password']))
        {
            session_set_cookie_params(0);
            session_start();
            $_SESSION["namelogin"] = $namelogin;
            header("Location: login.php");
        }
        else
        {
            echo "Password errata.";
        }
        
    }
    
    else
    {
        // se le credenziali sono errate, visualizza un messaggio di errore
        echo "Utente inesistente.";
    }
    
    $conn -> close();

?>
