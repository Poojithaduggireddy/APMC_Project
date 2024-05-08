<!DOCTYPE html>
<html>
<head>
  <title>Groundnut Sample Data</title>
</head>
<body>
  <h1>Groundnut Sample Data From APMC Market</h1>
  
  <!-- Buttons for filtering -->
  <button onclick="filterTable('approve')">Approved</button>
  <button onclick="filterTable('deny')">Denied</button>
  <button onclick="filterTable('incomplete')">Incomplete</button>
  <br>

  <?php
    // Database connection (replace with your credentials)
    $conn = new mysqli('localhost','root','','groundnut');
    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ". $conn->connect_error);
    } else {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update status based on form submission
        $farmer_id = $_POST['farmer_id'];
        $status = $_POST['status'];
        $sql_update = "UPDATE farmer_data SET status='$status' WHERE farmer_id=$farmer_id";
        if ($conn->query($sql_update) === TRUE) {
          echo "Status updated successfully";
        } else {
          echo "Error updating status: " . $conn->error;
        }
      }

      // Function to filter the table
      function filterTable($conn, $status) {
        $sql = "SELECT * FROM farmer_data";
        if ($status === 'incomplete') {
          $sql .= " WHERE status IS NULL OR status = ''";
        } else if (!empty($status)) {
          $sql .= " WHERE status='$status'";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<table border=1>";
          echo "<tr><th>Farmer_id</th><th>Farmer_Name</th><th>Village_Name</th><th>Mandal,District Name</th><th>Phone_Number</th><th>Moisture</th><th>Colour</th><th>Weight of Seeds</th><th>Amount of sand/stones</th><th>weight above seive</th><th>weight below seive</th><th>Total_no_bags</th><th>status</th></tr>";
          while($row = $result->fetch_assoc()) {
            echo "<form method='post'>";
            echo "<tr>";
            echo "<td>" . $row["farmer_id"] . "</td>";
            echo "<td>" . $row["farmer_name"] . "</td>";
            echo "<td>" . $row["village_name"] . "</td>";
            echo "<td>" . $row["man_dis"] . "</td>";
            echo "<td>" . $row["phn"] . "</td>";
            echo "<td>" . $row["mos"] . "</td>";
            echo "<td>" . $row["cos"] . "</td>";
            echo "<td>" . $row["wos"] . "</td>";
            echo "<td>" . $row["aos"] . "</td>";
            echo "<td>" . $row["was"] . "</td>";
            echo "<td>" . $row["wbs"] . "</td>";
            echo "<td>" . $row["tnb"] . "</td>";
            echo "<td>";
            echo "<input type='hidden' name='farmer_id' value='" . $row["farmer_id"] . "'>";
            echo "</td>";
            echo "<td>";
            echo "<input type='radio' name='status' value='approve'> Approve";
            echo "<input type='radio' name='status' value='deny'> Deny";
            echo "</td>";
            echo "<td>";
            echo "<input type='submit' value='Submit'>";
            echo "</td>";
            echo "<td>";
            echo $row['status'];
            echo "</td>";
            echo "</tr>";
            echo "</form>";
          }
          echo "</table>";
        } else {
          echo "No records found";
        }
      }

      // Initial display of the table
      if(isset($_POST['filter'])) {
          filterTable($conn, $_POST['filter']);
      } else {
          filterTable($conn, '');
      }

      $conn->close();
    }
  ?>

  <button class="btn" onclick="redirectToManager()" style="margin-top: 10px;">Submitted</button>

  <script>
    // JavaScript function to filter the table by status
    function filterTable(status) {
      var rows = document.getElementsByTagName("tr");
      for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var cells = row.getElementsByTagName("td");
        if (cells.length > 0) {
          var cellStatus = cells[cells.length - 1].innerText.trim(); // Assuming status is in the last column
          if (status === '') {
            row.style.display = ""; // Show all rows if status is empty
          } else if (status === 'incomplete') {
            var isEmpty = cellStatus === '' || cellStatus === 'NULL';
            row.style.display = isEmpty ? "" : "none"; // Show rows with empty status
          } else if (cellStatus === status) {
            row.style.display = ""; // Show rows with matching status
          } else {
            row.style.display = "none"; // Hide rows with non-matching status
          }
        }
      }
    }

    // JavaScript function to redirect
    function redirectToManager() {
      window.location.href = "index.html"; // Replace "index.html" with the URL of your APMC Market page
    }
  </script>
</body>
</html>
