<!-- The landing page, very limited, can only login or register -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>TsarBucks Home</title>
  <script src="https://use.fontawesome.com/4f50358355.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
</head>
<body>
  <div class="container">
    <!-- NavBar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php"></a><i class="fa fa-star fa-2x" aria-hidden="true"></i>Tsarbucks</a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registration.php"></i> Register</a>
        </li>
      </ul>
    </nav>

  <!-- Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="display-1 text-center">Home</h1>
    </div>
  </div>

  <!-- Buttons -->
  <div class="row">
    <div class="col-lg-12 text-center">
      <a href="login.php" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
      <a href="registration.php" class="btn btn-info">Register</a>
    </div>

  </div>




</div>
</body>
</html>
