<?php

//Code for connector pulled from http://www.w3schools.com/php/php_mysql_select.asp
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT e.first_name, e.last_name, e.emp_no
        FROM employees e1
	WHERE MAX(DATEDIFF(day, d.from_date, d.to_date) IN (
	      SELECT DISTINCT (*)
              FROM employees e2, dept_manager d
	      WHERE e2.emp_no = d.emp_no);"

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "First Name: " . $row["first_name"]. "Last Name: " . $row["last_name"]. "Manager Number: " . $row["emp_no"]. "<br>";
    }
} 
else {
    echo "0 results";
}

$conn->close();

?>