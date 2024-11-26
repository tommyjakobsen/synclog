<?php
$logDir = './logs';  // Change this to your logs directory

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
    echo "Unable to open directory.";
}
?>
