<?php
$phone      = $_POST['phone'];
$path       = '../../../../assets/uploads/jquery-upload-file/';
$dir        = $path . $phone;
$output_dir = $dir . '/';

if (isset($_POST['img'])) {
    $fileName = $_POST['img'];
    $fileName = str_replace("..", ".", $fileName); //required. if somebody is trying parent folder files
    $filePath = $output_dir . $fileName;

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    if (count(scandir($dir)) == 2) {
        rmdir($dir);
    }

    echo json_encode("Deleted File " . $fileName);
}
