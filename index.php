<?php
// Template Name: test
$wp_upload_dir = wp_upload_dir()['basedir'] . '/rishabh/'; 
$file_path = $wp_upload_dir . "csv/bmp-image-urls.csv"; 
//read file 
$file = fopen($file_path, "r");
$count = 0;
while (!feof($file)) {
    $file_data = fgetcsv($file);
    $count++;
    if ($count == 1) {
        continue; // skip the first row
    } else {
        $url = urldecode($file_data[0]);
    }
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        echo $url . '    ----------    Invalid url<br>';
        // echo 'URL not correct but it is ';
        $name2 = pathinfo($url, PATHINFO_FILENAME);
        echo $name2 . "\n";
        continue;
    } else {
        $name2 = pathinfo($url, PATHINFO_FILENAME);
        // $extension = pathinfo($url, PATHINFO_EXTENSION);
        $extension = 'jpg';
        $name2 = $name2 . "." . $extension;
        if (!file_exists($wp_upload_dir . '/images/' . $name2)) {
            $content = file_get_contents($url);
            file_put_contents($wp_upload_dir . '/images/' . $name2, $content);
        } else {
            echo $url . '<br>';
        }

    }
}
fclose($file);
