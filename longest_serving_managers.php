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

$sql = "SELECT e.emp_no, e.first_name, e.last_name, d.from_date, d.to_date
    	FROM dept_manager AS d JOIN employees AS e ON d.emp_no=e.emp_no
     	ORDER BY DATEDIFF(d.from_date, d.to_date);"

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Manager Number: " . $row["emp_no"]. "First Name: " . $row["first_name"]. "Last Name: " . $row["last_name"]. "Start Date: " . $row["from_date]. "End Date: ". $row["to_date"]. <br>";
    }
} 
else {
    echo "0 results";
}

$conn->close();

?>
