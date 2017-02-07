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

$sql = "SELECT DISTINCT e.first_name, e.last_name, e.emp_no
        FROM employees e, salaries s, dept_manager d
        WHERE e.gener= "'F'"
        AND e.birth_date > '1990-01-01' 
        AND e.emp_no=s.emp_no
        AND s.salray > '80000' 
        AND d.emp_no=e.emp_no 
        AND d.to_date < CURDATE()'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>