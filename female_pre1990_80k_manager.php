<?php
//establish a connection 
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


     //query going to the database 
$sql = "SELECT DISTINCT e.first_name, e.last_name, e.emp_no
        FROM employees e, salaries s, dept_manager d 
        WHERE e.emp_no=s.emp_no
        AND d.emp_no=e.emp_no 
        AND s.salary > 80000
        AND e.gender = 'F'
        AND d.to_date < CURDATE();";
        
     //prepping results, passing query to database 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

            //results being printed
        if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetch()) {
        echo "First name: " . $row["first_name"]. " Last name: " . $row["last_name"]. " Employee number: " . $row["emp_no"] . "<br>";
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