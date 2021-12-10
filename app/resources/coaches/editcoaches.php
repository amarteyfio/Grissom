<?php

require_once '../../database/dbfunctions.php';

//Initialize the session
session_start();
 
// Check if the user is already logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: ../../../login.php");
    exit;
}
?>

<?php
if (isset($_GET['edit_id'])) {
	$id = $_GET['edit_id'];
	

  $coach = selectOne('coaches',['id' => $id]);
  
	
}

?>











<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    

    

    <!-- Bootstrap core CSS -->
<link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../../../assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Grissom Academy</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="../../../logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../../Index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../students.php">
              <span data-feather="users"></span>
              Students
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../coaches.php">
              <span data-feather="users"></span>
              Coaches
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=".../../../sports.php">
              <span data-feather="bar-chart-2"></span>
              Sports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../sections.php">
              <span data-feather="layers"></span>
              Sections
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../events.php">
              <span data-feather="file-text"></span>
              Events
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
      </div>

     

      <h2>Edit Coach Details</h2>
      <div class="form">
        <form class = 'add-student' method="POST" enctype="multipart/form-data" action="">
        <p>
          Name  
        </p>
        <input type="text" name="name" class="text-input" placeholder="Enter Full Name Here" value = "<?php echo $coach['name']?>">
        <br>
        <br>
        
        <p>Age</p>
        <input type="text" name="age" class="text-input" placeholder="Enter Age" value = "<?php echo $coach['age']?>">
        <br>
        <br>
        <p>Email</p>
        <input type="text" name="email" class="text-input" placeholder="0000-00-00" value="<?php echo $coach['email']?>">
        <br>
        <br>
        <p>Gender</p>
        <label for="gender">Choose a Gender:</label>
        <select name="gender" id="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
        <br>
        <br>
        <p>Section</p>
        <label for="Sections">Select a Section:</label>
            <select name = 'section' id="section">
            <option value="1">Under 15s</option>
            <option value="2">Under 18s</option>
            </select>
            <br>
            <br>

        <p>Sport</p>
        <label for="Sport">Select a Sport:</label>
        <select name ='sport' id="sport">
            <option value="1">Football</option>
            <option value="2">BasketBall</option>
            <option value="3">VolleyBall</option>
        </select>
        <br>
        <br>
        <button class = "btn btn-sm btn-outline-secondary" name = 'addstudent'>Edit</button>

        </form>
      </div>
    </main>
  </div>
</div>


<?php
        if(isset($_POST['addstudent'])){
            
        
            //write query 
            $name= $_POST['name'];
            $age= $_POST['age'];
            $email= $_POST['email'];
            $gender= $_POST['gender'];
            $section= $_POST['section'];
            $sport= $_POST['sport'];
            $sql = "UPDATE coaches SET name = '$name', age = '$age', email = '$email', gender = '$gender', section_id = '$section' , sport_id = '$sport'
            WHERE id = $id";

            
            
            //execute query
            if (mysqli_query($db, $sql)) {
                echo "Changes Made:";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
            

            
        }
    ?>







    

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../../../assets/JS/dashboard.js"></script>
  </body>
</html>
