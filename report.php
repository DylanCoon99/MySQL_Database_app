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
    $sql = 'SELECT H.hid, H.price, L.address, L.zip_code, H.bedroom_num
	    FROM houses H, locations L
	    WHERE H.hid = L.hid
	    ORDER BY price, bedroom_num DESC';
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
            <h2>Houses on the Market Sorted by Price and Number of Bedrooms</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
		    <tr>
			<th>Listing Number</th>
                        <th>Price</th>
			<th>Address</th>
			<th>Zip Code</th>
			<th>Bedrooms</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
			    <td><?php echo htmlspecialchars($row['hid']); ?></td>
			    <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['zip_code']); ?></td>
			    <td><?php echo htmlspecialchars($row['bedroom_num']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br>
		<br><br><br>
    </body>
</div>
</html>
