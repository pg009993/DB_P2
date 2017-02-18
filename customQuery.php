<?php
//establish a connection to the database
include 'common.php';
try {$conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $table1 = $_GET["table1"];
     $table2 = $_GET["table2"];
     
        
     //query being passed to the database 
     $sql = "SELECT * FROM ".$table1 . " NATURAL JOIN ".$table2." LIMIT 100;";
     
    
    //prepping the query and passing it to the database 
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->setFetchMode(PDO::FETCH_NUM);
     $numRows = $stmt->rowCount();
     $numCols = $stmt->columnCount(); //get number of columns

     $fields = array_keys($stmt->fetch(PDO::FETCH_ASSOC)); // fill array with column names



            //printing the results to the datbase 
     if($numRows > 0){ // run if there are rows to be fetched. Otherwise, show no results
        echo '<table>';
        for($z=0;$z<sizeof($fields);$z++){ // add headers for table
            echo '<th>' . $fields[$z] . '</th>';
        }
        while($row = $stmt->fetch()){ // iterate through and put tuples into table
            echo '<tr>'; // beginning of row.
        // output data of each row
            for($i=0;$i<$numCols;$i++){ // putting table data in each row.
                echo '<td>' . $row[$i] . '</td>';
            } // for
            echo '</tr>'; // end of row
        } // while


            echo '</table>'; //
        }
        else{
            echo 'No results';
        }
    } 

    // error handling 
    catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }

$conn = null;
?>