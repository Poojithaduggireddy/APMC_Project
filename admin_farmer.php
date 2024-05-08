<!DOCTYPE html>
<html>
<head>
  <title>Groundnut Sample Data</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $(".lock-price").click(function(){
        var farmer_id = $(this).data("farmer_id");
        var price = $("#price_" + farmer_id).val();
        $.ajax({
          url: "price_farmer.php",
          method: "POST",
          data: { farmer_id: farmer_id, price: price },
          success: function(response){
            alert(response);
          }
        });
      });
    });
  </script>
</head>
<body>
  <h1>Groundnut Sample Data-APMC Market Samples</h1>
  <?php
    // Database connection (replace with your credentials)
    $conn = new mysqli('localhost','root','','groundnut');
    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ". $conn->connect_error);
    } else {
      $sql = "SELECT * FROM farmer_data WHERE status='approve'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table border=1>";
        echo "<tr><th>Farmer_id</th><th>Farmer_Name</th><th>Village_Name</th><th>Mandal,District Name</th><th>Phone_Number</th><th>Moisture</th><th>Colour</th><th>Weight of Seeds</th><th>Amount of sand/stones</th><th>weight above seive</th><th>weight below seive</th><th>Total_no_bags</th><th>status</th><th>Price</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
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
          echo "<td>" . $row["status"] . "</td>";
          echo "<td><input type='number' id='price_" . $row["farmer_id"] . "' placeholder='Enter Price'></td>";
          echo "<td><button class='lock-price' data-lotid='" . $row["farmer_id"] . "'>Lock Price</button></td>";
          echo "</tr>";
        }
        echo "</table>";
      } else {
        echo "No records found";
      }

      $conn->close();
    }
  ?>
  <button class="btn" onclick="redirectToManager()" style="margin-top: 10px;">Submitted</button>
  <script>
    function redirectToManager() {
        window.location.href = "loginhome.php"; // Replace "apmc_market.html" with the URL of your APMC Market page
    }
</script>
</body>
</html>