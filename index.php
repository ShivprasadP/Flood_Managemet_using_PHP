<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
include 'db_connect.php';
ob_start();
if(!isset($_SESSION['system'])){
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}
}
ob_end_flush();

?>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    .navbar-nav {
    margin-left: 70%;
}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand btn btn-info" href="index.php">
          <img src="https://w7.pngwing.com/pngs/326/48/png-transparent-hurricane-katrina-flood-control-manhattan.png" width="60" height="40" alt="">
          Flood Management System
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <?php
            if(isset($_SESSION['login_id']))
              echo "
              <a class='nav-link btn btn-primary me-md-2' href='index.php'>Home</a>
                <a class='nav-link btn btn-primary me-md-2' href='services.php'>Add Services</a>
                <a class='nav-link btn btn-primary me-md-2' href='ajax.php?action=logout'>Logout</a>";
            if(!isset($_SESSION['login_id']))
              echo "<a href='login.php' class='nav-link btn btn-primary me-md-2'>Login</a>
                <a href='new_user.php' class='nav-link btn btn-primary'>Sign Up</a>"; 
          ?>
        </div>
      </div>
    </div>
  </nav>

  <br><br>
  <div class="card-group">
    <div class="card">
      <img src="https://cdn.pixabay.com/photo/2013/06/12/21/31/flood-139000_640.jpg" class="card-img-top" alt="...">
    </div>
    <div class="card">
      <img src="https://media.istockphoto.com/id/1343554481/photo/thailand-flood-climate-change-water-accidents-and-disasters.webp?b=1&s=170667a&w=0&k=20&c=Eal1eYhhL4jLVHbGLUL2874Mp3ySrkaRcCssOuYBrX8=" class="card-img-top" alt="">
    </div>
    <div class="card">
      <img src="https://media.istockphoto.com/id/1327617934/photo/aerial-view-of-flooded-houses-with-dirty-water-of-dnister-river-in-halych-town-western-ukraine.jpg?s=170667a&w=0&k=20&c=BbRD1DuDkT48kA_65_k6_kNO26SKPwQkTiFGSyo2A4s=" class="card-img-top" alt="">
    </div>
  </div>
  
  <br><h3>Services available near to the Ichalkaranji</h3>

    <?php
        // Assuming you have already set up the database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "flood_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve data from the "services" table
        $sql = "SELECT owner_name, service_name, phone_number, email_id, address, photo FROM services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            $cardsInRow = 0;
            while ($row = $result->fetch_assoc()) {
                if($cardsInRow == 0)
                {
                  echo "<div class='row'>";
                }
                echo "<div class='col-md-4'>";
                echo "<div class='card border-dark mx-auto p-2' style='width: 18rem;'>";
                echo "<img src='assets/uploads/"  . $row["photo"] . "' width='100' height='230' class='card-img-top rounded-top'>";
                echo "<p class='card-title'><b>Doner Name: </b>" . $row["owner_name"] . "</p>";
                echo "<p class='card-title'><b>Services: </b>" . $row["service_name"] . "</p>";
                echo "<p class='card-text'><b>Phone Number: </b>" . $row["phone_number"] . "</p>";
                echo "<p class='card-text'><b>Email ID: </b>" . $row["email_id"] . "</p>";
                echo "<p class='card-text'><b>Address: </b>" . $row["address"] . "</p>";
                echo "<div class='card-body'><a href='tel:". $row["phone_number"] . "' class='card-link'><i class='fa-solid fa-phone'></i></a>
                <a href='http://maps.google.com/maps?q=". $row["address"] . "' class='card-link'><i class='fa-solid fa-location-dot'></i></a>
              </div>";
                echo "</div></div>";

                $cardsInRow++;

                if($cardsInRow == 3)
                {
                  echo "</div><br>";
                  $cardsInRow = 0;
                }
            }
            if($cardsInRow>0)
            {
              echo "</div>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>