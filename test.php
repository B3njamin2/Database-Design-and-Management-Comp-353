<?php
// Replace with your MySQL database credentials
$host = 'zac353.encs.concordia.ca';
$username = 'zac353_4';
$password = 'K1cKAl35';
$dbname = 'zac353_4';

// Check if a custom query has been submitted
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Connect to the database
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if the query was a select statement
        if (stripos(trim($query), "select") === 0) {
            echo "<h2>Query Results</h2>";

            // Get the number of columns in the result set
            $num_columns = mysqli_num_fields($result);

            // Print the column headers
            echo "<table>";
            echo "<tr>";
            for ($i = 0; $i < $num_columns; $i++) {
                echo "<th>" . mysqli_fetch_field_direct($result, $i)->name . "</th>";
            }
            echo "</tr>";

            // Print the data rows
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                for ($i = 0; $i < $num_columns; $i++) {
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>The query was successful.</p>";
        }
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    $conn->close();

    // Check if an insert, create, or delete query has been submitted
} else if (isset($_POST['submit'])) {
    $query = $_POST['query'];

    // Connect to the database
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        echo "<p>The query was successful.</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<h2>Enter a Custom Query</h2>
<form method="post">
    <label for="query">Query:</label>
    <input type="text" id="query" name="query">
    <input type="submit" value="Submit">
</form>

<h2>Execute an Insert, Create, or Delete Query</h2>
<form method="post">
    <label for="query_input">Query:</label>
    <input type="text" id="query_input" name="query">
    <input type="submit" name="submit" value="Submit">
</form>