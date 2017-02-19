# DB_P2
Project 2 for Databases 

For connecting, you will need to go into common.php and change the login information, such as username and password. Addtionally, you may have to either change the port number for the local host or just remove it.

For user input query entrance form:

This form will be populated from tables and attribute names from the database. The form does NOT support SELECT, GROUP BY, HAVING, ORDER BY clauses or set centric operators such as UNION. However, it does support arbitrary NATURAL JOINS between multiple tables and display join results.
If tables can not be (natural) joined, a simple error message will be printed. No other error checking is done. Note that some of predefined or custom queries may not return any tuples in the database. 
