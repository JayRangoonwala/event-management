<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
            padding: 15px;
            position: relative;
            z-index: 3;
            width: 100%;
        }

        nav .logo {
            height: 50px;
            width: 200px;
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

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 3; /* Higher z-index for content visibility */
            position: relative;
            text-align: center;
            color: rgb(255, 255, 255);
            margin: 200px 0 105px 0;
        }

        main h1 {
            font-size: 50px;
            background-color: #ffffff78;
            backdrop-filter: blur(5px);
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 30px; /* Space below heading */
        }

        .cta-buttons {
            margin-bottom: 40px; /* Space below buttons */
        }

        .cta-buttons a {
            margin: 0 10px;
            padding: 10px 20px;
            color: white;
            background-color: #f7a101;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-buttons a:hover {
            background-color: #d9900e;
        }

        .info-section {
            z-index: 2;
            margin: 0px 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            margin-top: 50px; /* Space above the info section */
            text-align: center;
        }

        .info-section h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .info-section p {
            margin-bottom: 15px;
            color: #555;
        }

        .info-section img {
            max-height: 50%;
            max-width: 50%;
            border-radius: 10px;
            display: block; /* Center the image block */
            margin: 0 auto; /* Center the image horizontally */
        }

        .carousel-item img {
            display: block; /* Center the images in the carousel */
            margin: 0 auto; /* Center the images horizontally */
            max-height: 500px; /* Set a maximum height for the images */
            object-fit: cover; /* Ensure the images cover the area */
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: transparent; /* Make background transparent */
        }

        .carousel-control-prev{
            margin-left:20%;
        }
        .carousel-control-next{
            margin-right:20%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background: url('./images/arrow-icon.png') no-repeat center; /* Set your button image */
            width: 30px; /* Adjust size as needed */
            height: 30px; /* Adjust size as needed */
            display: inline-block; /* Keep it inline */
            background-color: #090808;
        }

        footer {
            background-color: rgb(6, 18, 247);
            color: #f7a101;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            position: relative;
            z-index: 3;
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
        p{
            font-size : 18px
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
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="hostevent2.php">Host Event</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="register1.php">Register</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        
        <main>
            <h1>Welcome to Eventify</h1>
            <p>Your one-stop platform for discovering and organizing amazing events.</p>
            <div class="cta-buttons">
                <a href="event-details.php">Explore Events</a>
                <a href="hostevent2.php">Host Event</a>
                <a href="myevents.php">My Events</a>
            </div>
        </main>

        <div class="info-section">
            <h2>About Eventify</h2>
            <p>Eventify is designed to simplify the process of organizing and attending events. Whether you are a host looking to promote your event or an attendee searching for exciting activities, Eventify has got you covered!</p>
            <p>Join our community of event enthusiasts and never miss out on the latest happenings around you!</p>
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./images/bg-3.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./images/bg-2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./images/bg-1.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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
