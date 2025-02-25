<?php
$type = filter_input(INPUT_POST, 'item_type', FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$msg = null;
$parentDir = Load::getParentDir();
if ($type == 'file' || $type == 'folder') {
    if ($type == 'file') {
        if (!empty($name)) {
            //Kiểm tra file đúng định dạng
            $pattern = '~^[\w\s]+\.[a-z]+$~i';
            if (preg_match($pattern, $name)) {
                Make::create_file($parentDir, $name);

            } else {
                $msg = 'Định dạng file không đúng';
            }
        } else {
            $msg = 'Tên file bắt buộc nhập';
        }
    } else {
        if (!empty($name)) {
            Make::create_Folder($parentDir, $name);
        } else {
            $msg = 'Tên folder bắt buộc nhập';
        }
    }
}


if (!empty($msg)) {
    ?>
    <div class="alert alert-danger text-center">
        <?php echo $msg; ?>
    </div>
    <?php
}else{
    redirect('?path=' . $parentDir);
}

?>