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
$sql1 = "
    DROP TRIGGER IF EXISTS  infection_schedule; 
";

$result1 = $conn->query($sql1);

// Check for errors
if (!$result1) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

$sql2 = "
INSERT INTO Schedule (facility_id, medi_care, start_time, end_time, date)

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
    WHERE w.end_date IS NULL);
    ";
$result2 = $conn->query($sql2);

// Check for errors
if (!$result2) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

$sql3 = "
DELETE FROM Schedule 
WHERE (medi_care, date) IN (
    SELECT medi_care, S2.date
    FROM (
        SELECT I.medi_care, MAX(date_infected) as df 
        FROM Infections I 
        WHERE type ='COVID-19' OR type ='SARS-Cov-2' 
        GROUP BY I.medi_care
    ) s 
    NATURAL JOIN (
        SELECT * 
        FROM Schedule
    ) S2 
    WHERE s.df >= DATE_SUB(S2.date, INTERVAL 2 WEEK)
);
";

$result3 = $conn->query($sql3);

// Check for errors
if (!$result3) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}


$sql4 = "
    delimiter //
";

$result4 = $conn->query($sql4);

// Check for errors
if (!$result4) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

$sql5 = "
create trigger infection_schedule
before insert on Schedule
for each row
begin
IF((SELECT df FROM (SELECT  medi_care, MAX(date_infected) as df FROM Infections WHERE type ='COVID-19' OR type ='SARS-Cov-2' GROUP BY medi_care) s WHERE medi_care = NEW.medi_care) >= DATE_SUB(NEW.date, INTERVAL 2 WEEK))
THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='This employee can not be schedule for 2 weeks after their recent infection';
end if;
end; //
";

$result5 = $conn->query($sql5);

// Check for errors
if (!$result5) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

$sql6 = "
    delimiter //
";

$result6 = $conn->query($sql6);

// Check for errors
if (!$result6) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo "Affected rows: " . mysqli_affected_rows($conn);
}

// Close connection
$conn->close();
?>
