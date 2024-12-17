<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['username'])) {
    header("location:login1.php");
}
$username = $_SESSION['username'];
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $description = mysqli_real_escape_string($connect, $description);

    $sql = "INSERT INTO `event` (username, title, description, date, category, location) 
            VALUES ('$username', '$title', '$description', '$date','$category', '$location')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header('location:hostevent2.php');
    } else {
        die(mysqli_error($connect));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host an Event - Eventify</title>
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
            background: rgba(0, 0, 0, 0.5);
            /* Dark overlay */
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
            margin-top: 80px;
            /* Below navbar */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            z-index: 3;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 16px;
            margin-top: 10px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #3b82f6;
            border-radius: 5px;
            font-size: 16px;
        }

        select{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #3b82f6;
            border-radius: 5px;
            font-size: 16px;
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
            margin-top: 15px;
            width: 100%;
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

        .event-list {
    margin-top: 20px;
    width: 800px;
    max-width: 800px; /* Adjust width for two items per row */
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next line */
    justify-content: space-between; /* Spread the items evenly */
}

.event-item {
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 10px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    flex-basis: calc(48% - 20px); /* Each item takes 50% of the width minus margin */
    margin-bottom: 20px; /* Add some space below the items */
    text-align: left;
    box-sizing: border-box; /* Ensure padding doesn't affect width */
}

@media (max-width: 768px) {
    .event-item {
        flex-basis: 100%; /* Make each event take full width on smaller screens */
    }
}

        /* .event-item p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
} */

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
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="register1.php">Register</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <main class="content">
            <div class="form-container">
                <h1>Host an Event</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
                    Host Event
                </button>
            </div>

            <!-- Event List -->
            <h2>Hosted Events</h2>

            <div class="event-list" id="eventList">
                <!-- Event items will be appended here -->
                
                <?php

                    $sql = "SELECT * FROM `event` WHERE username = '$username'";
                    $result = mysqli_query($connect, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            $short_description = (strlen($row['description']) > 60) ? substr($row['description'], 0, 60) . "..." : $row['description'];
                            
                            echo '
                                <div class="event-item">
                                <h3 style="text-align:center;">'.$row['title'].'</h3>
                                <p><strong>Date: </strong>'.$row['date'].'</p>
                                <p><strong>Location: </strong>'.$row['location'].'</p>
                                <p><strong>Category: </strong>'.$row['category'].'</p>
                                <p><strong>Description: </strong>'.$short_description.'</p>
                                <a href="indi-event-details.php?event_id='.$row['id'].'">Read more</a>
                                </div>';
                        }
                    } else {
                        die(mysqli_error($connect));
                    }
                ?>
                </div>
            </div>
        </main>

        <!-- Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Create Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="eventForm" action="hostevent2.php" method="post">
                            <label for="event-title">Event Title</label>
                            <input type="text" id="event-title" name="title" required>

                            <label for="event-date">Event Date</label>
                            <input type="date" id="event-date" name="date" required>

                            <label for="category">Choose a Category:</label>

                            <select id="category" name="category" required>
                                <option value="">--- Choose a Category ---</option>
                                <option value="Education">Education</option>
                                <option value="Social">Social</option>
                                <option value="Personal">Personal</option>
                                <option value="Sports">Sports</option>
                                <option value="Music">Music</option>
                                <option value="Bussiness">Bussiness</option>\
                                <option value="Other">Other</option>
                            </select>

                            <label for="event-location">Location</label>
                            <input type="text" id="event-location" name="location" required>

                            <label for="event-description">Description</label>
                            <textarea id="event-description" name="description" rows="4" required></textarea>

                            <button type="submit" class="btn btn-primary">Host Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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