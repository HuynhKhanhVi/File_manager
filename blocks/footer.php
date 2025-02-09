</div>
<?php
if (empty($_GET['type']) && empty($_GET['module'])):


?>
<footer>
    <div class="container">

        <div class="row">
            <div class="col-8">
                <?php  if (empty($_GET['module'])):  ?>
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa fa-check-square" aria-hidden="true"></i>
                    Chọn tất cả</a>
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa fa-window-close-o"
                        aria-hidden="true"></i> Bỏ Chọn</a>
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    Xóa</a>
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i>
                    Copy</a>

                <?php endif;  ?>
            </div>

            <div class="col-4">
                <p class="text-right"> Copyright &copy;
                    <?php echo date('Y'); ?> by Khanhvi
                </p>
            </div>
        </div>
    </div>
    <style>
        .label-block {
            display: block;
            font-weight: bold;
        }
    </style>
</footer>
<?php endif; ?>
<?php

$parentDir = Load::getParentDir();

?>
<div class="modal fade" id="new_item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?module=create_item&type=action&path=<?php echo $parentDir  ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="label-block">Loại</label>
                        <div class="form-check">
                            <label for="item_file">
                                <input type="radio" name="item_type" value="file" id="item_file" checked> file
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="item_folder">
                                <input type="radio" name="item_type" value="folder" id="item_folder"> Thư mục
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="label-block">Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Tên" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>