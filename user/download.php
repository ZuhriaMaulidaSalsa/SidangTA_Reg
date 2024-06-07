<?php
// Pastikan parameter 'url' ada
if (isset($_GET['Url'])) {
    $file = $_GET['Url'];

    // Lokasi file
    $file_path = 'pdfs/' . $file;

    // Periksa apakah file ada
    if (file_exists($file_path)) {
        // Set header untuk tautan unduhan
        header('Content-Description: File Transfer');
        header('Content-Type: Application/Octet-Stream');
        header('Content-Disposition: Attachment; Filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: Must-Revalidate');
        header('Pragma: Public');
        header('Content-Length: ' . filesize($file_path));

        // Baca file dan kirimkan isinya ke output
        readfile($file_path);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
