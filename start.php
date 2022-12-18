<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'dmc6637';
$password = 'cmpsc431-mysql-root';
$host = 'localhost';
$dbname = 'dmc6637_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT H.hid, H.price, H.style, H.bedroom_num, L.address, L.lot_size_acres, C.garage_num, C.materials, C.basement, W.water_source, A.heating, A.air_conditioning, E.extra_item 
	    FROM houses H, locations L, water W, construction C, appliances A, extras E
	    WHERE H.hid = L.hid AND H.hid = C.hid AND L.area_type = W.area_type AND H.hid = A.hid AND H.hid = E.hid';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Houses on the Market Project</title>
    </head>
    <body>
        <div id="container">
            <h2>Houses on the Market</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
		    <tr>
			<th>Listing Number</th>
                        <th>Price</th>
			<th>Style</th>
			<th>Bedrooms</th>
			<th>Address</th>
			<th>Lot Size (in acres)</th>
			<th>Garages</th>
			<th>Materials</th>
			<th>Basement</th>
			<th>Water Source</th>
			<th>Heating</th>
			<th>Air Conditioning</th>
			<th>Extra</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
			    <td><?php echo htmlspecialchars($row['hid']); ?></td>
			    <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['style']); ?></td>
                            <td><?php echo htmlspecialchars($row['bedroom_num']); ?></td>
			    <td><?php echo htmlspecialchars($row['address']); ?></td>
			    <td><?php echo htmlspecialchars($row['lot_size_acres']); ?></td>
			    <td><?php echo htmlspecialchars($row['garage_num']); ?></td>
			    <td><?php echo htmlspecialchars($row['materials']); ?></td>
			    <td><?php echo htmlspecialchars($row['basement']); ?></td>
			    <td><?php echo htmlspecialchars($row['water_source']); ?></td>
			    <td><?php echo htmlspecialchars($row['heating']); ?></td>
			    <td><?php echo htmlspecialchars($row['air_conditioning']); ?></td>
			    <td><?php echo htmlspecialchars($row['extra_item']); ?></td>
			    <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="hid" value="' . htmlspecialchars($row['hid']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>List a house for sale:</h2>
		<form action="/insert.php" method="post">
			<table>
				<tr><td>Price:</td><td><input type="text" id="price" name="price" value="?"></td></tr>
				<tr><td>Address:</td><td><input type="text" id="address" name="address" value="?"></td></tr>
				<tr><td>Zip Code:</td><td><input type="text" id="zip_code" name="zip_code" value="?"></td></tr>
				<tr><td>Style:</td><td><input type="text" id="style" name="style" value="?"></td></tr>
				<tr><td>Bedrooms:</td><td><input type="text" id="bedroom_num" name="bedroom_num" value="?"></td></tr>
				<tr><td>School District:</td><td><input type="text" id="school_district" name="school_district" value="?"></td></tr>
				<tr><td>Area Type:</td><td><input type="text" id="area_type" name="area_type" value="?"></td></tr>
				<tr><td>Exterior Color:</td><td><input type="text" id="exterior_color" name="exterior_color" value="?"></td></tr>
				<tr><td>Lot Size (in acres):</td><td><input type="text" id="lot_size_acres" name="lot_size_acres" value="?"></td></tr>
				<tr><td>Garages:</td><td><input type="text" id="garage_num" name="garage_num" value="?"></td></tr>
				<tr><td>Materials:</td><td><input type="text" id="materials" name="materials" value="?"></td></tr>	
				<tr><td>Basement:</td><td><input type="text" id="basement" name="basement" value="?"></td></tr>
				<tr><td>Heating:</td><td><input type="text" id="heating" name="heating" value="?"></td></tr>
				<tr><td>Air Conditioning:</td><td><input type="text" id="air_conditioning" name="air_conditioning" value="?"></td></tr>
				<tr><td>Extra:</td><td><input type="text" id="extra_item" name="extra_item" value="?"></td></tr>		
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br><h2>Update a current listing:</h2>
		<form action="/update.php" method="post">
			<table>
				<tr><td>Listing Number:</td><td><input type="text" id="hid" name="hid" value="?"></td></tr>	
				<tr><td>Price:</td><td><input type="text" id="price" name="price" value="?"></td></tr>
				<tr><td>Style:</td><td><input type="text" id="style" name="style" value="?"></td></tr>	
				<tr><td>Exterior Color:</td><td><input type="text" id="exterior_color" name="exterior_color" value="?"></td></tr>		
				<tr><td>Basement:</td><td><input type="text" id="basement" name="basement" value="?"></td></tr>
				<tr><td>Heating:</td><td><input type="text" id="heating" name="heating" value="?"></td></tr>
				<tr><td>Air Conditioning:</td><td><input type="text" id="air_conditioning" name="air_conditioning" value="?"></td></tr>
				<tr><td>Extra:</td><td><input type="text" id="extra_item" name="extra_item" value="?"></td></tr>
			</table>
			<input type="submit" value="UPDATE">	
		</form>
		<br>
		<br>	
		<form action="/report.php" method="post">
			<input type="submit" value="REPORT">	
		</form>		
		<br>
		<br><br><br>
    </body>
</div>
</html>
