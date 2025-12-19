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

            <div id="weekdayTimesTable"></div>

            <h3 class="fw-bold mt-4">Weekends (Friday – Saturday)</h3>
            <div id="weekendTimesTable"></div>

            <hr class="my-5">



            <h3 class="fw-bold">Open Restaurants – Weekdays</h3>

            <div id="weekdayRestaurantsTable"></div>


            <h3 class="fw-bold mt-4">Open Restaurants – Weekends</h3>
            <div id="weekendRestaurantsTable"></div>




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

            <script>

                let weekdayTimes = [
                    ["Breakfast", "6:00 AM – 9:00 AM"],
                    ["Lunch", "12:00 PM – 3:00 PM"],
                    ["Dinner", "7:00 PM – 9:00 PM"]

                ];

                let weekendTimes = [
                    ["Breakfast", "8:00 AM – 10:00 AM"],
                    ["Lunch", "1:00 PM – 3:00 PM"],
                    ["Dinner", "7:00 PM – 9:00 PM"]
                ];


                let weekdayRestaurants = [
                    "Complex 1 Restaurant",
                    "Complex 2 Central Restaurant",
                    "Complex 3 Central Restaurant",
                    "Complex 4 Central Restaurant",
                    "Complex 5 Restaurant"
                ];


                let weekendRestaurants = [

                    "Complex 1 Restaurant",
                    "Complex 2 Central Restaurant",
                    "Complex 3 Central Restaurant"
                ];

                function generateTable(id, data, hasTime) {
                    
                    let html = `<table class='table table-bordered table-striped w-75 mx-auto'>
                                    <thead class='table-dark'><tr>`;

                    html += hasTime ? "<th>Meal</th><th>Time</th>" : "<th>Restaurant</th>";
                    html += "</tr></thead><tbody>";


                    for (let i = 0; i < data.length; i++) {
                        html += "<tr>";

                        if (hasTime) {
                            html += `<td>${data[i][0]}</td><td>${data[i][1]}</td>`;

                        } 
                        
                        else {
                            html += `<td>${data[i]}</td>`;
                        }


                        html += "</tr>";


                    }



                    html += "</tbody></table>";
                    document.getElementById(id).innerHTML = html;



                }

                generateTable("weekdayTimesTable", weekdayTimes, true);
                generateTable("weekendTimesTable", weekendTimes, true);
                generateTable("weekdayRestaurantsTable", weekdayRestaurants, false);
                generateTable("weekendRestaurantsTable", weekendRestaurants, false);


                function toggleTables() {
                    let tables = document.getElementById("tablesSection");

                    tables.style.display = (tables.style.display === "none") ? "block" : "none";


                }




            </script>



        </section>



    </body>




</html>




