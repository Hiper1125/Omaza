<?php

function SearchProductIn($category = null)
{
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

    //Creazione query
    if (is_null($category) || empty($category)) {
        $sql = "SELECT * FROM products ORDER BY Id ASC LIMIT 2";
    } else {
        $sql = "SELECT * FROM products WHERE ProductCategory='$category'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $data_array = array();

        //STORE ALL THE RECORD SETS IN THAT ARRAY 
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data_array, $row);
        }

        return $data_array;
    } else {
        return null;
    }

    //Chiusura connessione
    $conn->close();
}

function SearchProductBy($name)
{
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

    //Creazione query
    $sql = "SELECT * FROM products WHERE ProductName LIKE '%$name%'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $data_array = array();

        //STORE ALL THE RECORD SETS IN THAT ARRAY 
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data_array, $row);
        }

        return $data_array;
    } else {
        return null;
    }

    //Chiusura connessione
    $conn->close();
}

function PrintProductsBy($Rows)
{
    foreach ($Rows as &$product) {
        echo '<div class="container d-flex justify-content-center col-sm">';
        echo '<figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"> <img';
        echo " src='{$product["ProductImage"]}'></a><figcaption class='info-wrap'><div class='row'>";
        echo "<div class='col-md-9 col-xs-9'> <a href='#' class='title' data-abc='true'>{$product["ProductName"]}</a>";
        echo "<span class='category'>{$product["ProductCategory"]}</span></div><div class='col-md-3 col-xs-3'>";
        echo '<div class="rating text-right"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i';
        echo "class='fa fa-star'></i> <i class='fa fa-star'></i> <span class='price'>{$product["ProductPrice"]}€</span> </div>";
        echo '</div> </div> </figcaption> <center> <div class="bottom-wrap">';
        echo '<div class="price-wrap"> <a href="#" class="btn btn-warning float-left" data-abc="true"> Add To Cart </a> </div>';
        echo '</div> </center> </figure> </div>';
    }
}