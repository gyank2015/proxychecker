<html>
<body>
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

<b> Due to multiple complaints by higher authorities, this resource has been discontinued. </b>
<br><br>
 <i> “Coming back to where you started is not the same as never leaving.” -Terry Pratchett </i> 

</body>
</html>
