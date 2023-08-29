<?php 
    $orcl = '
        (DESCRIPTION = 
        (ADDRESS= (PROTOCOL= TCP)(HOST = DESKTOP-6MFKTR6)(PORT = 1521))
        (CONNECT_DATA = 
            (SERVER = DEDICATED)
            (SERVICE_NAME = XEPDB1)
        )
        )';
    $conn = oci_connect("hr", "hr", $orcl);

    if ($conn) {
        echo "Connection successful.<br>";

        // Perform a SELECT query
        $query = "SELECT * FROM jobs";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        // Fetch and display results
        while ($row = oci_fetch_assoc($stmt)) {
            echo "Job ID: " . $row['JOB_ID'] . ", Job Title: " . $row['JOB_TITLE'] . "<br>";
        }

        oci_free_statement($stmt); // Free the statement resources
        oci_close($conn); // Close the connection when done.
    } else {
        $e = oci_error(); // Get the error information.
        echo "Connection failed: " . $e['message'];
    }
	
	
	$query = "SELECT name FROM v\$database";
	$stmt = oci_parse($conn, $query);
	oci_execute($stmt);

	while ($row = oci_fetch_assoc($stmt)) {
		echo "Database Name: " . $row['NAME'] . "<br>";
	}

	oci_free_statement($stmt);
	oci_close($conn);


?>
