<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("Location: login.php");
    exit;

  
}

var_dump($_SESSION['loggedin']);


require_once 'app/database/dbfunctions.php';

//Table selections
$students = selectAll('students');
$coaches = selectAll('coaches');
$sections = selectAll('sections');
$sports = selectAll('sports');




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
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="assets/css/dashboard.css" rel="stylesheet">
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
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="students.php">
              <span data-feather="users"></span>
              Students
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="coaches.php">
              <span data-feather="users"></span>
              Coaches
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sports.php">
              <span data-feather="bar-chart-2"></span>
              Sports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sections.php">
              <span data-feather="layers"></span>
              Sections
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.php">
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

      <!--Students-->    
      <h2>Students</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm" id = 'stutable'>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Gender</th>
              <th scope="col">DOB</th>
              <th scope="col">Sport</th>
              <th scope="col">Section</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
              <td><?php echo $student['id']; ?></td>
              <td><?php echo $student['name']; ?></td>
              <td><?php echo $student['age']; ?></td>
              <td><?php echo $student['gender']; ?></td>
              <td><?php echo $student['dob']; ?></td>
              <td><?php 
              $sport = selectOne('sports',['sport_id' => $student['sport_id']]);
              echo $sport['sport']; ?></td>
              <td><?php
              $section = selectOne('sections',['section_id' => $student['section_id']]);
              echo $section['section']; ?>
              </td>

            </tr>
            <?php endforeach ; ?>
          </tbody>
        </table>
      </div>
      <br>
      <br>

      <!--Coaches-->
      <h2>Coaches</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Gender</th>
              <th scope="col">email</th>
              <th scope="col">Sport</th>
              <th scope="col">Section</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($coaches as $coach): ?>
            <tr>
              <td><?php echo $coach['id']; ?></td>
              <td><?php echo $coach['name']; ?></td>
              <td><?php echo $coach['age']; ?></td>
              <td><?php echo $coach['gender']; ?></td>
              <td><?php echo $coach['email']; ?></td>
              <td><?php 
              $sport = selectOne('sports',['sport_id' => $coach['sport_id']]);
              echo $sport['sport']; ?></td>
              <td><?php
              $section = selectOne('sections',['section_id' => $coach['section_id']]);
              echo $section['section']; ?>
              </td>

            </tr>
            <?php endforeach ; ?>
          </tbody>
        </table>
      </div>
      <br>
      <br>

    <!--Sports-->
      <h2>Sports</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Section Name</th>
              
            </tr>
          </thead>
          <tbody>
        <?php foreach ($sports as $sport): ?>
            <tr>
              <td><?php echo $sport['sport_id']; ?></td>
              <td><?php echo $sport['sport']; ?></td>
             

            </tr>
            <?php endforeach ; ?>
          </tbody>
        </table>
      </div>
      <br>
      <br>

      <!--Sections-->
      <h2>Section</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Section Name</th>
              
            </tr>
          </thead>
          <tbody>
        <?php foreach ($sections as $section): ?>
            <tr>
              <td><?php echo $section['section_id']; ?></td>
              <td><?php echo $section['section']; ?></td>
             

            </tr>
            <?php endforeach ; ?>
          </tbody>
        </table>
      </div>

    </main>
  </div>
</div>


    <script src="assets/JS/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="assets/JS/dashboard.js"></script>
  </body>
</html>
