<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Note - Write note page</title>

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

        <div class="row tm-mt-big">
            <div class="col-12 mx-auto tm-login-col">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon text-center"></i>
                            <h2 class="tm-block-title mt-3">Sign up</h2>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <?php
                            if (isset($_SESSION["id"])) {
                                echo '
                            <form action="database/dbnote.php" method="post"
                                  class="tm-login-form">
                                <div class="input-group mt-3">
                                    <label for="title"
                                           class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Title</label>
                                    <input name="title" type="text"
                                           class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"
                                           id="username" placeholder="title" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="text"
                                           class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Text</label>
                                    <textarea class="form-control" name="text" rows="5" spellcheck="false" required>
                                    </textarea>
                                </div>
                                <div class="input-group mt-3">
                                    <button type="submit" class="btn btn-primary d-inline-block mx-auto">submit
                                    </button>
                                </div>
                            </form>
                            <div class="input-group mt-3">
                                <p><em>Back to<a href="index.php"> Home </a>page</em></p>
                            </div>
                                 ';
                            } else {
                                echo '
                            <div class="input-group mt-3">
                                <p><em>Have account? <a href="login.php"> Login </a> please</em></p>
                            </div>
                            <div class="input-group mt-3">
                                <p><em>No? create account, go to<a href="signup.php"> Sign up </a>page</em></p>
                            </div>
                            <div class="input-group mt-3">
                                <p><em>Back to<a href="index.php"> Home </a>page</em></p>
                            </div>
                                 ';

                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo '<p>Please complete inputs</p>';
    } elseif ($_GET['error'] == "stmtfailed") {
        echo '<p>Please try again</p>';
    } elseif ($_GET['error'] == "none") {
        echo '<p>You Writed note successfully</p>';
    }


}

?>


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