<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip_address = $_POST['ip_address'];
    $port = $_POST['port'];
    $username = 'root';
    $password = 'root';
    $connection = @ssh2_connect($ip_address,2222);
    if (!$connection) {
        die('your Port is close');
        
    }

    if (!ssh2_auth_password($connection, $username, $password)) {
        die('Authentication failed');
    }

    $command = "lsof -i :$port";
    $stream = ssh2_exec($connection, $command);
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);

    if (strpos($output, "LISTEN") !== false) {
        $status = "Open";
    } else {
        $status = "close";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check Service Status</title>
</head>
<body>
    <h1>Check Service Status</h1>
    <form method="post" action="index.php">
        <label for="ip_address">IP Address:</label>
        <input type="text" id="ip_address" name="ip_address"><br><br>
        <label for="port">Port:</label>
        <input type="text" id="port" name="port"><br><br>
        <input type="submit" value="Check Status">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<p>your port is now $status</p>";
    }
    ?>
</body>
</html>
