<html>
<head> 
    <title> Book Inventory Management </title>
</head>
<body>
    <h1 style="text-align:center"> Book Inventory Management</h1>
</body>
</html>


<?php
require('mysqli_connect.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $un = $_POST['username'];
        $pw = $_POST['password'];
        
            $q = "SELECT username FROM bookstore.users WHERE username = '$un' AND password = '$pw' ";
            
            $r = @mysqli_query($dbc, $q);

            if(mysqli_num_rows($r) == 1){
                $row = mysqli_fetch_array($r, MYSQLI_NUM);
                session_start();
                $_SESSION["index"] == true;
                header("Location: home.php");
                exit();
            }
            else{
                echo "<p> Invalid Login Credentials</p>";
            }
    }
?>

<html>
    <head>
        <title> Book Inventory </title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="container">
            <div class="login-content">
                <h2> Please enter your Login Credentials </h2>
                <form method="POST" id="login-form" class="login-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="username" name="username" id="username" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="password" name="password" id="password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
        <br> <br>
        <a href = "signup.php"> Not a Member ? Click here to register. </a>
    </body>
</html>