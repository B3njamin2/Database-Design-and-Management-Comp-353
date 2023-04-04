<?php
// Replace with your MySQL database credentials
$host = 'zac353.encs.concordia.ca';
$username = 'zac353_4';
$password = 'K1cKAl35';
$dbname = 'zac353_4';

// Start or resume the session
if( empty(session_id()) && !headers_sent()){
    session_start();
}

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
            $output = "<h2>Query Results</h2>";

            // Get the number of columns in the result set
            $num_columns = mysqli_num_fields($result);

            // Build the table
            $output .= "<table>";
            $output .= "<tr>";
            for ($i = 0; $i < $num_columns; $i++) {
                $output .= "<th>" . mysqli_fetch_field_direct($result, $i)->name . "</th>";
            }
            $output .= "</tr>";
            while ($row = mysqli_fetch_row($result)) {
                $output .= "<tr>";
                for ($i = 0; $i < $num_columns; $i++) {
                    $output .= "<td>" . $row[$i] . "</td>";
                }
                $output .= "</tr>";
            }
            $output .= "</table>";
        } else {
            $output = "<p>The query was successful.</p>";
        }
    } else {
        $output = "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Store the output in a summary tag list
    $_SESSION['query_output'][] = "<details><summary>Custom Query: $query</summary>$output</details>";

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
        $output = "<p>The query was successful.</p>";
    } else {
        $output = "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Store the output in a summary tag list
    $_SESSION['query_output'][] = "<details><summary>Insert/Create/Delete Query: $query</summary>$output</details>";

    // Close the database connection
    $conn->close();
}

// Check if the "Clear Session" button has been pressed

if (isset($_POST['clear_session'])) {
    // Clear the session data
    session_unset();
    session_destroy();
}
?>

