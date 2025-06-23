<?php

include __DIR__."/../config/config.php";
include_once __DIR__."/../functions/bot.php";

// --- Database Connection with SSL and Port 14986 for Aiven ---
$conn = mysqli_init();
$conn->ssl_set(NULL, NULL, "/etc/ssl/certs/ca.pem", NULL, NULL);
$conn->real_connect(
    $config['db']['hostname'],   // Host
    $config['db']['username'],   // Username
    $config['db']['password'],   // Password
    $config['db']['database'],   // Database
    14986,                       // Port for Aiven
    NULL,
    MYSQLI_CLIENT_SSL
);

if ($conn->connect_errno) {
    // Notify admin and log if connection fails
    bot('sendmessage',[
        'chat_id'=>$config['adminID'],
        'text'=>"<b>🛑 DB connection Failed!\n\n".json_encode($config['db'])."</b>",
        'parse_mode'=>'html'
    ]);
    logsummary("<b>🛑 DB connection Failed!\n\n".json_encode($config['db'])."</b>");
    die("Database connection failed: " . $conn->connect_error);
}

// --- You can add any additional database-related functions below ---

?>
