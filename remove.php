
<?php
session_start();
$servername = "localhost";
$pid = "pid";
$bid = "bid";

// Create connection
//$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
//if (!$conn) {
  //die("Connection failed: " . mysqli_connect_error());
//}

// sql to delete a record
$sql = "DELETE FROM myCart WHERE pid=3";

if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

if(isset($_POST['remove']) AND $_SESSION['picId'] != 0)
        {
            $picToRemove = "../images/profileImages/".$_SESSION['picName'];
            if(!unlink($picToRemove))
            {
                $_SESSION['message'] = "There was an error in deleting the profile picture! Wait for a minute";
                header("Location: ../Login/error.php");
            }
            else
            {
                $_SESSION['message'] = "The profile picture was successfully deleted!";
                $id = $_SESSION['id'];
                $sql = "UPDATE members SET picStatus=0, picExt='png' WHERE id='$id';";
                $_SESSION['picId'] = 0;
                $_SESSION['picExt'] = "png";
                $_SESSION['picName'] = "profile0.png";
                $result = mysqli_query($conn, $sql);

                header("Location: ../profileView.php");
            }
        }
        else
        {
            header("Location: ../profileView.php");
        }
    

function dataFilter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
