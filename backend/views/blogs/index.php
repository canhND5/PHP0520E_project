<h1>Tìm kiếm</h1>
<form action="" method="get">
    <input type="hidden" name="controller" value="category"/>
    <input type="hidden" name="action" value="index"/>
    <div class="form-group">
        <label>Nhập tên danh mục</label>
        <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-success"/>
        <a href="index.php?controller=blog" class="btn btn-secondary">Xóa filter</a>
    </div>
</form>

<h1>Danh sách category</h1>
<a href="index.php?controller=blog&action=create" class="btn btn-primary">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Avatar</th>
        <th>Content</th>
        <th>Status</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($blogs)): ?>
        <?php foreach ($blogs as $blog): ?>
            <tr>
                <td>
                    <?php echo $blog['id']; ?>
                </td>
                <td>
                    <?php echo $blog['title']; ?>
                </td>
                <td>
                    <?php if (!empty($blog['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $blog['avatar'] ?>" width="60"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $blog['content']; ?>
                </td>
                <td>
                    <?php
                    $status_text = 'Active';
                    if ($blog['status'] == 0) {
                        $status_text = 'Disabled';
                    }
                    echo $status_text;
                    ?>
                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($blog['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($category['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($blog['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=blog&action=detail&id=<?php echo $blog['id'] ?>"
                       title="Chi tiết">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="index.php?controller=blog&action=update&id=<?php echo $blog['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?controller=blog&action=delete&id=<?php echo $blog['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="7"><?php echo $pages; ?></td>
        </tr>

    <?php else: ?>
        <tr>
            <td colspan="7">Không có bản ghi nào</td>
        </tr>
    <?php endif; ?>
</table>
<!--  hiển thị phân trang-->

