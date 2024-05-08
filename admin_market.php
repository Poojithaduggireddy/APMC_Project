<!DOCTYPE html>
<html>
<head>
  <title>Groundnut Sample Data</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $(".lock-price").click(function(){
        var lotId = $(this).data("lotid");
        var price = $("#price_" + lotId).val();
        $.ajax({
          url: "price_market.php",
          method: "POST",
          data: { lot_id: lotId, price: price },
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
      $sql = "SELECT * FROM samples_data WHERE status='approve'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table border=1>";
        echo "<tr><th>LOTID</th><th>SHOPID</th><th>Moisture</th><th>Color</th><th>Weight</th><th>Sand/Stones</th><th>Weight Above Sieve</th><th>Weight Below Sieve</th><th>Total Bags</th><th>status</th><th>Price</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["lot_id"] . "</td>";
          echo "<td>" . $row["shop_id"] . "</td>";
          echo "<td>" . $row["mos"] . "</td>";
          echo "<td>" . $row["cos"] . "</td>";
          echo "<td>" . $row["wos"] . "</td>";
          echo "<td>" . $row["aos"] . "</td>";
          echo "<td>" . $row["was"] . "</td>"; // Fetch weight above sieve from database
          echo "<td>" . $row["wbs"] . "</td>"; // Fetch weight below sieve from database
          echo "<td>" . $row["tnb"] . "</td>";
          echo "<td>" . $row["status"] . "</td>";
          echo "<td><input type='number' id='price_" . $row["lot_id"] . "' placeholder='Enter Price'></td>";
          echo "<td><button class='lock-price' data-lotid='" . $row["lot_id"] . "'>Lock Price</button></td>";
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