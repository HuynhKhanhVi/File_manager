<?php

class Make
{
    public static function create_file($parentDir, $filename, $data = '')
    {
        $path = _DATA_DIR . '/' . $parentDir . '/' . $filename;
        file_put_contents($path, $data);
    }   

    public static function create_Folder($parentDir, $foldername)
    {
        $path = _DATA_DIR . '/' . $parentDir . '/' . $foldername;
        mkdir($path);
    }

    public static function rename($parentDir, $old, $name)
    {
        $oldPath = _DATA_DIR . '/' . $parentDir . '/' . $old;
        $newPath = _DATA_DIR . '/' . $parentDir . '/' . $name;
        rename($oldPath, $newPath);
    }

    public static function deleteFile($parentDir, $filename)
    {
        $path = _DATA_DIR . '/' . $parentDir . '/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }

    public static function deleteFolder($parentDir, $name)
    {
        $path = _DATA_DIR . $parentDir . '/' . $name;
        //kiem tra folder ton tai hay ko
        if (is_dir($path)) {
            $load = new Load();
            $dataArr = $load->scanDir($parentDir . '/' . $name);
            if (!empty($dataArr)) {
                foreach ($dataArr as $item) {
                    $pathChildren = $parentDir . '/' . $name . '/' . $item;
                    if ($load->isType(_DATA_DIR . $pathChildren) == 'file') {
                        //xoa file
                        self::deleteFile(dirname($pathChildren), $item);
                    } else {
                        //khi la folder doc tiep
                        self::deleteFolder($parentDir . '/' . $name, $item);
                    }
                }
            }
            rmdir($path);
            return true;
        }
        return false;
    }
}



?>