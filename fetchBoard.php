<?php


require 'connectdatabase.php';

if(!isset($_GET['page']))
{
	die('You Scripted Kiddie ;)');
}

$page=(intval(mysqli_real_escape_string($con, $_GET['page']))-1)*20;

$query="SELECT `id`, `name`, `score`, `prevquesattempted` FROM `users` ORDER BY `prevquesattempted` DESC,  `lastmodified` ASC, `time` ASC, `score` DESC LIMIT $page, 20";

$results=mysqli_query($con, $query);

$i=$page;

while($row=mysqli_fetch_assoc($results))
{
	$i++;
	$name=$row['name'];
	$score=$row['score'];
	$prevquesattempted=$row['prevquesattempted'];

	echo "<tr>
		<td>$i</td>
		<td>$name</td>
		<td>$score</td>
		<td>$prevquesattempted</td>
	</tr>";
}






?>