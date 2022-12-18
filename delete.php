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
				echo "Deleting house: " . $_POST["hid"] . "..."; 
				$sql_houses = 'DELETE FROM houses WHERE hid = "' . $_POST["hid"] . '"';
				$sql_locations = 'DELETE FROM locations WHERE hid = "' . $_POST["hid"] . '"';
				$sql_construction = 'DELETE FROM construction WHERE hid = "' . $_POST["hid"] . '"';
				$sql_appliances = 'DELETE FROM appliances WHERE hid = "' . $_POST["hid"] . '"';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql_houses);
					$conn->exec($sql_locations);
					$conn->exec($sql_construction);
					$conn->exec($sql_appliances);
					echo "House deleted successfully";
				?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
