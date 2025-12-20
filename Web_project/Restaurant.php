<!DOCTYPE html>
<html lang="en">


    
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>SQU Student Campus Housing - Restaurant</title>
        <?php include "db.php";
        ?>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


        <style>
            body {
                background-color: rgb(225, 225, 222);
                font-family: Georgia, Times, 'Times New Roman', serif;
                line-height: 1.5;

            }

            .main-footer {
                background-image: url("Images/footer.jpg");
                background-size: cover;

            }



            #restaurant-banner {
                background-image: url("Images/Banner/Restaurant.jpg");
                background-size: cover;
                background-position: center;
                height: 350px;

            }


            .btn-purple {
                background-color: rgb(50, 50, 70);
                color: rgb(225, 225, 222);
                font-weight: bold;
                border: none;


            }

            .btn-purple:hover {
                background-color: rgb(35, 35, 55);
                color: white;


            }

            .title {
                background-color: rgb(50, 50, 70);
                color: rgb(225, 225, 222);

            }

            .menu img {
                width: 100%;
                border-radius: 5px;


            }

            .navbar-nav {
                flex-wrap: wrap;


            }



        </style>


    </head>





    <body>

    
        <section>

            <header class="main-header">
                <nav class="navbar navbar-expand-sm navbar-dark bg-black">

                    <div class="container-fluid">

                        <a class="navbar-brand d-flex align-items-center" href="#">
                            <img src="Images/logo_img/logo.jpg" width="80" class="rounded me-2">

                            <span>SQU Student Campus</span>

                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks">
                            <span class="navbar-toggler-icon"></span>


                        </button>

                        <div class="collapse navbar-collapse" id="navLinks">


                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link active" href="Restaurant.php">Restaurant</a></li>
                                <li class="nav-item"><a class="nav-link" href="Announcements.html">Announcements</a></li>
                                <li class="nav-item"><a class="nav-link" href="Maintenance.php">Maintenance</a></li>
                                <li class="nav-item"><a class="nav-link" href="Locations.html">Locations</a></li>
                                <li class="nav-item"><a class="nav-link" href="Events.html">Events</a></li>
                                <li class="nav-item"><a class="nav-link" href="Questionnaire.php">Questionnaire page</a></li>
                                <li class="nav-item"><a class="nav-link" href="calculate.php">calculate page</a></li>
                                <li class="nav-item"><a class="nav-link" href="funpage.html">Fun page</a></li>
                                <li class="nav-item"><a class="nav-link" href="About us.html">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="Contact Us.php">Contact Us</a></li>
                            </ul>


                        </div>

                    </div>

                </nav>


            </header>


        </section>




        
        <section id="restaurant-banner" class="d-flex justify-content-center align-items-center text-white">
            <div class="text-center bg-black bg-opacity-50 p-4 border border-white border-3">
                <h1 class="fw-bold">Restaurant</h1>


            </div>

        </section>


        <section>

            <h2 class="title text-center p-3">Welcome to the Student Campus Restaurant</h2>

            <div class="container text-center fs-5 mt-3">
                <p>We provide nutritious and delicious meals every day. Explore our menus for breakfast, lunch, and dinner.</p>


            </div>



        </section>






        <section class="container py-4">

            <div class="row menu gy-4 text-center">
                <div class="col-md-3"><a href="WeekDays/Saturday.html"><img src="Images/Restaurant_img/Saturday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Sunday.html"><img src="Images/Restaurant_img/Sunday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Monday.html"><img src="Images/Restaurant_img/Monday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Tuesday.html"><img src="Images/Restaurant_img/Tuesday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Wednesday.html"><img src="Images/Restaurant_img/Wednesday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Thuresday.html"><img src="Images/Restaurant_img/Thursday.jpg"></a></div>
                <div class="col-md-3"><a href="WeekDays/Friday.html"><img src="Images/Restaurant_img/Friday.jpg"></a></div>


            </div>



        </section>

        <section>
            <h2 class="title text-center p-3">Restaurant Working Times & Open Restaurants</h2>


        </section>

        <section class="text-center mt-3">
            <button class="btn btn-purple fw-bold m-3" onclick="toggleTables()">Show/Hide Working Times</button>


        </section>

            
        <section class="container py-4" id="tablesSection">
        
            <h3 class="fw-bold mt-4">Weekdays (Sunday – Thursday)</h3>
            
            <?php

            $sql = "SELECT meals.meal_name, meal_times.start_time, meal_times.end_time
                    FROM meal_times
                    JOIN meals ON meal_times.meal_id = meals.id
                    JOIN days ON meal_times.day_id = days.id
                    
                    WHERE days.day_name IN ('Sunday','Monday','Tuesday','Wednesday','Thursday')";
            
            $result = $conn->query($sql);
            
            echo "<table class='table table-bordered table-striped w-75 mx-auto'>
                    <thead class='table-dark'>
                    
                    <tr><th>Meal</th><th>Time</th></tr>
                    
                    </thead><tbody>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['meal_name']}</td>
                        <td>{$row['start_time']} - {$row['end_time']}</td>
                      </tr>";
                
            }

            echo "</tbody></table>";

            ?>





            <h3 class="fw-bold mt-4">Weekends (Friday – Saturday)</h3>
            
            <?php

            $sql = "SELECT meals.meal_name, meal_times.start_time, meal_times.end_time
                    FROM meal_times
                    JOIN meals ON meal_times.meal_id = meals.id
                    JOIN days ON meal_times.day_id = days.id
                    
                    WHERE days.day_name IN ('Friday','Saturday')";
            
            $result = $conn->query($sql);

            
            echo "<table class='table table-bordered table-striped w-75 mx-auto'>
                    <thead class='table-dark'>
                    <tr><th>Meal</th><th>Time</th></tr>
                    </thead><tbody>";

            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['meal_name']}</td>
                        <td>{$row['start_time']} - {$row['end_time']}</td>
                      </tr>";
                
            }


            echo "</tbody></table>";

            ?>

            
            <hr class="my-5">
            
            <h3 class="fw-bold">Open Restaurants – Weekdays</h3>

            
            <?php
            $sql = "SELECT DISTINCT restaurants.restaurant_name
                    FROM restaurant_availability
                    JOIN restaurants ON restaurant_availability.restaurant_id = restaurants.id
                    JOIN days ON restaurant_availability.day_id = days.id
                    WHERE days.day_name IN ('Sunday','Monday','Tuesday','Wednesday','Thursday')";


            $result = $conn->query($sql);
            
            echo "<table class='table table-bordered table-striped w-75 mx-auto'>
                    <thead class='table-dark'><tr><th>Restaurant</th></tr></thead><tbody>";



            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['restaurant_name']}</td></tr>";
                
            }

            echo "</tbody></table>";


            ?>


            
            <h3 class="fw-bold mt-4">Open Restaurants – Weekends</h3>


            
            <?php

            $sql = "SELECT DISTINCT restaurants.restaurant_name
                    FROM restaurant_availability
                    JOIN restaurants ON restaurant_availability.restaurant_id = restaurants.id
                    JOIN days ON restaurant_availability.day_id = days.id
                    WHERE days.day_name IN ('Friday','Saturday')";
            
            $result = $conn->query($sql);



            echo "<table class='table table-bordered table-striped w-75 mx-auto'>
                    <thead class='table-dark'><tr><th>Restaurant</th></tr></thead><tbody>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['restaurant_name']}</td></tr>";
                
            }

            echo "</tbody></table>";

            ?>





            
        </section>




        
        <section>
            <h2 class="title text-center p-3">Restaurant Feedback</h2>
            <div class="container text-center fs-5">

                <p>If you would like to share your opinion, please fill out the survey below.</p>
                <a href="Survey.php" class="btn btn-purple fw-bold m-3">Click here to take the Survey</a>


            </div>


        </section>

    

        <section>
            <footer class="main-footer text-light text-center p-3">
                <p class="mb-0">© 2025 Student Complex</p>


            </footer>


        </section>

    

        <section>

            


        </section>



    </body>




</html>




