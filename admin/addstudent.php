<?php
session_start(); //access to user informations through session variables
include "../Partial/dpconnect.php"; // connection with database
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ../login.php");
} 

error_reporting(E_ERROR | E_PARSE);
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/Quiz/css/home.css"> -->
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Control Panel</title>
</head>

<style>

body {
    background-color: rgb(209, 203, 255);
  }

  .main {
    padding: 15px;
    font-family: Arial, Helvetica, sans-serif;
  }


  .sidebar a {
    margin-left: 10px;
    display: block;
    color: white;
    padding-bottom: 10px;
    font-size: 30px;
    text-decoration: none;
  }

  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 200%;
  }

  .content {
    background-color: whitesmoke;
  }





table {
    position: relative;
    /* left: 50%; */
    top: 50%;
    /* transform: translate(-50%, -50%); */
    border-collapse: collapse;
    width: 1200px;
    /* height: 200px; */
    border: 1px solid #bdc3c7;
    box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
    
}

tr {
    transition: all .2s ease-in;
    cursor: pointer;
}

th,
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

#header {
    background-color: #16a085;
    color: #fff;
}

#title {
    background-color: #5A6EA5;
    color: #fff;
}

h1 {
    font-weight: 600;
    text-align: center;
    background-color: #16a085;
    color: #fff;
    padding: 10px 0px;
}

tr:hover {
    background-color: #f5f5f5;
    transform: scale(1.02);
    box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
}
#content-table tbody tr:last-of-type{
    border-bottom: 2x solid #009879;
}

@media only screen and (max-width: 768px) {
    table {
        width: 90%;
    }
}

</style>




<body>

    <!-- body  -->


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="./addstudent.php"><b><font color="#16a085">THE </font><font size="6" color="#5A6EA5"> QUIZ </font></b></a> &nbsp &nbsp -->
            <img style="background-color:white; width: 300px;" src="../img/logo.png" alt="logo">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./add_class.php"><b><button
                                    type="button" class="btn btn-dark">Class</button></b></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./addsubjects.php"><button type="button"
                                class="btn btn-dark">Subjects</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./addquestions.php"><button type="button"
                                class="btn btn-dark">Question Bank</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./addquiz.php"><button type="button"
                                class="btn btn-dark">Quiz</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./addstudent.php"><b><button
                                    type="button" class="btn btn-success">Students</button></b></a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="./result.php"><button type="button"
                                class="btn btn-dark">Results</button></a>
                    </li>



                </ul>



                <form action="../logout.php" class="d-flex">
                    <button class="btn btn-outline-warning" type="submit"><i data-feather="log-out"></i>
                        <font size="2"><b> Logout</b></font>
                    </button>
                </form>
            </div>
        </div>
    </nav>








    <?php


//Alerts

if ($_SESSION['mailStatus']=='Sent') {
?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Username and Password has been sent through Email.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


    <?php
$_SESSION['mailStatus']='Pending';
    
}





//POSTS
?>


    <?php


// Adding Users 
if (isset($_POST['username'])) { 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $class_id = $_POST['class'];


    $sql = "INSERT INTO `users` (`sno`, `username`, `email`, `password`, `test`, `quiz_subject_id`, `class_id`, `role`) VALUES (NULL, '$username', '$email', '', '', '0', '$class_id', '2');";
    $result = mysqli_query($conn, $sql);

    echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> User has been added for : <b><strong><u>'.$username.'</strong></b></u>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';

}



// Editing Users 
if (isset($_POST['ueusername'])) { 
    $username = $_POST['ueusername'];
    $email = $_POST['ueemail'];
    $quiz_subject_id = $_POST['uetest'];
    
    $ssql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $sresult = mysqli_query($conn, $ssql);
    $srow = mysqli_fetch_assoc($sresult);
    $sno = $srow['sno'];

    $isql = "SELECT * FROM `quiz_subjects` WHERE `quiz_subject_id` = '$quiz_subject_id'";
    $iresult = mysqli_query($conn, $isql);
    $irow = mysqli_fetch_assoc($iresult);
    $test = $irow['quiz_subject'];

    $sql = "UPDATE `users` SET `username` = '$username', `email` = '$email', `test` = '$test ', `quiz_subject_id` = '$quiz_subject_id' WHERE `users`.`sno` = '$sno';";
    $result = mysqli_query($conn, $sql);

    echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> User has been edited for : <b><strong><u>'.$username.'</strong></b></u>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';
// echo $username,"<br>", $email,"<br>", $quiz_subject_id,"<br>", $test,"<br>";


}



