<?php
//establish connection
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //query going to the database 
$sql = "CREATE TABLE y_table
    	SELECT dept_no, COUNT(dept_no) AS num_emps
    	FROM dept_emp
    	GROUP BY dept_no;
	
	    SELECT *
    	FROM(SELECT d.dept_name, d.dept_no, t.num_emps
    	FROM departments AS d JOIN y_table AS t ON d.dept_no=t.dept_no) AS sub_query
    	ORDER BY num_emps LIMIT 1;
	
	    drop table y_table;";
        
     //prepping the results of the query 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();


     //printing the results
     if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetchAll()) {
        echo "Dept no: " . $row["dept_no"]. "Dept Name: " . $row["dept_name"]. "Number of Employees: " . $row["num_emps"] . "<br>";
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
