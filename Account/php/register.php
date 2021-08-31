<?php

if (isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['username'])) {

    //Recupero dati dal form
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pw = $_POST['password1'];
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

    //Controllo email esistente
    $sqlAlreadyUsed = "SELECT * FROM users WHERE DBEmail='$email' OR DBUsername='$username'";

    $alreadyUsedResult = mysqli_query($conn, $sqlAlreadyUsed);

    if ($alreadyUsedResult->num_rows > 0) {
        while ($RowsData = $alreadyUsedResult->fetch_assoc()) {
            $_SESSION['login'] = FALSE;
            return null;
        }
    } else {
        //Creazione query ed esecuzione
        $sqlInsert = "INSERT INTO users (Id, DBUsername, DBEmail, DBPassword) VALUES ('', '$user', '$email', '$pw_md5')";

        if (mysqli_query($conn, $sqlInsert) != null) {
            $sqlGet = "SELECT * FROM users WHERE DBEmail='$email' AND DBPassword='$pw_md5'";
            $result = mysqli_query($conn, $sqlGet);

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
        } else {
            return null;
        }
    }

    //Chiusura connessione
    $conn->close();
}

?>