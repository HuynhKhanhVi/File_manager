<?php
class Load
{
    private $parentPath = null;
    public function __construct($parentPath = null)
    {
        if (!empty($parentPath)) {
            $this->parentPath = $parentPath!= '.' ? _DATA_DIR . '/' . $parentPath : _DATA_DIR;
        }
    }
    public function scanDir($parentDir = '')
    {
        if (empty($parentDir)) {
            $path = _DATA_DIR;
        } else {
            $path = _DATA_DIR . '/' . $parentDir;
        }
        //Giá trị của biến $path được gán cho thuộc tính ($parentPath) của đối tượng hiện tại (được tham chiếu bằng $this), để lưu đường dẫn của thư mục cha.
        $this->parentPath = $path;
        //ham scandir trả về mảng tên file hoặc thư mục trong directory đã cho
        $dataScan = scandir(directory: $path);
        if (isset($dataScan[0])) {
            unset($dataScan[0]);
        }

        if (isset($dataScan[1])) {
            unset($dataScan[1]);
        }

        return $dataScan;
    }
    //dùng để kiểm tra xem tệp được chỉ định có phải là một thư mục hay không
    public function isType($path)
    {
        if (is_dir($path)) {
            return 'folder';
        }
        return 'file';
    }

    public function getPath($fileName)
    {
        $path = $this->parentPath;
        $path = $path . '/' . $fileName;
        return $path;
    }

    public function getTypeIcons($fileName)
    {
        $path = $this->getPath($fileName);
        return ($this->isType($path) == 'folder') ? '<i class="fa fa-folder-o" aria-hidden="true"></i>' : '<i class="fa fa-file-o" aria-hidden="true"></i> ';
    }

    public function getSize($fileName, $unit = '')
    {
        $path = $this->getPath($fileName);
        if ($this->isType($path) !== 'folder') {
            if (file_exists($path)) {
                $size = filesize($path);
                return round($size / 1024, 2) . ' ' . $unit;
            }
        }
        return 'Folder';
    }

    
    public function getTimeModify($fileName, $format = 'd/m/Y H:i:s')
    {
        $path = $this->getPath($fileName);
        if (file_exists($path)) {
            $time = filectime($path);
            if (!empty($time)) {
                $date = date($format, $time);
                return $date;
            }
        }
        return '';

    }
    public function getPermission($fileName)
    {
        $path = $this->getPath($fileName);
        if (file_exists($path)) {
            //được sử dụng để lấy quyền (permissions) của tệp tin được chỉ định bởi đường dẫn
            $result = fileperms($path);
            $result = sprintf('%o', $result);
            $result = substr($result, -4);
            return $result;
        }
    }
    //lấy giá trị của tham số 'path' từ URL nếu nó tồn tại
    public static function getParentDir()
    {
        $parentDir = '';
        if (!empty($_GET['path'])) {
            $parentDir = $_GET['path'];
        }
        return $parentDir;
    }

    public function back()
    {
        $parentDir = self::getParentDir();
        if (!empty($parentDir)) {
            echo '<tr>
                        <td></td>
                        <td>
                            <a href="#" onclick="event.preventDefault();window.history.back();"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
        }
    }

    public function getFilename($path)
    {
        // là một hàm tích hợp sẵn trong PHP, được sử dụng để trích xuất tên tệp tin hoặc thư mục từ một đường dẫn (path)
        return basename($path);
    }

    public function getFiletype($fileName)
    {
        $path = $this->getPath($fileName);
        if ($this->isType($path) !== 'folder') {
            if (file_exists($path)) {

                return mime_content_type($path);
            }
        }
        return '';
    }

    
}



?>