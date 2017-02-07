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

$sql = "SELECT d1.dept_no, d1.dept_name
       	FROM departments d1
	WHERE num_emps = MIN(num_emps) IN (
	      SELECT COUNT (DISTINCT e.emp_no) AS num_emps, d.dept_no, d.dept_name
       	      FROM departments d2, dept_emp e
	      GROUP BY d.dept_no);"

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Dept no: " . $row["dept_no"]. " - Name: " . $row["dept_name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

>