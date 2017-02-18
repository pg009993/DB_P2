<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Project 2</title>
    <style>
        #tables {
            border-style: solid;
            margin: 5px;
            padding: 5px;
            width: 23%;
            height: 150px;
            display: inline-table;
            position: relative;
            overflow: auto;
            border-radius: 10px;
            background-color: brown;
        }
        #titles {
            font-weight: bold;
            width: 100%;
            background-color: darkcyan;
            text-align: center;
            margin: 1px;
            border-radius: 10px;
        }
        
        #box {
            color: white;
            width: 1600px;
            margin: 0 auto;
        }
        
        body {
            background-color: darkkhaki;
            font-family: monospace;
            font-size: 15px;
        }
        
        #msg {
            text-align: left;
            padding-left: 10px;
            padding-top: 10px;
        }
        
        .buttons{
            text-align: center;
            padding: 2px;
            width: 600px;
            margin-left: 500px;
        }
    </style>
</head>
<body>
<?php
    include 'common.php';
    //make it so that people can type in a dbname on the form page
    $dbname = '';
    
    if(isset($_GET['dbname'])){
        $dbname = $_GET['dbname'];
    } else {
        echo("<p>The provided database name didn't set properly.</p>");
    }
    
    $charset = 'utf8';

    $dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Create connection
    
    try {
        $conn = new PDO($dsn, $username, $password, $opt);
        echo '<p id="msg">Connected successfully to database "' . $dbname .'"</p>';
        echo '<p id="msg">The following tables are in the database.</p>';
    
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='" . $dbname . "'"; 
        $result = $conn->query($sql);

        if (!$result) {
            echo '<p id="msg">DB Error, could not list tables</p>';
            echo '<p id="msg">MySQL Error: ' . mysql_error() . "</p>";
            exit;
        }

        $tableList = array();
        while($row = $result->fetch()){
            array_push($tableList, $row['TABLE_NAME']);
        }

        echo('<div id="box">');
        for($i = 0; $i < sizeof($tableList); $i++){
            $tableContent = array();
            //select all field names from each table in every iteration of the for loop
            $sql2 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = '" . $tableList[$i] . "'";


            $result2 = $conn->query($sql2);

            if (!$result2) {
                echo '<p id="msg">DB Error, could not list tables</p>';
                echo '<p id="msg">MySQL Error: ' . mysql_error() . "</p>";
                exit;
            }

            echo('<div id="tables">');
                array_push($tableContent, '<p id="titles">TABLE_NAME: </p>' . $tableList[$i]);
                array_push($tableContent, '<p id="titles">COLUMNS WITHIN TABLE...</p>');
                while($row = $result2->fetch()){
                    array_push($tableContent, $row['COLUMN_NAME']);
                }

                for($x =0; $x < sizeof($tableContent); $x++){
                    echo $tableContent[$x] . '<br>';
                }
            echo('</div>');
        }
        echo('</div>');
    
    } catch (PDOException $e) {
        echo '<p id="msg"> Connection failed: ' . $e->getMessage() . '</p>';
    }
?>
<br>
<div class="buttons">
    
    <p>A NATURAL JOIN is a JOIN operation that creates an implicit join clause for you based on the common columns in the two tables being joined. Common columns are columns that have the same name in both tables.</p>
    
    <p>Now please type in the names of two tables you would like to join. After you have chosen, all tuples (maximum 100) will be returned from the joined set.</p>
    <form action="customQuery.php" method="get">
        <input type="text" name="table1" id="table1"></input>
        <input type="text" name="table2" id="table2"></input>
        <input type="submit" value="Naturally Join the tables" /> 
    </form>
</div>
<?                                              
    $conn->close();
?>
</body>
</html>