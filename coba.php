<!DOCTYPE html>
<html>
<head>
	<title>COBAA</title>
</head>
<body>
<?php
$no = 1;
$date = date('Y-m-d');

for($i=0;$i<1000;$i++){
	echo $no++.'. '.$date.'<br>';
}

?>
</body>
</html>