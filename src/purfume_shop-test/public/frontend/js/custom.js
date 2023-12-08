$(document).ready(function () {
    //Hiển thị số lượng sản phẩm có trong giỏ hàng
    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart()
    {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response){
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
                // console.log(response.count)
            }
        });
    }

    //Hiển thị số lượng sản phẩm có trong danh sách yêu thích
    function loadwishlist()
    {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-count",
            success: function (response){
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count)
            }
        });
    }

    //Thêm sản phẩm vào giỏ hàng
        $('.addToCartBtn').click(function(e) {
            e.preventDefault();
    
            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty-input').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                },
                success: function(response){
                    swal(response.status);
                    loadcart();
                }
            });
    
        });
        
    //Thêm sản phẩm vào danh sách yêu thích
        $('.addToWishlist').click(function (e){
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.prod_id').val();

            $.ajax({
                method: "POST",
                url: "/add-to-wishlist",
                data: {
                    'product_id': product_id,
                },
                success: function (response){
                    swal(response.status);
                    loadwishlist();
                }
            });
        });

        // Tăng số lượng sản phẩm
        $('.increment-btn').click(function (e){
            e.preventDefault();
    
            // var inc_value = $('.qty-input').val();
            var inc_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
    
            if(value < 10)
            {
                value++;
                // $('.qty-input').val(value);
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });
    
        // Giảm số lượng sản phẩm
        $('.decrement-btn').click(function (e){
            e.preventDefault();
    
            // var dec_value = $('.qty-input').val();
            var dec_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
    
            if(value > 1)
            {
                value--;
                // $('.qty-input').val(value);
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });

        //Xóa Sản Phẩm Khỏi Giỏ Hàng
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('.delete-cart-item').click(function (e) {
            e.preventDefault();
        
            var clickedButton = $(this);
        
            Swal.fire({
                title: "Xóa?",
                icon: 'question',
                text: "Vui lòng đảm bảo và sau đó xác nhận!",
                showCancelButton: true,
                confirmButtonText: "Có, xóa!",
                cancelButtonText: "Không, hủy bỏ!",
            }).then(function (result) {
                if (result.isConfirmed) {
                    var prod_id = clickedButton.closest('.product_data').find('.prod_id').val();
                    $.ajax({
                        method: "POST",
                        url: "delete-cart-item",
                        data: {
                            'prod_id': prod_id,
                        },
                        success: function (response) {
                            window.location.reload();
                            Swal.fire("", response.status, "success");
                        },
                        error: function () {
                            Swal.fire("Lỗi khi xóa!", "Vui lòng thử lại", "error");
                        }
                    });
                }
            });
        });
        
        //Xóa sản phẩm khỏi danh sách yêu thích
        $('.remove-wishlist-item').click(function (e){
            e.preventDefault();
            var prod_id = $(this).closest('.product_data').find('.prod_id').val();

            $.ajax({
                method: "POST",
                url: "delete-wishlist-item",
                data: {
                    'prod_id': prod_id,
                },
                success: function(response){
                    window.location.reload();
                    swal("", response.status, "success");
                }
            });
        });

        // Cập nhật số lượng và giá trong giỏ hàng
        $('.changeQuantity').click(function (e) {
            e.preventDefault();
        
            var prod_id = $(this).closest('.product_data').find('.prod_id').val();
            var qty = $(this).closest('.product_data').find('.qty-input').val();
            var data = {
                'prod_id': prod_id,
                'prod_qty': qty,
            };
        
            $.ajax({
                method: "POST",
                url: "update-cart",
                data: data,
                success: function (response) {
                    $(this).closest('.product_data').find('.qty-input').val(qty);
                }
            });
        });
        
    }); 