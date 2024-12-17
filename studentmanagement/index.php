<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <main class="container bg-light p-2 mt-5 rounded-3">
    <div class="row p-4">
      <div class="col-lg-6">
        <form action="" method="post" class="d-flex flex-column gap-3">
          <input type="text" class="form-control" name="name" id="name" placeholder="Enter student name">
          <input type="number" class="form-control" name="roll" id="roll" placeholder="Roll Number">
          <select id="course" name="course" class="form-control">
            <option value="">Select Course</option>
            <option value="bca">BCA</option>
            <option value="bsc">B.Sc</option>
            <option value="bcom">B.Com</option>
            <option value="ba">B.A</option>
          </select>
          <div>
            <button class="btn btn-primary" name="submit" type="submit">Insert</button>
            <button class="btn btn-info" name="showall" type="submit">Show All</button>
            <button class="btn btn-secondary" name="searchdata" type="submit">Search</button>

          </div>
        </form>
        <?php

        $conn = mysqli_connect("localhost", "root", "", "studentdata");
        if (!$conn) return die("DB not connected");

        // insert new record

        if (isset($_POST['submit'])) {
          $f = 0;

          $name = $_POST['name'];
          $roll = $_POST['roll'];
          $course = $_POST['course'];

          if ($name == null || $roll == null || $course == null){
          echo "Please fill all the fields"; 
          return;
          }

          $checkQuery = "SELECT * FROM student";
          $res = mysqli_query($conn, $checkQuery);

          while ($row = mysqli_fetch_assoc($res))
            if ($row['roll'] == $roll) {
              $f = 1;
              die("Roll number alrady exist");
              break;
            }
          if ($f == 0) {
            $insertQuery = "INSERT INTO student VALUES ('$name',$roll,'$course')";

            if (mysqli_query($conn, $insertQuery)) {
              echo "successfully insert data";
            } else {
              echo "Could not insert data";
            }
          }
        }
        ?>
      </div>
      <div class="col-lg-6">
        <h2 class="text-center">Message Box</h2>
        
      </div>
    </div>
    
  </main>

  <!-- // show all data -->
  <?php
  if (isset($_POST['showall'])) {
    $selectQuery = "SELECT * FROM student";
    $res = mysqli_query($conn, $selectQuery);
    
    echo "<section class='container mt-3'>
        <div class='row'>
          <div class='col-lg-12'>
            <table class='table table-striped table-bordered text-center'>
              <thead>
                <tr>
                  <th scope='col'>Student Name</th>
                  <th scope='col'>Roll</th>
                  <th scope='col'>Course</th>
                  <th scope='col'>Modify</th>
                </tr>
              </thead>";
    while ($row = mysqli_fetch_assoc($res)) {
      echo "
            <tbody>
            <tr>
              <td>$row[name]</td>
              <td>$row[roll]</td>
              <td>$row[course] </td>
              <td>
              <button class='btn btn-warning'>Edit</button>
              <button class='btn btn-danger'>Delete</button>
              </td>
            </tr>
          </tbody>";
    }
    echo "</table> 
     </section>
    </div>
  </div>
    ";
  }

  








  ?>
  <!-- search data  -->
  <?php

  if (isset($_POST['searchdata'])) {
    $roll = $_POST['roll'];
    if ($roll == null) {
      return die("Please fill the roll number");
    }

    $searchQuery = "SELECT * FROM student WHERE roll=$roll";

    $res = mysqli_query($conn, $searchQuery);
    // $r = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) == null) { // mysqli_num_rows($result) --> returns the number of rows based on $r object
      echo "Data not found";
    } else {
      echo "<section class='container mt-3'>
        <div class='row'>
          <div class='col-lg-12'>
            <table class='table table-striped table-bordered text-center'>
              <thead>
                <tr>
                  <th scope='col'>Student Name</th>
                  <th scope='col'>Roll</th>
                  <th scope='col'>Course</th>
                </tr>
              </thead>";
      while ($r = mysqli_fetch_assoc($res)) {
        echo "
            <tbody>
            <tr>
              <td>$r[name]</td>
              <td>$r[roll]</td>
              <td>$r[course]</td>
            </tr>
          </tbody>";
      }
      echo "</table> 
     </section>
    </div>
  </div>
    ";
    }
  }

  ?>

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>