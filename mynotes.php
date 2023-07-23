<?php

session_start();
require_once "database/dbconnection.php";

$query = "SELECT notes.title, notes.text, user.name
FROM notes
JOIN user ON notes.user_id = user.id
WHERE user.id = ?";

$stmt = mysqli_prepare($conn, $query);

if ($stmt === false) {
    die("mysql Error" . mysqli_error($conn));
}
$user_id = $_SESSION['id'];

mysqli_stmt_bind_param($stmt, "s", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// نمایش داده‌ها در یک آرایه
$notes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $notes[] = $row;
}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>My Note - My notes page</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
        <!-- https://fonts.google.com/specimen/Open+Sans -->
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <!-- https://fontawesome.com/ -->
        <link rel="stylesheet" href="css/fullcalendar.min.css">
        <!-- https://fullcalendar.io/ -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- https://getbootstrap.com/ -->
        <link rel="stylesheet" href="css/tooplate.css">
    </head>

    <body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light">
                        <a class="navbar-brand" href="index.php">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                            <h1 class="tm-site-title mb-0">Note</h1>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="writenote.php">Write Note</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <?php
                                if (isset($_SESSION["id"])) {
                                    echo '
                                <li class="nav-item">
                                    <a class="nav-link active nav-link d-flex" href="mynotes.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>My notes</span>
                                    </a>
                                </li>
                                 ';
                                    echo '
                                <li class="nav-item">
                                    <a class="nav-link active nav-link d-flex" href="logout.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                                 
                                      ';
                                } else {
                                    echo '
                                <li class="nav-item">
                                    <a class="nav-link active nav-link d-flex" href="signup.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Sign up</span>
                                    </a>
                                </li>
                                 ';
                                    echo '
                                <li class="nav-item">
                                    <a class="nav-link active nav-link d-flex" href="login.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Login</span>
                                    </a>
                                </li>
                                 
                                      ';
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                    <!-- notes -->
                    //

                    <div class="row tm-content-row tm-mt-big">
                        <?php
                        foreach ($notes as $note){
                            echo '<div class="tm-col tm-col-big">
                        <div class="bg-white tm-block h-100">';

                            echo'<h2 class="tm-block-title">'.$note["title"].'</h2>';
                            echo'<p>'.$note["text"].'</p>';

                            echo '
                        </div>
                    </div>';
                        }
                        ?>
                    </div>;

                    //
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/utils.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/fullcalendar.min.js"></script>
    <!-- https://fullcalendar.io/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            updateChartOptions();
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart
            drawCalendar(); // Calendar

            $(window).resize(function () {
                updateChartOptions();
                updateLineChart();
                updateBarChart();
                reloadPage();
            });
        })
    </script>
    </body>
    </html>
<?php
// بستن اتصال و اتمام Prepared Statement
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>