//  Deleteing the Users
if(isset($_GET['udelete'])){
    $sno = $_GET['udelete'];

    $vsql = "SELECT * FROM `users` where `users`.`sno` = '$sno'";
    $vresult = mysqli_query($conn, $vsql);
    $vrow = mysqli_fetch_assoc($vresult);
    $deleteuser = $vrow['username'];

      $sql = "DELETE FROM `users` WHERE `users`.`sno` = '$sno'";
      $result = mysqli_query($conn, $sql);
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Student has been deleted for: <b><u><strong>'.$deleteuser.'</strong></b></u>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    ';
    
    }




?>


    <!-- MODALS  -->


    <!--Modal for adding Students -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel">Add Student</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Modal form  -->

                    <form action="./addstudent.php" method="post" class="row g-3 needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend"><i data-feather="user"></i></span>
                                <input type="username" class="form-control" id="username" name="username"
                                    aria-describedby="username" required>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend">
                                    <font size="5">@</font>
                                </span>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="email" required>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>

                            <select class="form-control" id="class" name="class" aria-describedby="class" required>
                                <option value="">Select Class</option>
                                <?php
                  $query = "select * from class";
                  $qresult = mysqli_query($conn,$query);
                  while ($qrows = mysqli_fetch_array($qresult)) {
                    ?>
                                <option value="<?php echo $qrows['class_id'];?>">
                                    <?php echo $qrows['class_name'];?></option>
                                <?php
                  }
                  ?>
                            </select>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>




                        

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success">
                                <font size="4">ADD</font>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!--Sending username and password through MAIL -->
    <div class="modal fade" id="emodal" tabindex="-1" aria-labelledby="emodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="emodalLabel">Sent Mail</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Subject Modal form  -->
                    <form action="email.php" method="post" class="row g-3 needs-validation" novalidate>
                        <input type="hidden" class="form-control" id="ename" name="ename" aria-describedby="ename">
                        <input type="hidden" name="eEmail" id="eEmail">
                        <div class="mb-3">
                            <label for="show" class="form-label">Username</label>
                            <input type="name" class="form-control" id="show" name="show" aria-describedby="show"
                                disabled>
                        </div>
                        <input type="hidden" class="form-control" id="eusername" name="eusername"
                            aria-describedby="eusername">
        

                        <div id="emailHelp" class="form-text">This will send an Email of their username and password to
                            the Student.</div>
                        <br>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Sent</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!--For editing user info -->
    <div class="modal fade" id="ueedit" tabindex="-1" aria-labelledby="ueeditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ueditLabel">Edit</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Subject Modal form  -->
                    <form action="./addstudent.php" method="post" class="row g-3">
                        <div class="mb-3">
                            <label for="ueusername" class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend"><i data-feather="user"></i></span>
                                <input type="ueusername" class="form-control" id="ueusername" name="ueusername"
                                    aria-describedby="ueusername">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ueemail" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend">
                                    <font size="5">@</font>
                                </span>
                                <input type="email" class="form-control" id="ueemail" name="ueemail"
                                    aria-describedby="ueemail">

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="uetest" class="form-label">Test</label>

                            <select class="form-control" id="uetest" name="uetest" aria-describedby="uetest" required>
                                <option value="">Select Subject</option>
                                <?php
                  $query = "select * from quiz_subjects";
                  $qresult = mysqli_query($conn,$query);
                  while ($qrows = mysqli_fetch_array($qresult)) {
                    ?>
                                <option value="<?php echo $qrows['quiz_subject_id'];?>">
                                    <?php echo $qrows['quiz_subject'];?></option>
                                <?php
                  }
                  ?>
                            </select>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>

                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary">
                                <font size="4">Edit</font>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>






























    <!--Sidebar Profile  -->
    <div class="main">
        <div class="row">

            <!-- Users  -->
            <div class="col-md-12 mt-1">
                <div class="card mb-3 content">
                    <div class="card-body">
                        <center>
                            <br>
                            <table style="border-radius: 20px 20px 0 0; overflow: hidden; ">
                                <tbody>
                                    <tr id="title">
                                        <th width="85%">
                                            <h2>&nbsp Students</h2>
                                        </th>


                                        <th width="15%">
                                            <button class="add btn btn-success" id="" type="submit"
                                                data-bs-toggle="modal" data-bs-target="#modal">
                                                <font size="4"><i data-feather="user-plus"></i>
                                                <b> ADD</b></font>
                                            </button>
                                        </th>

                                    </tr>
                                </tbody>
                            </table>


                            <font size="2">


                                <table id="content-table" class="content-table">
                                    <thead>
                                        <tr id="header">
                                            <th scope="col">
                                                <center>SR. No.</center>
                                            </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Test</th>           
                                            <th scope="col">Link</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
              include "Partial/dpconnect.php";
              $sql = "SELECT * FROM `users` WHERE `role`=2 ORDER BY `class_id` ASC";
              $result = mysqli_query($conn, $sql);
              $sno = 0;
              while($row = mysqli_fetch_assoc($result)){
                  $sno+=1;
                  $class_id=$row['class_id'];
                  $csql = "SELECT * FROM `class` WHERE `class_id` = '$class_id'";
                  $cresult = mysqli_query($conn, $csql);
                  $crow = mysqli_fetch_assoc($cresult);
                  $class_name= $crow['class_name'];
                  echo "<tr>
                  <th scope='row'><center>$sno</center></th>
                  <td>" . $row['username'] . "</td>
                  <td>" . $row['email'] . "</td>
                  <td>" . $class_name . "</td>

                  <td>" . $row['test'] . "</td>
                  ";
                  echo "
                  
                  
                  <td><button class='mail btn btn-sm btn-success'  type='submit' data-bs-toggle='modal'
                  data-bs-target='#emodal'>Mail</button> </td>

                  <td><button class='ueedit btn btn-sm btn-primary' type='submit' data-bs-toggle='modal'
                  data-bs-target='#ueedit'>Edit</button>
                  <button class='udelete btn btn-sm btn-danger' id='u".$row['sno']."' type='submit'>Delete</button></td>
              </tr>";
              }
