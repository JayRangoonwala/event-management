<?php
    include 'connect.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login1.php');
    }

    $username = $_SESSION['username'];
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events - Eventify</title>
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
            margin-top: 80px; /* Below navbar */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            z-index: 3;
        }

        .search-bar {
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px;
        }

        .event-list {
            margin-top: 20px;
            width: 100%;
            max-width: 800px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .event-item {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 15px;
            width: calc(50% - 10px); /* Two items per row */
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        footer {
            background-color: rgb(6, 18, 247);
            color: #f7a101;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
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
                <li><a href="event-details.php">All Events</a></li>
                <li><a href="hostevent2.php">Host Event</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="register1.php">Register</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>My Registered Events</h1>
            <input type="text" class="form-control search-bar" placeholder="Search for an event...">
            <div class="event-list" id="registeredEventList">
                
            <?php
                $sql = "select * from `register` where attendees='$username'";
                $result = mysqli_query($connect,$sql);
            
                if($result){
                    $num = mysqli_num_rows($result);
                    if($num>0){
                        while($event = mysqli_fetch_assoc($result)){
                            $sql = "select * from `event` where id =".$event['eventid'];
                            $result1 = mysqli_query($connect,$sql);
                            
                            if($result1){
                                $event1 = mysqli_fetch_assoc($result1);
                                $short_description = (strlen($event1['description']) > 60) ? substr($event1['description'], 0, 60) . "..." : $event1['description'];
                                echo "<div class='event-item'>
                                <h3>".$event1['title']."</h3>
                                <p><strong>Date:</strong>".$event1['date']."</p>
                                <p><strong>Location:</strong>".$event1['location']."</p>
                                <p><strong>Category:</strong>".$event1['category']."</p>
                                <p><strong>Description:</strong>".$short_description."</p>
                                <a href='indi-event-details1.php?event_id='".$event1['id'].">Read more</a><br><br>
                                </div>";
                            }
                            else{
                                die(mysqli_error($connect));
                            }
                        }
                    }
                    else{
                        echo "<h1>You Have not Register in Any Event !!</h1>";
                    }
                    
                }
            ?>
                
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Eventify. All rights reserved.</p>
        <div class="socials">
            <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.querySelector('.search-bar');
const eventItems = document.querySelectorAll('.event-item');

searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();

    eventItems.forEach(item => {
        const title = item.querySelector('h3').textContent.toLowerCase();
        const location = item.querySelectorAll('p')[1].textContent.toLowerCase();

        if (title.includes(searchTerm) || location.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});

    </script>
</body>

</html>
