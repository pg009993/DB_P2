<?php
//establish a connection to the database
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
     //query being passed to the database 
$sql = "SELECT e.emp_no, e.first_name, e.last_name, d.from_date, d.to_date
	   FROM dept_manager AS d JOIN employees AS e ON d.emp_no=e.emp_no
        ORDER BY DATEDIFF(d.from_date, d.to_date);";
        
     //prepping the query and passing it to the databas 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

     
      if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetch()) {
            $allDates = "Manager Number: " . $row["emp_no"] . " First Name: " . $row["first_name"]. " Last Name: " . $row["last_name"]. " Start Date: " . $row["from_date"];
                
            if($row[to_date] == '9999-01-01'){
                echo $allDates . "End Date: " . date("Y-m-d") . "<br>";
                }
            else{ 
                echo $allDates . "End Date: ". $row["to_date"]. "<br>";
            }
            
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