?>
                                    </tbody>
                                </table>

                        </center>
                    </div>
                    </font>
                </div>


                
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>





            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

            <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
            </script>

            <script>
            // editing user info 
            uedit = document.getElementsByClassName("ueedit");
            Array.from(uedit).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;
                    ueusername = tr.getElementsByTagName("td")[0].innerText;
                    ueemail = tr.getElementsByTagName("td")[1].innerText;
                    uetest = tr.getElementsByTagName("td")[2].innerText;
                    ueteststatus = tr.getElementsByTagName("td")[3].innerText;

                    document.getElementById("ueusername").value = ueusername;
                    document.getElementById("ueemail").value = ueemail;
                    document.getElementById("uetest").value = uetest;
                    document.getElementById("ueteststatus").value = ueteststatus;



                })
            })



            // editing subject info 
            sedit = document.getElementsByClassName("sedit");
            Array.from(sedit).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;
                    ssubject = tr.getElementsByTagName("td")[0].innerText;
                    stotalquestion = tr.getElementsByTagName("td")[1].innerText;
                    stotalmark = tr.getElementsByTagName("td")[2].innerText;
                    sexam_time = tr.getElementsByTagName("td")[3].innerText;
                    var etime = sexam_time.split(" ");
                    exam_time = etime[0];


                    document.getElementById("ssubject").value = ssubject;
                    document.getElementById("stotalquestion").value = stotalquestion;
                    document.getElementById("stotalmark").value = stotalmark;
                    document.getElementById("sexam_time").value = exam_time;

                    // console.log(exam_time);


                })
            })




            // for mailing the password to the user 
            mails = document.getElementsByClassName("mail");
            Array.from(mails).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;
                    name = tr.getElementsByTagName("td")[0].innerText;
                    username = tr.getElementsByTagName("td")[1].innerText;
                    eusername.value = username;
                    ename.value = name;
                    show.value = username;
                })
            })




            // for deleting Users 
            udeletes = document.getElementsByClassName("udelete");
            Array.from(udeletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    sno = e.target.id.substr(1, );
                    console.log(sno);
                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yess");
                        window.location = `./addstudent.php?udelete=${sno}`;
                    } else {
                        console.log("no");
                    }

                })
            })
            </script>

            <script>
            feather.replace()
            </script>


</body>

</html>