<?php
session_start();
require 'conn.php';

if (isset($_SESSION["login"])) {
	header("Location: dashboard.php");
	exit();
} elseif (isset($_POST['login'])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	if (empty($username) || empty($password)) {
		header("Location: login.php");
		exit();
	} else {
		$query  = "SELECT * FROM admin WHERE username=?";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($row = $result->fetch_assoc()) {
			$pwdCheck = password_verify($password, $row['password']);
			if ($pwdCheck == false) {
				$_SESSION["loginError"] = "Login failed!";
				$_SESSION["loginError-username"] = "$username";
				header("Location: login.php");
				exit();
			} else if ($pwdCheck == true) {
				$_SESSION["login"] = true;
				$_SESSION["login"] = true;

				$_SESSION['admin-name'] = $row['name'];
				$_SESSION['admin-username'] = $row['username'];

				header("location: dashboard.php");
				exit();
			}
		} else {
			$_SESSION["loginError"] = "Login failed!";
			$_SESSION["loginError-username"] = "$username";
			header("Location: login.php");
			exit();
		}
	}
	$stmt->close();
	$mysqli->close();
} else {
	header("Location: index.php");
	exit();
}
