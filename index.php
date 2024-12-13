<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Login Dashboard</title>
</head>

<body>

  <?php
  session_start();

  if (!empty($_POST)) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin") {
      $_SESSION['username'] = $username;
      header("location:home.php");
    }
  }


  ?>

  <div class="content d-flex justify-content-center align-items-center h-100 w-100">
        <div class="col-md-5 contents">
          <div class="card shadow rounded">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="mb-4 d-flex flex-column align-items-center">
                    <div class="col-md-6 mb-4">
                      <img src="https://miro.medium.com/v2/resize:fit:4800/format:webp/1*T-P1WsT8iDNMz6Io4mVxLg.png" alt="Image" class="img-fluid">
                    </div>
                    <h1 class="title-header">Login Dashboard</h1>
                  </div>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group first">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group last mb-4">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <input type="submit" value="Log In" class="btn btn-block btn-primary">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>