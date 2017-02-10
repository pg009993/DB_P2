<?php

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE temp_table
        SELECT emp_no, LEFT(CAST(YEAR(birth_date) AS CHAR(4)), 3) AS birth_decade, first_name, last_name)
        FROM employees;
        
        

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Dept no: " . $row["dept_name"]. "Dept Name: " . $row["dept_name"]. "Number of Employees: " . $row["num_emps"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
