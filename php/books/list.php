<?php

require("../db.inc.php");

$sql = 'SELECT books.*, CONCAT(authors.surname, ", ", authors.firstname) AS author FROM books LEFT JOIN authors ON books.author_id = authors.author_id ORDER BY books.title';

Header("Content-Type: application/json");
$result = mysql_query($sql);
$books = array();
while($book = mysql_fetch_object($result)) {
	$books[] = $book;
}

echo json_encode($books);