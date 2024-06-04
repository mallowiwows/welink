<?php
    include "connection.php";
if(isset($_POST['submit'])){
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Student Records</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
    background-image: url("dashboard.png");
    background-repeat: no-repeat;
    background-size: cover;
    }
    table{
 position: absolute;
 z-index: 2;
 top: 50%;
 left: 50%;
 transform: translate(-50%,-50%);
 width: 60%; 
 border-collapse: collapse;
 border-spacing: 0;
 box-shadow: 0 2px 15px rgba(64,64,64,.7);
 border-radius: 12px 12px 0 0;
 overflow: hidden;
}
</style>
<body>
<?php include "navbar3.php";
    ?>
    <ul1>
  <li><button id="sidebutton" onclick="location.href='gwelcome.php'">
    <img src="home.png" height="30px" width="40px"/></button></li>
  <li><button id="sidebutton" onclick="location.href='attendance.php'">
    <img src="attendance.png" height="30px" width="40px"/></button></li>
    <li><button id="sidebutton" onclick="location.href='records.php'">
    <img src="achievements.png" height="30px" width="40px"/></button></li>
    <li><button id="sidebutton" onclick="location.href='payment.php'">
    <img src="payment.png" height="30px" width="40px"/></button></li>
</ul1>
<div id ="form">
    <h3>Student Records</h3>
    <form name="form" method="GET" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <button id="btn" type="submit">Search</button>
    </form>
</div>

    <?php
    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
        $sql ="select * from records where student_id ='$student_id'";
        $result = mysqli_query($conn, $sql);
      
        if(mysqli_num_rows($result)>0){
            echo "<table border='3'>";
            echo "<tr><th>Name</th><th>Awards</th><th>Date Awarded</th></tr>";
            
            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>", $row["name"],"</td>";
                echo "<td>", $row["awards"],"</td>";
                echo "<td>", $row["date_awarded"],"</td>";
                echo "</tr>";
            }
            echo"<table";
        } else{
            echo "No records found for STUDENT ID: "; htmlspecialchars($student_id);
        }
    }
    ?>
        </body>
        </html>