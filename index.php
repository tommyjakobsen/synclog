<?php
$logDir = './log';  // Change this to your logs directory

echo "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Log Files</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    h1 {
        color: #4CAF50;
        margin-bottom: 20px;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin: 10px 0;
    }
    a {
        text-decoration: none;
        color: #4CAF50;
        font-weight: bold;
    }
    a:hover {
        text-decoration: underline;
    }
    .container {
        max-width: 800px;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>
<div class='container'>";

if ($handle = opendir($logDir)) {
    echo "<h1>Log Files</h1>";
    echo "<ul>";

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && substr($entry, -4) == '.log') {
            echo "<li><a href='view_log.php?file=" . urlencode($entry) . "'>$entry</a></li>";
        }
    }

    echo "</ul>";
    closedir($handle);
} else {
    echo "<p>Unable to open directory.</p>";
}

echo "</div></body></html>";
?>
