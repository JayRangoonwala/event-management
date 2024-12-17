<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        if(!isset($_SESSION['username'])){
            header('location:login1.php');
        }
        include 'connect.php';

        $title = $_POST['event_title'];
        $attendee = $_SESSION['username'];
        $id = $_POST['event_id'];

        $sql = "select * from `register` where eventid = '$id' and attendees='$attendee'";
        $result = mysqli_query($connect,$sql);

        if($result){
            $num = mysqli_num_rows($result);
            if($num>0){
                echo "YOU HAVE ALREADY REGISTERED IN THIS EVENT !!";
            }
            else{
                $sql = "select * from `event` where id = '$id' and title='$title'";
                $result = mysqli_query($connect,$sql);

                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $hostname = $row['username'];

                    if($hostname == $attendee){
                        echo "YOU CAN'T REGISTER IN THIS EVENT !!";
                    }
                    else{
                        $sql = "insert into `register`(eventid,title,hostname,attendees) values('$id','$title','$hostname','$attendee')";
                        $result = mysqli_query($connect,$sql);

                        if($result){
                            echo "YOU HAVE SUCCESSFULLY REGISTER IN THIS EVENT";    
                        }
                        else{
                            die(mysqli_error($connect));                            
                        }
                    }
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
    <title>Event Details - Eventify</title>
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

        .header{
            margin-top:70px;
            z-index = 2;
            color:black;
            font-size:35px;
        }

        /* Search bar styles */
        .search-bar {
            margin-top: 5px; /* Below navbar */
            width: 50%;
            display: flex;
            justify-content: center;
            z-index: 3;
        }

        .search-bar button:hover {
            background-color: #2563eb;
        }

        .content {
            margin-top: 20px; /* Extra spacing from the search bar */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            z-index: 3;
        }

        section {
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            flex: 1 1 calc(33.333% - 40px); /* Ensure 3 sections per row */
            max-width: calc(33.333% - 40px);
            min-width: 325px;
            z-index: 3;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .user,.invalid{
            color:red;
        }
        
        .success{
            color:green;
        }

        p {
            font-size: 16px;
            margin-bottom: 15px;
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
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="hostevent2.php">Host Event</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="register1.php">Register</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <h1 class="header">All EVENTS</h1>
        <!-- Search bar -->
        <input type="text" class="form-control search-bar" placeholder="Search for an event...">

        <main class="content">
        <?php 

    include 'connect.php';

    $sql = "select * from `event`";
    $result = mysqli_query($connect,$sql);
    if($result){
        while ($event = mysqli_fetch_assoc($result)) {
        $short_description = (strlen($event['description']) > 60) ? substr($event['description'], 0, 60) . "..." : $event['description'];
        echo '<section>
            <h1>' . $event['title'] . '</h1>
            <p><strong>Date:</strong> ' . $event['date'] . '</p>
            <p><strong>Location:</strong> ' . $event['location'] . '</p>
            <p><strong>Category:</strong> ' . $event['category'] . '</p>
            <p><strong>Description: </strong>'.$short_description.'</p>
                <a href="indi-event-details1.php?event_id='.$event['id'].' target="_blank"">Read more</a><br><br>   
            <form action="event-details.php" method="POST">
                    <input type="hidden" name="event_id" value="' . $event['id'] . '">
                    <input type="hidden" name="event_title" value="' . $event['title'] . '">
                    <button type="submit" name="register">Register</button>
                </form>
        </section>';
    }
}
else{
    die(mysqli_error($connect));
}
?>
            <!-- Additional sections... -->
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
const eventItems = document.querySelectorAll('section');

searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();

    eventItems.forEach(item => {
        const title = item.querySelector('h1').textContent.toLowerCase();
        const date = item.querySelectorAll('p')[0].textContent.toLowerCase().replace('date: ', '');
        const location = item.querySelectorAll('p')[1].textContent.toLowerCase();
        const category = item.querySelectorAll('p')[2].textContent.toLowerCase();
        const description = item.querySelectorAll('p')[3].textContent.toLowerCase();

        if (title.includes(searchTerm) ||date.includes(searchTerm)|| location.includes(searchTerm) || category.includes(searchTerm) ||description.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});
        
    </script>

</body>

</html>
