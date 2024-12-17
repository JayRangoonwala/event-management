<?php
include 'connect.php';
$event_id = $_GET['event_id'];

// Fetch event details
$sql = "SELECT * FROM `event` WHERE id = '$event_id'";
$result = mysqli_query($connect, $sql);
$event = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['title']; ?> - Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f9;
        }

        .background {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image: url('./images/background.png');
            background-size: cover;
            background-position: center;
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

        nav {
            background-color: rgb(6, 18, 247);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 3;
        }

        nav .logo {
            height: 50px;
            width: auto;
        }

        nav ul {
            padding: 0;
            margin: 0;
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

        .content {
            margin-top: 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 2;
            width: 100%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            word-wrap: break-word;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #f7a101;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
            white-space: pre-line; /* Handles line breaks for the description */
        }

        p strong {
            color: #f7a101;
        }

        button {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        button:hover {
            background-color: #2563eb;
        }

        footer {
            background-color: rgb(6, 18, 247);
            color: #f7a101;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            position: relative;
            bottom: 0;
            width: 100%;
            z-index: 1;
        }

        footer p{
           color: #f7a101;
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

    </style>
</head>
<body>
    <div class="background">

        <nav>
            <div>
                <img src="./images/logo.png" class="logo" alt="Eventify Logo">
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="hostevent2.php">Host Event</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="register1.php">Register</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <div class="content">
            
            <h1><?php echo $event['title']; ?></h1>
            <p><strong>Date:</strong> <?php echo $event['date']; ?></p>
            <p><strong>Location:</strong> <?php echo $event['location']; ?></p>
            <p><strong>Category:</strong> <?php echo $event['category']; ?></p>
            <p><strong>Description:</strong> <?php echo nl2br($event['description']); ?></p>
            <form action="event-details.php" method="POST">
                    <input type="hidden" name="event_id" value=<?php echo $event['id']; ?> >
                    <input type="hidden" name="event_title" value=<?php echo $event['title']; ?>>
                    <button type="submit" name="register">Register</button>
                </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Eventify. All rights reserved.</p>
        <div class="socials">
            <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
        </div>
    </footer>
</body>
</html>
