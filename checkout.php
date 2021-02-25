<html>
<head> 
    <title> Book Inventory Management </title>
</head>
<body>
    <h1 style="text-align:center"> Book Inventory Management</h1>
</body>
</html>


<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require('mysqli_connect.php');
        session_start();
        $errors = [];

        $fn = $_POST["f_name"];
        $ln = $_POST["l_name"];
        $ad = $_POST["address"];
        $cd = $_POST["card_details"];

        if(empty($fn)){
            $errors[] = "First Name is empty";
        }
        else{
            $f = mysqli_real_escape_string($dbc, trim($fn));
        }
        if(empty($ln)){
            $errors[] = "Last Name is empty";
        }
        else{
            $l = mysqli_real_escape_string($dbc, trim($ln));
        }
        if(empty($ad)){
            $errors[] = "Address is empty";
        }
        else{
            $a = mysqli_real_escape_string($dbc, trim($ad));
        }
        if(empty($cd)){
            $errors[] = "Card Number is empty";
        }
        else{
            $c = mysqli_real_escape_string($dbc, trim($cd));
        }
        if(empty($errors)){
            $q = "INSERT INTO bookstore.checkout (f_name, l_name, address) VALUES ('$fn', '$ln', '$ad')";
            $r = @mysqli_query($dbc, $q);
            if($r){
                // $ab = "SELECT book_id from bookstore.inventory";
                // $res = @mysqli_query($dbc, $ab);
                // $const = (int)1;
                // $final = "UPDATE bookstore.inventory SET quantity = quantity - $const WHERE book_id = '$res' ";
                // $final1 = @mysqli_query($dbc, $final);dev
                header("Location: checkout.php");
                session_destroy();
            }
            mysqli_close($dbc);
            exit();
        }
        else{
            echo '<h1> Errors </h1>;
            <p class = "error"> The following error(s) occurred: <br> ';
        foreach($errors as $msg){
            echo " - $msg<br> \n";
        } 
    }
    mysqli_close($dbc);
}

?>

<html lang="en">
<head>
    <title> Book Inventory </title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <div class="main">

        <section class="home">
            <div class="container">
                <div class="signup-content">
                    <h2> Checkout Or<a href = "buy.php"> Click here to go back </a></h2>
                    <form method="POST" id="signup-form" class="signup-form"> 
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First_Name</label>
                                <input type="text" class="form-input" name="f_name" id="first_name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-input" name="l_name" id="last_name" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-icon">
                                <label for="address">Address</label>
                                <input type="text" class="form-input" name="address" id="address" />
                            </div>
                            <div class="form-group">
                                <label for="card_details">Card Details</label>
                                <input type="text" class="form-input" name="card_details" id="card_details" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Purchase"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <h2><a href = "index.php"> Log Out </a><h2>
</html>