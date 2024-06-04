<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $new_award = $_POST['awards'];
    $date_awarded = $_POST['date_awarded'];

    // Initialize awards
    $current_awards = '';

    // Retrieve current awards for the student
    $query = "SELECT awards FROM records WHERE student_id=? ORDER BY date_awarded DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $current_awards = $row['awards'];
    }
    $stmt->close();

    // Concatenate new award with existing awards
    $updated_awards = !empty($current_awards) ? $current_awards . ', ' . $new_award : $new_award;

    // Insert the new award details into the database
    $insert_query = "INSERT INTO records (student_id, name, awards, date_awarded) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssss", $student_id, $name, $updated_awards, $date_awarded);
    $stmt->execute();
    $stmt->close();

    echo "Award added successfully.";
}

// Retrieve records for display
$records = [];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $query = "SELECT * FROM records WHERE student_id = ? ORDER BY date_awarded DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">;
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>body {
    background-image: url("dashboard.png");
    background-repeat: no-repeat;
    background-size: cover;
    }
</style>
<?php include "navbar2.php";
    ?>
<body>
<div id="formleft">
    <h1>Add Record</h1>
    <form name="form" method="POST" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="awards">Award:</label>
        <input type="text" id="awards" name="awards" required>
        <label for="date_awarded">Date Awarded:</label>
        <input type="date" id="date_awarded" name="date_awarded" required>
        <button id="btn" type="submit" name="submit">Add</button>
    </form>
</div>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Awards</th>
            <th>Date Awarded</th>
        </tr>
        <?php
        if (isset($student_id)) {
            $query = "SELECT * FROM records WHERE student_id = ? ORDER BY date_awarded ASC";
            $stmt = $conn->prepare($query);
            $stmt ->bind_param("s",$student_id);
            $stmt ->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row ['student_id']   . "</td>";
                echo "<td>" . $row ['name'] . "</td>";
                echo "<td>" . $row ['awards'] . "</td>";
                echo "<td>" . $row ['date_awarded'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>