<?php
// Database connection
$connection = new mysqli('localhost', 'root', '', 'mydb');
if ($connection->connect_error) {
 die("Connection failed: " . $connection->connect_error);
}
// Fetch student records
$sql = "SELECT id, name, grade FROM students";
$result = $connection->query($sql);
$students = [];
if ($result->num_rows > 0) {
 // Store records in an array
 while ($row = $result->fetch_assoc()) {
 $students[] = $row;
 }
}
// Selection Sort function to sort by 'name'
function selectionSortByName(&$array) {
 $length = count($array);
 for ($i = 0; $i < $length - 1; $i++) {
 $minIndex = $i;
 for ($j = $i + 1; $j < $length; $j++) {
 if (strcasecmp($array[$j]['name'], $array[$minIndex]['name']) < 0) {
 $minIndex = $j;
 }
 }
 // Swap minimum element with the first unsorted element
 $temp = $array[$minIndex];
 $array[$minIndex] = $array[$i];
 $array[$i] = $temp;
 }
}
// Sort students by name
selectionSortByName($students);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Student Records - Sorted by Name</title>
</head>
<body>

 <h2>Sorted Student Records by Name</h2>
 <table border="1" cellpadding="5" cellspacing="0">
 <tr>
 <th>ID</th>
 <th>Name</th>
 <th>Grade</th>
 </tr>
 <?php foreach ($students as $student): ?>
 <tr>
 <td><?php echo $student['id']; ?></td>
 <td><?php echo $student['name']; ?></td>
 <td><?php echo $student['grade']; ?></td>
 </tr>
 <?php endforeach; ?>
 </table>
</body>
</html>
