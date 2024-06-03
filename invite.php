<?php
include 'db_conn.php'; // Include your database connection file

if (isset($_POST['send_email'])) {
    // Retrieve data from the employee table
    $sql = "SELECT name, email, shiftTimings FROM employee";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through each row of the result set
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $email = $row['email'];
            $shiftTimings = $row['shiftTimings'];
            
            // Compose the email message
            $subject = 'Shift Timings Notification';
            $message = "Hello $name,\n\nYour shift timings for today are: $shiftTimings.\n\nRegards,\nYour Company";

            // Send the email
            if (mail($email, $subject, $message)) {
                echo "Email sent successfully to $email<br>";
            } else {
                echo "Failed to send email to $email<br>";
            }
        }
    } else {
        echo "No records found in the employee table";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Email</title>
</head>
<body>
    <h2>Send Email to All Users</h2>
    <form action="" method="post">
        <button type="submit" name="send_email">Send Email</button>
    </form>
</body>
</html>
