<!--

If you are reading this and want to contribute to the atrocius design , please feel free to contact me (Vistaar Juneja) through
Facebook at https://www.facebook.com/vistaar.juneja 

-->



<!DOCTYPE html>
<html lang="en">
<head>
	<style>

	#hits {
		color: red;
		
	}


	</style>

	<title>Proxy Checker</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">

  <!-- <link rel="stylesheet" href="AdminLTE/css/AdminLTE.min.css"> -->
  <!-- <link rel="stylesheet" href="AdminLTE/css/skins/_all-skins.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/jquery-ui.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>

<div class="row">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="font-size: xx-large"><b>Tired of asking for Proxies?</b></a>
            </div>
        </div>
    </nav>
</div>
<div class="row" style="padding-top: 4%">
</div>

<?php
$handle = fopen("counter.txt","r");
$counter = (int) fread($handle,20);
$counter++;
fclose($handle);
$handle = fopen("counter.txt","w");
if(flock($handle,LOCK_EX)) { 	
	fwrite($handle,$counter);
	flock($handle,LOCK_UN);
}
fclose($handle);
?>

<?php

  $myfile = "working_proxies.txt";
  $lines = file($myfile);
  $cnt = count($lines);
 
?>

<br> ----Running local system scans every 2 minutes---- 
<br>
<br> ----Running full system scan every 24 hours----
<br>
<br>
The list of recommended proxies changes every 2 minutes to ensure proper traffic distribution. <br>
<br> <b> For 24/7 access, put 172.16.114.121 as a proxy exception in your browser! </b> <br> 
<br> Top recommended Proxies: <br><br> 

<?php
if($cnt==0)
{
	echo "No open proxies available right now!" . "<br><br>";
}
if($cnt>=1)
{
  echo "1) " . $lines[0] . "<br><br>";
}

if($cnt>=2)
{
  echo "2) " . $lines[1] . "<br><br>" ;
}


?>

<?php

include_once 'dbconnect.php';
$query = "SELECT * from information";

$run = mysqli_query($conn,$query);
$val =  mysqli_fetch_assoc($run);
$cntr = $val['counter'];
$cntr++;
$query = "UPDATE information SET counter=counter+1";
$run = mysqli_query($conn,$query);

?>

 <div id="hits"> Total hits: <?php  echo $cntr; ?></div> 

<div class="row">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-footer">
                <a class="navbar-brand" href="https://docs.google.com/forms/d/e/1FAIpQLSf6E3__fQg2XTO6JiPhrtgjdAT7GcwudYql5HdxJt1We2elQQ/viewform" style="font-size: 15px"><b>  Problems/Feedback? Contact Vistaar Juneja</b></a>
            </div>
        </div>
    </nav>
</div>

</body>

</html>

