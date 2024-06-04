<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];

    // Retrieve the current outstanding balance
    $query = "SELECT outstanding_balance FROM payment WHERE student_id = ? ORDER BY payment_date DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_balance = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_balance = $row['outstanding_balance'];
    }
    $stmt->close();

    // Calculate the new outstanding balance
    $new_balance = $current_balance - $amount;

    // Insert the new payment details into the database
    $insert_query = "INSERT INTO payment (student_id, amount, payment_date, outstanding_balance) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssd", $student_id, $amount, $payment_date, $new_balance);
    $stmt->execute();
    $stmt->close();

}

// Retrieve payment details for editing
$payment = [];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $query = "SELECT * FROM payment WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $payment = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">;
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>body {
    background-image: url("dashboard.png");
    background-repeat: no-repeat;
    background-size: cover;
    }
</style>
<body>
<?php include "navbar2.php";
    ?>
    <div id="formleft">
    <h1>Edit Payment</h1>
    <form name="form" method="POST" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" value="<?php echo isset($payment['student_id']) ? $payment['student_id'] : ''; ?>" required>
        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" value="<?php echo isset($payment['amount']) ? $payment['amount'] : ''; ?>" required>
        <label for="payment_date">Payment Date:</label>
        <input type="date" id="payment_date" name="payment_date" value="<?php echo isset($payment['payment_date']) ? $payment['payment_date'] : ''; ?>" required>
        <button id="btn" type="submit" name="submit">Update</button>
    </form>
</div>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Outstanding Balance</th>
        </tr>
        <?php
        if (isset($student_id)) {
            $query = "SELECT * FROM payment WHERE student_id = ? ORDER BY payment_date DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payment_date'] . "</td>";
                echo "<td>" . $row['outstanding_balance'] . "</td>";
                echo "</tr>";
            }
            $stmt->close();
        }
        ?>
    </table>
</body>
</html>


