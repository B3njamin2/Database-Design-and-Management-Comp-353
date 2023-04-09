<?php
// Database credentials
$host = 'zac353.encs.concordia.ca';
$username = 'zac353_4';
$password = 'K1cKAl35';
$dbname = 'zac353_4';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Query
$sql1 = "INSERT INTO Email_Log (receiver, date, sender, body, subject)

SELECT 
  E.email_address,
  CURRENT_DATE As Date,
  facility_name,
 LEFT(CONCAT('Dear Mr./Ms. ', fName,' ', lName, ', you are scheduled to work on ', S.date ,' between ', S.start_time, ' and ', end_time , ' at ' ,facility_name,' ', address , '. All other dates have entry: No Assignment ','. Please be reminded to follow all necessary COVID procedures before coming to work. Thank You, ', 'Email sent to: ', email_address ), 80) As body,
  CONCAT(facility_name, ' Schedule for ', start_date, ' to undetermined') as subject
FROM 
  Schedule S
  NATURAL JOIN (SELECT * FROM WorkAt WHERE end_date is NULL) W  
  NATURAL JOIN (SELECT id as facility_id, name as facility_name, address from Facilities_1) F 
  NATURAL JOIN (SELECT medi_care, fName, lName, email_address  FROM Employees1) E
";
$result = $conn->query($sql1);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

$conn->close();
?>`