
<html>

<?php
	
	$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
	$sql = "SELECT stars.stars, admin.uid, products.ID FROM products INNER JOIN stars ON stars.pid=products.ID LEFT JOIN admin on stars.uid = admin.uid GROUP BY products.ID, admin.uid ORDER BY AVG(stars.stars)";
	print_r($pdo->query($sql)->fetchAll());
?>

</html>