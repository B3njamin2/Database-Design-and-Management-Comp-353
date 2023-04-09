<?php
//Values to use to connect to the db
$host = 'zac353.encs.concordia.ca';
$username = 'zac353_4';
$password = 'K1cKAl35';
$dbname = 'zac353_4';

//Checks if a session is already taking place. If not, starts a session.
if (empty(session_id()) && !headers_sent()) {
    session_start();
}

//Checking if a custom query has been posted.
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    //Setting up a connection to the database.
    $connection = new mysqli($host, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("The connection failed");
    }

    //Pulling the query and storing it.
    $result = $connection->query($query);

    //If statement will check if the query has run successfully.
    if ($result) {
        //checking if the query is a select query
        if (stripos(trim($query), "select") === 0) {
            //Getting the number of columns in the table and setting up the output.
            $output = "<h2>Query Results</h2>";
            $nbrofColumns = mysqli_num_fields($result);
            $output .= "<table>";
            $output .= "<tr>";

            //fetching the column name and setting up the table
            for ($i = 0; $i < $nbrofColumns; $i++) {
                $output .= "<th>" . mysqli_fetch_field_direct($result, $i)->name . "</th>";
            }
            $output .= "</tr>";

            //fetching the row and inserting the value
            while ($row = mysqli_fetch_row($result)) {
                $output .= "<tr>";
                for ($i = 0; $i < $nbrofColumns; $i++) {
                    $output .= "<td>" . $row[$i] . "</td>";
                }
                $output .= "</tr>";
            }
            $output .= "</table>";
        } else { //if it is not a select query, then we do not need to display a table.
            $output = "<p>Successful query</p>";
        }
    } else {
        $output = "<p>There has been an error, error code is : " . mysqli_error($connection) . "</p>";
    }

    //Adds it to the output history
    $_SESSION['query_output'][] = "<details><summary>Custom Query: $query</summary>$output</details>";

    //Closing the connection to the db
    $connection->close();
} else if (isset($_POST['submit'])) { // Checking if a query other than select has been run.
    $query = $_POST['query'];

    //Setting up a connection to the database.
    $connection = new mysqli($host, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed");
    }

    // Execute the query
    $result = $connection->query($query);

    //Since we expect only an insert/create or delete, we know the query is successfull if it returns true.
    if ($result) {
        $output = "<p>Successful query</p>";
    } else {
        $output = "<p>There has been an error, error code is : " . mysqli_error($connection) . "</p>";
    }

    //Adds it to the output history
    $_SESSION['query_output'][] = "<details><summary>Insert/Create/Delete Query: $query</summary>$output</details>";

    //Closing the connection to the db
    $connection->close();
}

// Clear session
if (isset($_POST['clear_session'])) {
    session_unset();
    session_destroy();
}
