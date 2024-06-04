<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    background-image: url("dashboard.png");
    background-repeat: no-repeat;
    background-size: cover;
    }
    .container {
            margin-left: 13%;
            display: flex;
            border: none;
        }
 
    .box {
            flex: 1;
            margin: 15px;
            padding: 40px;
            background-color: #353F8E;
            border: none;
            border-radius: 40px;
        }
    p{
        color: white;
    }
    p1{
        color:black;
        margin-top: 20px;
        margin-left: 15%;
        font-weight: bold;
        font-size: 20px;
    }
    h1{
        color: white;
        font-size: 40px;
        font-family: sans-serif;
    }
    h5{
        font-weight: normal;
        font-size: 30px;
        color: #162974;
        font-family: Arial, Helvetica, sans-serif;
        margin-left:13%;
    }
</style>
<body>
<?php include "navbar2.php";
    ?>
<div class="sidecontainer">
    <h4>Welcome to <span class="bold">WeLink</span></h4>
    <h5><span class="bold">Making things convenient for you.</span></h5>
    <p1>Dashboard Options</p1>
<ul1>
  <li><button id="sidebutton" onclick="location.href='welcome.php'">
    <img src="home.png" height="30px" width="40px"/></button></li>
  <li><button id="sidebutton" onclick="location.href='admin_attendance.php'">
    <img src="attendance.png" height="30px" width="40px"/></button></li>
    <li><button id="sidebutton" onclick="location.href='admin_record.php'">
    <img src="achievements.png" height="30px" width="40px"/></button></li>
    <li><button id="sidebutton" onclick="location.href='admin_payment.php'">
    <img src="payment.png" height="30px" width="40px"/></button></li>
</ul1>
</div>
<div class="container">
        <div class="box"> <p>Transparent tracking of student attendance, providing reassurance to parents.</p>
        <h1>Student Attendance</h1>
        <button id="explorebutton" onclick="location.href='admin_attendance.php'">Explore</button>
        </div>
        <div class="box"> <p>Track and monitor the academic accomplishments of students in each specific subject area efficiently.</p>
        <h1>Student Records</h1>
        <button id="explorebutton" onclick="location.href='admin_record.php'">Explore</button>
        </div>
        <div class="box"> <p>Provides transparent payment records for guardians, fostering trust and accountability.</p>
        <h1>Payment Record</h1>
        <button id="explorebutton" onclick="location.href='admin_payment.php'">Explore</button>
        </div>
    </div>
</body>
</html>