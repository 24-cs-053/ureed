<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bank";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customer ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Records</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar">
<div class="nav-container">
<h1 class="logo">BankHub</h1>
<ul class="nav-links">
<li><a href="home.html">Home</a></li>
<li><a href="register.html">Open Account</a></li>
<li><a href="display.php" class="active">View Records</a></li>
</ul>
</div>
</nav>
<div class="full-container">
<h2>All Customer Records</h2>
<?php
if ($result->num_rows > 0) {
echo "<table class='data-table'>";
echo "<thead>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Age</th>";
echo "<th>Address</th>";
echo "<th>Branch</th>";
echo "<th>Account Type</th>";
echo "<th>Email</th>";
echo "<th>CNIC</th>";
echo "<th>Account No</th>";
echo "<th>Contact</th>";
echo "<th>Balance</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['age'] . "</td>";
echo "<td>" . $row['address'] . "</td>";
echo "<td>" . $row['branch'] . "</td>";
echo "<td>" . $row['account_type'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['cnic'] . "</td>";
echo "<td>" . $row['account_no'] . "</td>";
echo "<td>" . $row['contact'] . "</td>";
echo "<td>Rs. " . number_format($row['balance'], 2) . "</td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
} else {
echo "<p class='no-data'>No customer records found</p>";
}
$conn->close();
?>
</div>
</body>
</html>