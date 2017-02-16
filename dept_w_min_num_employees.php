<?php
//establish connection
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //query going to the database 
$sql = "SELECT d.dept_name, d.dept_no, COUNT(e.dept_no) AS num_emps
    	FROM departments AS d JOIN dept_emp AS e ON d.dept_no=e.dept_no
        GROUP BY e.dept_no
    	ORDER BY num_emps LIMIT 1;";
        
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
