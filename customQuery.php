<?php
//establish a connection to the database
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $table1 = $_GET["table1"];
     $table2 = $_GET["table2"];
     
        
     //query being passed to the database 
     $sql = "SELECT * FROM ".$table1 . " NATURAL JOIN ".$table2." LIMIT 100;";
     
     //$sql2 = "DESCRIBE " .$table1 . " NATURAL JOIN ". $table2 .";";
    
                //prepping the query and passing it to the database 
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->setFetchMode(PDO::FETCH_NUM);
     $numRows = $stmt->rowCount();
     $numCols = $stmt->columnCount();

     $fields = array_keys($stmt->fetch(PDO::FETCH_ASSOC));



            //printing the results to the datbase 
        if($numRows > 0){
            echo '<table>';
            for($z=0;$z<sizeof($fields);$z++){
                echo '<th>' . $fields[$z] . '</th>';
            }
            while($row = $stmt->fetch()){
                echo '<tr>';
            // output data of each row
                for($i=0;$i<$numCols;$i++){
                    echo '<td>' . $row[$i] . '</td>';
                } // for
                echo '</tr>';
            } // while
            
            
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