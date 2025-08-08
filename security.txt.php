<?php
header("Content-Type: text/plain");
$filename = "security_storage.txt";
if (file_exists($filename)) {
    readfile($filename);
} else {
    echo "No Hardware Ids found.";
}
?>
