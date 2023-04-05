<?php
// Replace with your MySQL database credentials
$host = 'zac353.encs.concordia.ca';
$username = 'zac353_4';
$password = 'K1cKAl35';
$dbname = 'zac353_4';

// Start or resume the session
if (empty(session_id()) && !headers_sent()) {
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

echo "<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get the textarea elements
    var textarea1 = document.getElementById('query');
    var textarea2 = document.getElementById('query_input');
  
    // Load the saved values from local storage, if any
    if (localStorage.getItem('savedText1')) {
      textarea1.value = localStorage.getItem('savedText1');
    }
    if (localStorage.getItem('savedText2')) {
      textarea2.value = localStorage.getItem('savedText2');
    }
  
  
  
    var clearButton1 = document.getElementById('clearButton1');
    var clearButton2 = document.getElementById('clearButton2');
  
    var toggleButton = document.getElementById('toggle-Button');
  
    var clearEnabled = false;
  
    // Add click event listener to the toggle button
    toggleButton.addEventListener('click', function () {
      clearEnabled = !clearEnabled; // Toggle the flag
      if (clearEnabled) {
        toggleButton.textContent = 'On'; // Change the text content of the button
        toggleButton.disabled = false; // Enable the clear button
      } else {
        toggleButton.textContent = 'Off'; // Change the text content of the button
        toggleButton.disabled = true; // Disable the clear button
      }
    });
  
    // Save the values to local storage whenever they change
    textarea1.addEventListener('input', function () {
      localStorage.setItem('savedText1', textarea1.value);
    });
    textarea2.addEventListener('input', function () {
      localStorage.setItem('savedText2', textarea2.value);
    });
  
    clearButton1.addEventListener('click', function () {
      if (clearEnabled) {
        textarea1.value = '';
        localStorage.removeItem('savedText1');
      }
    });
  
    clearButton2.addEventListener('click', function () {
      if (clearEnabled) {
        textarea2.value = '';
        localStorage.removeItem('savedText2');
      }
    });
  });
  
</script>"
?>