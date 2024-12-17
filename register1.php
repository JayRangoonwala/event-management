<?php
$invalid = 0;
$user = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include 'connect.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $sql = "SELECT * FROM `registration` WHERE username = '$username'";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            $user = 1;
        } else {
            if ($password === $cpassword) {
                $sql = "INSERT INTO `registration`(username, email, password) VALUES('$username', '$email', '$password')";
                $result = mysqli_query($connect, $sql);

                if ($result) {
                    header('location:login1.php');
                } else {
                    die(mysqli_error($connect));
                }
            } else {
                $invalid = 1;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .background {
    flex: 1;
    background-image: url('./images/background.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    position: relative;
}

.background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5); /* Dark overlay */
    z-index: 1;
}

nav, footer {
    position: relative;
    z-index: 2;
}



        nav {
            background-color: rgb(6, 18, 247);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            height: 50px;
            width: 200px;
            color: #e2e8f0;
            align-items: center;
            justify-content: center;
        }

        nav ul {
            padding: 0;
            margin: 0;
            margin-right: 20px;
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav a {
            color: #f7a101;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #3b82f6;
        }

        .background {
            flex: 1;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px; /* Adjust for the fixed header height */
            padding-bottom: 20px; /* Add space for the footer */
        }

        section {
            background-color: rgb(248, 246, 246);
            width: 410px;
            padding: 20px;
            border-radius: 40px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #cf7c09;
            font-weight: 500;
            z-index: 1;
            margin-bottom:25px;
        }

        section h1 {
            margin-top: 2px;
            color: #f06c00;
            margin-bottom: 20px;
            font-size: 40px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        form label {
            font-size: 18px;
            color: #cf7c09;
            font-weight: 500;
        }

        form input {
            padding: 5px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            background-color: rgba(103, 93, 93, 0.201);
            color: #000000;
            font-weight: 600;
            justify-content: center;
            text-align: center;
            width: 280px;
        }

        form input::placeholder {
            color: rgba(70, 67, 67, 0.438);
        }

        form button {
            padding: 12px;
            width: 200px;
            background-color: rgba(12, 9, 9, 0.842); /* Register button blue */
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: rgb(255, 255, 255); /* Darker blue hover for the register button */
            color: #000000;
            border: 1px solid black;
        }

        .form-footer {
            margin: 5px 0;
            font-size: 15px;
        }

        .form-footer a {
            font-size: 15px;
            color: #f36f04;
        }


        footer {
            background-color: rgb(6, 18, 247);
            color: #f7a101;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        footer .socials {
            margin-top: 10px;
        }

        footer a {
            color: #f7a101;
            padding: 0 5px;
        }

        footer a:hover {
            text-decoration: underline;
        }
        .alert{
            color : red;
            margin: 0;
            padding: 0;
            font-size: 15px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="background">
        <nav>
            <div>
                <img src="./images/logo.png" class="logo">
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="event-details.php">All Events</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        
        <main>
            <section>
                <h1>Register</h1>
                <form action="register1.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Enter Password" required>
                    <p class="form-footer">Already Have an Account? <a href="login1.php"><strong>Login</strong></a></p>
                    
       <?php 
            if($invalid){
                echo "<p class='alert'>Password And Confirm Password Not Matching !!<p>";
            }
        ?>
        <?php 
            if($user){
                echo "<p class='alert'>Username Already Exist !!<p>";
            }
        ?>

                    <button type="submit">Register</button>
                </form>
            </section>
        </main>

    </div>
    <footer>
        <p>&copy; 2024 Eventify. All rights reserved.</p>
        <div class="socials">
            <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
