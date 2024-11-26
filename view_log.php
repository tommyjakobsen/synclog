<?php
$logDir = './log';  // Change this to your logs directory

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);  // Ensure the filename is safe
    $filePath = "$logDir/$file";

    if (file_exists($filePath) && substr($file, -4) == '.log') {
        echo "<h1>Viewing Log File: $file</h1>";
        echo "<pre>";

        $logContents = file_get_contents($filePath);
        $logEntries = explode(PHP_EOL, $logContents);

        foreach ($logEntries as $entry) {
            if (preg_match('/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3})\s-\s(INFO|ERROR|DEBUG|WARN)\s-\s(.*)/', $entry, $matches)) {
                echo "Timestamp: " . htmlspecialchars($matches[1]) . "<br>";
                echo "Level: " . htmlspecialchars($matches[2]) . "<br>";
                echo "Message: " . htmlspecialchars($matches[3]) . "<br><br>";
            }
        }

        echo "</pre>";
    } else {
        echo "Invalid log file.";
    }
} else {
    echo "No log file specified.";
}
?>
