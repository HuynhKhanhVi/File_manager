<?php
$load = new Load();
$parentDir = Load::getParentDir();
$dataScan = $load->scanDir($parentDir);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $old = filter_input(INPUT_POST, 'old', FILTER_SANITIZE_SPECIAL_CHARS);
    Make::rename($parentDir, $old, $name);
    redirect('?path=');
}

?>
<form action="" method="post" id="form-filemanager">
<table id="dataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Name</th>
            <th>Size</th>
            <th>Modified</th>
            <th>Perms</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $load->back();
        if (!empty($dataScan)):
            foreach ($dataScan as $item):
                $path = $load->getPath($item);
                if ($load->isType($path) == 'folder') {
                    $tagetPath = '?path='.urldecode(str_replace(_DATA_DIR . '/', '', $path)) ;

                } else {
                    $tagetPath = '';
                    //$tagetPath = str_replace(_DATA_DIR . '/', '', $path);
                    //$tagetPath = 'view_File.php?path=' . $tagetPath;
                    $tagetPath = '?module=view_file&path=' . str_replace(_DATA_DIR . '/', '', $path);
                }
                $dataTypeArr = [
                    'type' => $load->isType($path),
                    'name' => $item
                ];
                ?>

                <tr>
                    <td><input type="checkbox" class="check-item"></td>
                    <td><a href="<?php echo $tagetPath ?>" style="text-decoration: none; color: black;">
                            <?php echo $load->getTypeIcons($item) . ' ' . $item; ?>
                        </a></td>
                    <td>
                        <?php echo $load->getSize($item, ' KB') ?>
                    </td>
                    <td>
                        <?php echo $load->getTimeModify($item); ?>
                    </td>
                    <td>
                        <?php echo $load->getPermission($item); ?>
                    </td>
                    <td>
                        <?php if ($load->isType($path) == 'file'): ?>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <?php endif; ?>
                        <a href="?module=remove_item&type=action&path=<?php echo $parentDir ?>&filename=<?php echo urlencode($item)?>" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-primary btn-sm edit-action" data-type='<?php echo json_encode($dataTypeArr);  ?>'><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-primary btn-sm get-link" data-link="<?php echo getUrl(urldecode($tagetPath)) ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                        <?php if ($load->isType($path) == 'file'):?>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach;  endif;?>
    </tbody>

</table>
<input type="hidden" name="name" value="">
<input type="hidden" name="old" value="">

</form>