<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'dmc6637';
$password = 'cmpsc431-mysql-root';
$host = 'localhost';
$dbname = 'dmc6637_431W';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Updating Listing  " . $_POST["hid"]; 
				$hid              = $_POST["hid"];
				$style            = $_POST["style"];
				$heating          = $_POST["heating"];
				$air_c            = $_POST["air_conditioning"];
				$extra            = $_POST["extra_item"];
				$color            = $_POST["exterior_color"];
				$basement         = $_POST["basement"];


				$sql_houses         = "UPDATE houses SET price =" . $_POST["price"] . "," . "style = " . "'$style'" . " " .  "WHERE `hid` = " . $hid ;
				$sql_appliances     = "UPDATE appliances SET heating =" . "'$heating'" . "," . "air_conditioning = " . "'$air_c'" . " " . "WHERE `hid` = " . $hid;
				$sql_extras         = "UPDATE extras SET extra_item =" . "'$extra'" . " " . "WHERE `hid` = " . $hid;
				$sql_construction   = "UPDATE construction SET exterior_color =" . "'$color'" . "," . "basement = " . "'$basement'" . " " . "WHERE `hid` = " . $hid;

				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql_houses);
					$conn->exec($sql_appliances);
					$conn->exec($sql_extras);
					$conn->exec($sql_construction);

					echo " Updated Listing successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql_houses . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
