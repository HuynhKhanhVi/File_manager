<?php
//dirname() được sử dụng để trả về thư mục cha của một đường dẫn đã cho
$parentDir = dirname(Load::getParentDir());
$load = new Load($parentDir);
$path = filter_input(INPUT_GET, 'path', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!empty($path)) {
    $filename = $load->getFilename($path);
    echo '<h3> File: "' . $filename . '"</h3>';

    echo '<p>Full Path: ' . $load->getPath($filename) . '</p>';

    echo '<p>File Size: ' . $load->getSize($filename) . '</p>';
    echo '<p>Mime type: ' . $load->getFiletype($filename) . '</p>';
    echo '<ul class="list-unstyled d-flex gap-2">
<li><a href="?module=download_file&path=' . $load->getPath($filename) . '"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</a></li>
<li><a target="_blank" href="' . $load->getPath($filename) . '"><i class="fa fa-external-link" aria-hidden="true"></i> Open</a></li>
<li><a href="#" onclick="event.preventDefault(); window.history.back();"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a></li>
</ul>';

}
?>