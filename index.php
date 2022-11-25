<?php
$insert=false;
$update=false;
$delete = false;
// Connect to the Database 
$servername = "172.31.22.43";
$username = "Dikshant200518046";
$password = "MYDdr20pI5";
$database = "Dikshant200518046";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
};
  
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `profile` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['snoEdit'])){
    $sno = $_POST["snoEdit"];
    $fName = $_POST["fNameEdit"];
    $email = $_POST["emailEdit"];
    $bio = $_POST["bioEdit"];

    // $sql = "UPDATE `profile` SET `fName` = '$fName' ,`email`='$email' ,`bio` = '$bio', WHERE `profile`.`sno` = '$sno'";
  $sql = "UPDATE `profile` SET `fName` = '$fName' , `email` = '$email', `bio` = '$bio' WHERE `profile`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  
  if($result){
    $update = true;
}else{
  echo "we could not update";
}
  }
  else{
 $fName = $_POST['fName'];
 $email = $_POST['email'];
 $bio = $_POST['bio'];
  // Sql query to be executed
  $sql = "INSERT INTO `profile` (`fName`, `email`, `bio`) VALUES ('$fName', '$email', '$bio' )";
  $result = mysqli_query($conn, $sql);

  if($result){
    // echo "The result has been inserted succesfully";
    $insert = true;
  }else{
    echo "The record was not inserted successfully beacuse of this error --->" . mysqli_error($conn);
  }
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->

  <script></script>
    <title>Assignment 3 PHP CRUD</title>

  </head>
  <body>
    <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
edit modal 
</button> -->
<header>
<!-- Modal -->
<?php
include 'header.php';
?>
</header>
<?php
//ceating aletr for insert
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your profile has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }

?>
<?php
//ceating update alert

if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your profile has been updated successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}


?>
<?php
//ceating aletr for delete

if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your profile has been deleted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}


?>
<!-- creating form -->
<div class="container my-4">
  <h3>Manage your profiles</h3>
<form action= "../Assignment_3/index.php?update=true" method="post">
<div class="form-group">
    <label for="fname">Full Name</label>
    <input type="text" class="form-control" id="fname" name="fName">
  </div>
  
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email"  name="email" aria-describedby="emailHelp">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
              <label for="bio">Bio</label>
              <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
            </div> 
            <!-- <div class="modal-footer d-block mr-auto"> -->
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
          <!-- </div>` -->
          <button type="submit" class="btn btn-primary">Add Profile</button>
        </form>
</div>

<div class="container">



<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sno.</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Bio</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <!-- showing up data here -->
  <?php
$sql = "SELECT * FROM `profile`";
$result = mysqli_query($conn,$sql);
$sno=0;
while($row = mysqli_fetch_assoc($result)){
  $sno=$sno+1;
  echo "<tr>
  <th scope='row'>".$sno."</th>
  <td>".$row['fName']."</td>
  <td>".$row['email']."</td>
  <td>".$row['bio']."</td>
  <td> <button class=' edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class=' delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> 
  </td>
</tr>";
  
}



?>
    
  </tbody>
  <button class="btn btn-sm btn-primary">Edit</button>
</table>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>
  <script>
//edit
    edits = document.getElementsByClassName('edit');

    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit" );
        tr = e.target.parentNode.parentNode;
        fName= tr.getElementsByTagName("td")[0].innerText
        email= tr.getElementsByTagName("td")[1].innerText
        bio= tr.getElementsByTagName("td")[2].innerText
        console.log(fName, email, bio)
        fNameEdit.value= fName;
        emailEdit.value=email;
        bioEdit.value=bio;
        $('#editModal').modal('toggle');
        snoEdit.value = e.target.id;
        console.log(e.target.id)


        
      })
    })
    //delete
    deletes = document.getElementsByClassName('delete');

    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        sno= e.target.id.substr(1,)
       if(confirm("press a button!")){
        console.log("yes")
        window.location = `../Assignment_3/index.php?delete=${sno}`;
             }else{
        console.log("no")
       }


        
      })
    })
        
  </script>

    <!-- Site footer -->
    <?php
    include 'footer.php';
    ?>
    
  </body>
</html>
<!-- for refernce i had used bootstarp as well as youtube -->