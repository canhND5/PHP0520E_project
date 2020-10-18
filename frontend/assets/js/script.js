// frontend/assets/js/script.js
//Xử lý ajax cho chúc năng Thêm vào giỏ hàng
$(document).ready(function () {
    //Xử lý sự kiện click trên class add-to-cart
    $('.add-to-cart').click(function () {
       //Cần xử lý để lấy ra đc đúng id của sản phẩm vừa
        //click, để khi gọi ajax sẽ truyền id này lên
        //Thêm 1 thuộc tính gì đó chứa id của sản phẩm ngay
        //tại đối tượng đang click, đặt thuộc tính đó = data-id
        var product_id = $(this).attr('data-id');
        //Gọi ajax sử dụng jQuery
        $.ajax({
            //đường dẫn mvc xử lý ajax
            url: 'index.php?controller=cart&action=add',
            // phương thức gửi dữ liệu
            type: 'GET',
            // dữ liệu gửi lên
            data: {
                product_id: product_id
            },
            // nơi nhận kết quả trả về từ url, tất cả dữ liệu
            //đó đc lưu trong tham số data của hàm
            success: function(data) {
                console.log(data);
                //Sử dụng tab Network của trình duyệt để debug
                //các thông tin liên quan đến gọi ajax
                //Đã có sẵn 1 class = ajax-message đang ẩn để
                //chứa các message Thêm giỏ hàng thành công
                $('.ajax-message')
                .html('Thêm vào giỏ thành công')
                .addClass('ajax-message-active');
                //Sử dụng hàm setTimeout để set thời gian chuyển
                //đổi cho 1 selector
                //Chờ 3s sẽ ẩn message đi
                setTimeout(function(){
                    $('.ajax-message').removeClass('ajax-message-active')
                }, 3000);
                //Xử lý update số lượng trong giỏ
                //Lấy nội dung của class cart-amount
                var cart_total = $('.cart-amount').html();
                cart_total++;
                //Set lại nội dung mới cho class cart-amount
                $('.cart-amount').html(cart_total);
                // events.preventDefault();
            }
        });return false;
    });

    //xu lý sự kiện trên class add-to-heart
    $('.add-to-heart').click(function () {
        //Cần xử lý để lấy ra đc đúng id của sản phẩm vừa
        //click, để khi gọi ajax sẽ truyền id này lên
        //Thêm 1 thuộc tính gì đó chứa id của sản phẩm ngay
        //tại đối tượng đang click, đặt thuộc tính đó = data-id
        var product_id = $(this).attr('data-id');
        //Gọi ajax sử dụng jQuery
        $.ajax({
            //đường dẫn mvc xử lý ajax
            url: 'index.php?controller=heart&action=add1',
            // phương thức gửi dữ liệu
            type: 'GET',
            // dữ liệu gửi lên
            data: {
                product_id: product_id
            },
            // nơi nhận kết quả trả về từ url, tất cả dữ liệu
            //đó đc lưu trong tham số data của hàm
            success: function(data) {
                console.log(data);
                //Sử dụng tab Network của trình duyệt để debug
                //các thông tin liên quan đến gọi ajax
                //Đã có sẵn 1 class = ajax-message đang ẩn để
                //chứa các message Thêm giỏ hàng thành công
                $('.ajax-message')
                    .html('Thêm vào ưa thích thành công')
                    .addClass('ajax-message-active');
                //Sử dụng hàm setTimeout để set thời gian chuyển
                //đổi cho 1 selector
                //Chờ 3s sẽ ẩn message đi
                setTimeout(function(){
                    $('.ajax-message').removeClass('ajax-message-active')
                }, 3000);
                //Xử lý update số lượng trong giỏ
                //Lấy nội dung của class cart-amount
                // var cart_total = $('.cart-amount').html();
                // cart_total++;
                //Set lại nội dung mới cho class cart-amount
                // $('.cart-amount').html(cart_total);
                // events.preventDefault();

            }
        });
        return false;
    });

    submit.click(function()
    {
        //khai báo các biến dữ liệu gửi lên server
        var user = $("input[name='user']").val(); //lấy giá trị trong input user

        //Kiểm tra xem trường đã được nhập hay chưa
        if(user == ''){
            alert('Vui lòng nhập Tên người dùng');
            return false;
        }

        //Lấy toàn bộ dữ liệu trong Form
        var data = $('form#form_input').serialize();

        //Sử dụng phương thức Ajax.
        $.ajax({
            type : 'GET', //Sử dụng kiểu gửi dữ liệu POST
            url : 'data.php', //gửi dữ liệu sang trang data.php
            data : data, //dữ liệu sẽ được gửi
            success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
            {
                if(data == 'false')
                {
                    alert('Không có người dùng');
                }else{
                    $('#content').html(data); //dữ liệu HTML trả về sẽ được chèn vào trong thẻ có id content
                }
            }
        });
        return false;
    });


});