<?php
require('response.php');
require('dbconnect.php');
if (!isset($_GET['name'])) {
	$response->JSONError('No name is set!');
}
$name = $_GET['name'];
$sql = "SELECT name, multiverseid, type, imageurl FROM mtg_cards WHERE name ILIKE '%".$name."%' LIMIT 50";
$stmt = $pdo->prepare($sql);

if(!$stmt->execute()) {
	$response->JSONError('DB execute failed!');
}

$rows = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$rows[] = [
		'name' => $row['name'],
		'multiverseid' => $row['multiverseid'],
		'type' => $row['type'],
		'imageUrl' => $row['imageurl']	
	];
};

$response->addElement('rows',$rows);

$response->JSONSuccess('User data were fetched successfully!');
?>
