<?php

if (isset($_POST['email']) && isset($_POST['password'])) {

    //Recupero dati dal form
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $pw_md5 = md5($pw);

    //Accesso al database
    $servername = "localhost";
    $username = "root";
    $password = "admin";
    $dbname = "omaza";

    //Connessione
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Controllo connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Creazione query ed esecuzione
    $sql = "SELECT * FROM users WHERE DBEmail='$email' AND DBPassword='$pw_md5'";
    $result = mysqli_query($conn, $sql);

    $Rows = array();

    if ($result->num_rows > 0) {
        while ($RowsData = $result->fetch_assoc()) {
            $Rows = $RowsData;
            $_SESSION['login'] = TRUE;
            
            var_dump(json_encode($Rows));
        }
    } else {
        return null;
    }

    //Chiusura connessione
    $conn->close();
}

?>