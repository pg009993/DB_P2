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

$sql = "CREATE TABLE temp_table
    	SELECT dept_no, COUNT(dept_no) AS num_emps
    	FROM dept_emp
    	GROUP BY dept_no;
	
	"

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
