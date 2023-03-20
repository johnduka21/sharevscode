<?php
include_once ('dbh.php');

if(isset($_POST['department'])){
$department = $_POST['department'];
$sql = mysqli_query("INSERT into tbl_name(department) values('$department')");
}
?>