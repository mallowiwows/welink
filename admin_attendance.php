<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Insert the new attendance into the database
    $insert_query = "INSERT INTO attendance (student_id, name, date, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    if ($stmt) {
        $stmt->bind_param("ssss", $student_id, $name, $date, $status);
        if ($stmt->execute()) {
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Retrieve attendance for display
$attendance = [];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $query = "SELECT * FROM attendance WHERE student_id = ? ORDER BY date DESC";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $attendance[] = $row;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Add Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">;
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
    background-image: url("dashboard.png");
    background-repeat: no-repeat;
    background-size: cover;
    }
</style>
<body>
    <?php include "navbar2.php";
    ?>
<div id="formleft">
    <h1>Add Attendance</h1>
    <form name="form" method="POST" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <button id="btn" type="submit" name="submit">Add</button>
    </form>
</div>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php
        if (isset($student_id)) {
            $query = "SELECT * FROM attendance WHERE student_id = ? ORDER BY date ASC";
            $stmt = $conn->prepare($query);
            $stmt ->bind_param("s",$student_id);
            $stmt ->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row ['student_id']   . "</td>";
                echo "<td>" . $row ['name'] . "</td>";
                echo "<td>" . $row ['status'] . "</td>";
                echo "<td>" . $row ['date'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
