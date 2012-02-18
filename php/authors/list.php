<?php

require("../db.inc.php");

if (isset($_REQUEST["query"])) {
	$query = mysql_real_escape_string($_REQUEST["query"]);
}

$sql = "SELECT authors.*, COUNT(books.book_id) as 'books' FROM authors LEFT JOIN books ON books.author_id = authors.author_id "; 
if (isset($query)) {
	$sql .= " WHERE authors.surname LIKE '" . $query . "%'";
}
$sql .= " GROUP BY authors.author_id ORDER BY authors.surname, authors.firstname";

Header("Content-Type: application/json");
$result = mysql_query($sql);
$authors = array();
while($author = mysql_fetch_object($result)) {
	$authors[] = $author;
}

echo json_encode($authors);

