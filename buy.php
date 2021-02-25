<html>

<head>
    <link rel="stylesheet" href="main.css">
	<title> Book Inventory Management </title>
</head>
	<h1 style="text-align:center"> Book Inventory Management</h1>
	<h2> Select Products Or<a href = "home.php"> Click here to go back </a></h2>
</html>


<?php
require('mysqli_connect.php');

$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(book_id) FROM bookstore.inventory";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.


$q = "SELECT book_title, book_author, quantity FROM bookstore.inventory";
$r = @mysqli_query($dbc, $q); // Run the query.

// Table header:
echo '<table width="60%">
<thead>
<tr>
	<th align="left">Book Title</th>
	<th align="left">Book Author</th>
	<th align="left">Quantity</th>
	<th align="left"><strong>Buy</strong></th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['book_title'] . '</td>
		<td align="left">' . $row['book_author'] . '</td>
		<td align="left">' . $row['quantity'] . '</td>
		<td align="left"><a href="checkout.php">Buy</a></td>
	</tr>
	';
} // End of WHILE loop.

echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {

	echo '<br><p>';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} 

?>


<html>

<head>
    <title> Book Inventory </title>
    <link rel="stylesheet" href="main.css">
</head>
<h2><a href = "index.php"> Log Out </a><h2>

</html>