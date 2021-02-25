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
        $errors = [];

        $usr = $_POST["username"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $postalcode = $_POST["postalcode"];

        if(empty($usr)){
            $errors[] =  "Username is empty";
        }
        else{
            $u = mysqli_real_escape_string($dbc, trim($usr));
        }
        if(empty($pass)){
            $errors[] =  "Password is empty";
        }
        else{
            $p = mysqli_real_escape_string($dbc, trim($pass));
        }
        if(empty($email)){
            $errors[] =  "Email is empty";
        }
        else{
            $e = mysqli_real_escape_string($dbc, trim($email));
        }
        if(empty($phone)){
            $errors[] =  "Phone is empty";
        }
        else{
            $ph = mysqli_real_escape_string($dbc, trim($phone));
        }
        if(empty($address)){
            $errors[] =  "Address is empty";
        }
        else{
            $a = mysqli_real_escape_string($dbc, trim($address));
        }
        if(empty($postalcode)){
            $errors[] =  "Postalcode is empty";
        }
        else{
            $pc = mysqli_real_escape_string($dbc, trim($postalcode));
        }
        if(empty($errors)){
            $q = "INSERT INTO bookstore.users (username, password, email, phone, address, postal_code) VALUES ('$usr', '$pass', '$email', '$phone', '$address', '$postalcode')";
            $r = @mysqli_query($dbc, $q);
            if($r){
                 header("Location: index.php");
            }
            mysqli_close($dbc);
            exit();
        }
        else{
            echo '<h1> Error </h1>;
            <p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
    }
    mysqli_close($dbc);
}
    
    
?>

<html>
    <head>
        <title> Book Inventory </title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <h2> Signup Or<a href = "index.php"> Click here to go to login page </a></h2>
    <div class="container">
        <div class="signup-content">
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
        
            <label> Username </label>
            <input type = "text" name = "username" /> <br> <br>
            <label> Password </label>
            <input type = "password" name = "password" /> <br> <br> 
            <label> Email </label>
            <input type = "text" name = "email" /> <br> <br>
            <label> Phone </label>
            <input type = "text" name = "phone" /> <br> <br>
            <label> Address </label>
            <input type = "text" name = "address" /> <br> <br>
            <label> Postal Code </label>
            <input type = "text" name = "postalcode" /> <br> <br>
            <div class="form-group">
            <input type = "submit" name = "submit" value = "Register" />
            </div>
        </form>
        </div>
    </div>
    </body>
</html>