<?php
include_once "connection.php";

$q=$_GET["q"];

$sql="SELECT * FROM `joriz_users` WHERE `id` = '".$q."'";
$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>Guest #</th>
<th>Name</th>
<th>Email</th>
<th>Register Date</th>
</tr>  

";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['registerDate'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?> 