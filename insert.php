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
				echo "Inserting new house: "; 
				$sql_houses = 'INSERT INTO houses (price, style, bedroom_num)';
				$sql_houses = $sql_houses . 'VALUES ("'. $_POST["price"] . '","' . $_POST["style"] . '","' . $_POST["bedroom_num"] .'")';
				
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql_houses);
					$last_id = $conn->lastInsertID();

					$sql_location = 'INSERT INTO locations (hid, address, zip_code, area_type, lot_size_acres, school_district)
							VALUES ("'. $last_id . '","' . $_POST["address"] . '","' . $_POST["zip_code"] . '","' . $_POST["area_type"] 
							. '","' . $_POST["lot_size_acres"] . '","'  . $_POST["school_district"] . '")';

					$conn->exec($sql_location);
					
					$sql_appliances = 'INSERT INTO appliances (hid, heating, air_conditioning)
							VALUES ("'. $last_id . '","' . $_POST["heating"] . '","' . $_POST["air_conditioning"] . '")';

					$conn->exec($sql_appliances);
					
					$sql_construction = 'INSERT INTO construction (hid, exterior_color, materials, garage_num, basement)
							VALUES ("'. $last_id . '","' . $_POST["exterior_color"] . '","' . $_POST["materials"] . '","' . $_POST["garage_num"] 
							. '","' . $_POST["basement"] . '")';
 
					$conn->exec($sql_construction);

					$sql_extras = 'INSERT INTO extras (hid, extra_item)
							VALUES ("'. $last_id . '","' . $_POST["extra_item"]  . '")';


					$conn->exec($sql_extras);	
					echo "New record created successfully";
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
					echo $sql_location . "<br>" . $e->getMessage();
					echo $sql_appliances . "<br>" . $e->getMessage();
					echo $sql_construction . "<br>" . $e->getMessage();
					echo $sql_extras . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
