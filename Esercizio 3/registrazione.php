<?php

    // acquisizione dei dati dell'utende in apposite variabili
    $nomeutente = $_POST["username"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $citta = $_POST["citta"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    // controllo del captcha
    session_start();

    if($_POST["user_captcha"] != $_SESSION['captcha'])
    {
    	die ('Dati non validi');
    }
    
    // regole delle password
    $password = $_POST["password"];
    $password_conf = $_POST["passwordconf"];
    if (strlen($password) < 8) 
    {
        die( "La password è troppo corta. Deve essere di almeno 8 caratteri. <a href=javascript:history.go(-1)> <br> Torna indietro</a>");
    } 
    elseif (!preg_match("#[0-9]+#", $password)) 
    {
        die( "La password deve contenere almeno un numero. <a href=javascript:history.go(-1)> <br> Torna indietro</a>"); 
    } 
    elseif (!preg_match("#[a-zA-Z]+#", $password)) 
    {
        die( "La password deve contenere almeno una lettera. <a href=javascript:history.go(-1)> <br> Torna indietro</a>");
    } 
    elseif ($password != $password_conf)
    {
        die("Le password inserite non coincidono");
    }

    // connessione al database
    $servername = "localhost";
    $username = "scoltomare";
    $dbpassword = "Seiscemo1!StefanoLmao";
    $dbname = "my_scoltomare";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname) OR die("Connessione non riuscita.");

    // crittografia della password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utente(username, nome, cognome, citta, telefono, email, password)
            VALUES('$nomeutente', '$nome', '$cognome', '$citta', '$telefono', '$email', '$password')";

    if ($conn -> query($sql) === TRUE)
    {
    	echo "Registrazione effettuata";
        echo "<a href=http://scoltomare.altervista.org/Es3/login.html> <br> Vai alla paginadi login.</a>";
    }
    else
    {
    	echo "Errore: " . $sql . $conn ->error;
        echo "<a href=javascript:history.go(-1)> <br> Torna indietro</a>";
    }

    $conn -> close();
?>