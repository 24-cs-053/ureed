<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bank";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = mysqli_real_escape_string($conn, $_POST['name']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
$account_type = mysqli_real_escape_string($conn, $_POST['account_type']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
$account_no = mysqli_real_escape_string($conn, $_POST['account_no']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$balance = mysqli_real_escape_string($conn, $_POST['balance']);

if (empty($name) || empty($age) || empty($address) || empty($branch) || empty($account_type) || empty($email) || empty($cnic) || empty($account_no) || empty($contact) || empty($balance)) {
$message = "error|All fields are required";
} else if ($age < 18) {
$message = "error|Age must be at least 18";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$message = "error|Invalid email format";
} else if (strlen($contact) != 11) {
$message = "error|Contact number must be 11 digits";
} else {
$sql = "INSERT INTO customer (name, age, address, branch, account_type, email, cnic, account_no, contact, balance) VALUES ('$name', '$age', '$address', '$branch', '$account_type', '$email', '$cnic', '$account_no', '$contact', '$balance')";

if ($conn->query($sql) === TRUE) {
$message = "success|Account created successfully";
} else {
$message = "error|Error: " . $conn->error;
}
}

$conn->close();

header("Location: result.php?msg=" . urlencode($message));
exit();
}
?>