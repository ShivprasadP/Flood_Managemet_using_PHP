<!DOCTYPE html>
<html>
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
    <title>Service Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .navbar-nav {
            margin-left: 70%;
        }
        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            padding: 10px;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
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
    <div class="form-container">
        <h2>Service Form</h2>
        <form id="serviceForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="owner_name">Owner Name:</label>
                <input type="text" id="owner_name" name="owner_name" required>
            </div>
            <div class="form-group">
                <label for="service_name">Service Name:</label>
                <input type="text" id="service_name" name="service_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="email_id">Email ID:</label>
                <input type="email" id="email_id" name="email_id" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="photo">Choose file:</label>
                <input type="file" id="photo" name="photo" onchange="displayImg(this,$(this))">
            </div>
            <div class="form-group d-flex justify-content-center">
							<img src="<?php echo isset($avatar) ? '../assets/uploads/'.$avatar :'' ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
						</div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("serviceForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            // You can use Fetch API or XMLHttpRequest to send the form data to the server
            // Replace "your_php_script.php" with the URL of your PHP script that handles form submission
            fetch("services_submit.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(message => {
                alert(message);
                form.reset(); // Optional: Clear the form after successful submission
            })
            .catch(error => console.error("Error:", error));
        });

        function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    </script>
</body>
</html>