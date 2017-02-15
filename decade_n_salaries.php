<?php

//establish connection
include 'common.php';

try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //query being passed to the database
$sql = "CREATE TABLE temp_table
        SELECT emp_no, LEFT(CAST(YEAR(birth_date) 
        AS CHAR(4)), 3) AS birth_decade, first_name, last_name)
        FROM employees;"; 
        
     //prepping results
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

        //echo $numRows;
           
     //print results below 
        if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetch()) {
        echo "Dept no: " . $row["dept_name"]. "Dept Name: " . $row["dept_name"]. "Number of Employees: " . $row["num_emps"] . "<br>";
                }
            echo '</table>';
            }else{
            echo 'No results';
            }
        } 

//error handling
        catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }

$conn = null;
?>