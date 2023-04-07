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

// query
$sql1 = "INSERT INTO Schedule (facility_id, medi_care, start_time, end_time, date)

SELECT 
    F.id AS facility_id, 
    E.medi_care, 
    TIME_FORMAT(SEC_TO_TIME(FLOOR(RAND() * 23200) + 20000), '%H:%i') AS start_time, 
    TIME_FORMAT(SEC_TO_TIME(43200 +3200 + FLOOR(RAND() * 40000)), '%H:%i') AS end_time, 
    DATE_ADD( CURRENT_DATE  , INTERVAL FLOOR(RAND() * 24) DAY) AS date
FROM 
    Facilities_1 AS F
    CROSS JOIN Employees1 AS E
WHERE (F.id, E.medi_care) IN (
    SELECT w.facility_id, w.medi_care 
    FROM WorkAt w 
    WHERE w.end_date IS NULL);";
$conn->query($sql1);

// Close connection
$conn->close();
?>
