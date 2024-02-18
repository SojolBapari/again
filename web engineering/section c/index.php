<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information and Marks</title>
</head>
<body>
    <form action="process_form.php" method="post">
        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name"><br>
        
        <label for="roll">Roll Number:</label>
        <input type="text" id="roll" name="roll"><br>

        <label for="subject1">Subject 1 Marks:</label>
        <input type="number" id="subject1" name="subject1"><br>

        <label for="subject2">Subject 2 Marks:</label>
        <input type="number" id="subject2" name="subject2"><br>

        <label for="subject3">Subject 3 Marks:</label>
        <input type="number" id="subject3" name="subject3"><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>
<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$roll = $_POST['roll'];
$subject1 = $_POST['subject1'];
$subject2 = $_POST['subject2'];
$subject3 = $_POST['subject3'];

// Calculate GPA
$total_marks = $subject1 + $subject2 + $subject3;
$total_subjects = 3;
$gpa = $total_marks / $total_subjects;

// SQL to insert student information into database
$sql = "INSERT INTO student_marks (name, roll, subject1, subject2, subject3, gpa)
VALUES ('$name', '$roll', '$subject1', '$subject2', '$subject3', '$gpa')";

if ($conn->query($sql) === TRUE) {
    header("Location: display_results.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>



<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to fetch student information from database
$sql = "SELECT * FROM student_marks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Student Name: " . $row["name"]. "<br>";
        echo "Roll Number: " . $row["roll"]. "<br>";
        echo "Subject 1 Marks: " . $row["subject1"]. "<br>";
        echo "Subject 2 Marks: " . $row["subject2"]. "<br>";
        echo "Subject 3 Marks: " . $row["subject3"]. "<br>";
        echo "GPA: " . $row["gpa"]. "<br><br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
