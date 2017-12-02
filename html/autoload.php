<?php
$folders = Array('controller', 'database', 'exception', 'model', 'treater', 'validation','test');
foreach ($folders as $folder) {
    foreach (glob("$folder/*.php") as $filename) {
        include_once "$filename";
    }
}