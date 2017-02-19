<?php

//establish connection
include 'common.php';

try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //query being passed to the database
$sql = "SELECT d.dept_no, 
        SUM(CASE WHEN e.gender='F' THEN 1 END)/COUNT(*) AS ratio, 
        (SUM(CASE WHEN s.emp_no=(CASE WHEN e.gender='F' THEN e.emp_no END) THEN s.salary END)/SUM(CASE WHEN e.gender='F' THEN 1 END)) AS fem_sal,
        (SUM(CASE WHEN s.emp_no=(CASE WHEN e.gender='M' THEN e.emp_no END) THEN s.salary END)/SUM(CASE WHEN e.gender='M' THEN 1 END)) AS male_sal
        FROM employees e, dept_emp d, salaries s           
        WHERE d.emp_no=e.emp_no AND d.emp_no=s.emp_no
        GROUP BY dept_no;"; 
        
     //prepping results
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

           
     //print results below 
        if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetch()) {
       echo "Department Number: " . $row["dept_no"] . " || Ratio: " . $row['ratio'] . " || Average Female Salary: " . $row['fem_sal'] . " || Avergae Male Salary: " . $row['male_sal'] . "<br>";
                }
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