<?php
$logDir = './log';  // Change this to your logs directory

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);  // Ensure the filename is safe
    $filePath = "$logDir/$file";

    if (file_exists($filePath) && substr($file, -4) == '.log') {
        echo "<h1>Viewing Log File: $file</h1>";
        echo '<input type="text" id="search" placeholder="Search...">';
        echo "<table id='logTable' border='1'>
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Level</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>";

        $logContents = file_get_contents($filePath);
        $logEntries = explode(PHP_EOL, $logContents);

        foreach ($logEntries as $entry) {
            if (preg_match('/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3})\s-\s(INFO|ERROR|DEBUG|WARN)\s-\s(.*)/', $entry, $matches)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($matches[1]) . "</td>";
                echo "<td>" . htmlspecialchars($matches[2]) . "</td>";
                echo "<td>" . htmlspecialchars($matches[3]) . "</td>";
                echo "</tr>";
            }
        }

        echo "</tbody></table>";
    } else {
        echo "Invalid log file.";
    }
} else {
    echo "No log file specified.";
}
?>
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#logTable tbody tr');
        rows.forEach(row => {
            let rowText = row.textContent.toLowerCase();
            if (rowText.indexOf(searchValue) === -1) {
                row.style.display = 'none';
            } else {
                row.style.display = '';
            }
        });
    });
</script>
