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
        $bkt = $_POST["book_title"];
        $bka = $_POST["book_author"];
        $qua = $_POST["quantity"];

        if(empty($bkt)){
            $errors[] = "Book Title is empty";
        }
        else{
            $b = mysqli_real_escape_string($dbc, trim($bkt));
        }
        if(empty($bka)){
            $errors[] = "Author name is empty";
        }
        else{
            $ba = mysqli_real_escape_string($dbc, trim($bka));
        }
        if(empty($qua)){
            $errors[] = "Quantity is empty";
        }
        else{
            $qu = mysqli_real_escape_string($dbc, trim($qua));
        }
        if(empty($errors)){
            $q = "INSERT INTO bookstore.inventory (book_title, book_author, quantity) VALUES ('$bkt', '$bka', '$qua')";
            $r = @mysqli_query($dbc, $q);
            if($r){
                header("Location: home.php");
            }
            mysqli_close($dbc);
            exit();
        }
        else{
            echo '<h1> Errors </h1>;
            <p class = "error" > The following error(s) occurred: <br>';
        foreach($errors as $msg){
            echo " - $msg<br>\n";
        }
    }
    session_destroy();
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
                    <h2> Add data to Sell Book or <a href = "buy.php"> Click Here to Buy Book </a> </h2>
                    <form method="POST" id="signup-form" class="signup-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="book_title">Book Title</label>
                                <input type="text" class="form-input" name="book_title" id="book_title" />
                            </div>
                            <div class="form-group">
                                <label for="book_author">Book Author</label>
                                <input type="text" class="form-input" name="book_author" id="book_author" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-icon">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-input" name="quantity" id="quantity" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <h2><a href = "index.php"> Log Out </a><h2>
</html>