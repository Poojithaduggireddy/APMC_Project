<?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'groundnut');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        // Select query to retrieve data
        $sql = "SELECT * FROM winners_data";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Name</th><th>Lot ID</th></tr>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["lot_id"];
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
?>
