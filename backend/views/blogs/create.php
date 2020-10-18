<?php
//mvc_demo/views/categories/create.php
//Hiển thị form thêm mới category

?>
<h1>Form thêm mới</h1>
<form action="" method="post" enctype="multipart/form-data">
    Name:
    <input type="text" name="name" value="">
    <br><br>
    Avatar:
    <input type="file" name="avatar">
    <br><br>
    Description:
    <textarea name="category_description"></textarea>
    <br><br>
    <input type="submit" name="submit" value="Save">
</form>
<!--Với trường texarea tích hợp CKEditor - Trình soạn thảo văn bản
Chỉ có thể tích hợp với thẻ textarea
tich hợp thông qua thuộc tính name cảu thẻ này-->
<!--Nhúng file js sau asset/skeditor.js-->

