<?php
//establish a connection to the database
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
     //query being passed to the database 
$sql = "";
    
     //prepping the query and passing it to the database 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

        //echo $numRows;
            //printing the results to the datbase 
        if($numRows > 0){
            // output data of each row  
        while($row = $stmt->fetch()) {
               
                }
            echo '</table>';
            }
    else{
            echo 'No results';
            }
        } 

//error handling 
        catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }

$conn = null;
?>
