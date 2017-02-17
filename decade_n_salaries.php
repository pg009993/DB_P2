<?php

//establish connection
include 'common.php';

try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //query being passed to the database
$sql = "CREATE TABLE sal_sum
SELECT emp_no, SUM(salary) AS salary
FROM salaries
GROUP BY emp_no;

SELECT * FROM (
SELECT d.dept_no, CONCAT(SUBSTR(e.birth_date,1,3),'0') AS decade,
COUNT(e.birth_date) AS num_emps,
TRUNCATE((SUM(s.salary)/COUNT(e.birth_date)),2) AS avg_sal
FROM dept_emp d, employees e, sal_sum s
WHERE d.emp_no=e.emp_no AND d.emp_no=s.emp_no
GROUP BY dept_no, CONCAT(SUBSTR(birth_date,1,3),'0')) AS sub_query
ORDER BY dept_no LIMIT 1;

DROP TABLE sal_sum;"; 
        
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