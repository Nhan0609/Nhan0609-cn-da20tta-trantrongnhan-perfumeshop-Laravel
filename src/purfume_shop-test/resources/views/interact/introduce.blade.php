@extends('layouts.front')

@section('title')
    Welcome to Perfume Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    


   

   
    
    <div class="py-5">
        <div class="container">
            <div class="row">

                

                <div class="col-md-12 mb-5" style="text-align: center">
                    <h2>Giới Thiệu Về Website</h2>
                    <a href="/home"><img  src="{{asset('assets/images/logo.gif')}}" alt="Logo đầu trang"/></a>
                </div>

                <div class="col-md-6 mt-3">
        
                    <img src="{{asset('assets/images/anhgioithieu1.webp')}}" alt="Hình ảnh Giới thiệu 1">
                    
                    <img src="{{asset('assets/images/anhgioithieu2.jpg')}}" alt="Hình ảnh Giới thiệu 2">
                   
                    <img src="{{asset('assets/images/anhgioithieu3.jpg')}}" alt="Hình ảnh Giới thiệu 3">
                </div>
                <div class="col-md-6">
                    
                    <h2>Chào mừng bạn đến với cửa hàng <br> Nước hoa của chúng tôi</h2>

                    <p>
                        Khám phá một thế giới hương thơm tuyệt vời đốn tim bạn. 
                        Bộ sưu tập nước hoa của chúng tôi được tận tâm chọn lọc 
                        để mang đến cho bạn những mùi hương tinh tế nhất từ khắp 
                        nơi trên thế giới.
                    </p>
                    <p>
                        Khám phá loạt nước hoa đa dạng của chúng tôi và tìm ra 
                        mùi hương hoàn hảo cho mọi dịp. Từ những kiệt tác thanh 
                        lịch đến những mùi hương hiện đại, chúng tôi có mọi thứ 
                        cho mọi người.
                    </p>
                    <p>
                        Trải nghiệm sự sang trọng như chưa bao giờ có. Mua sắm 
                        cùng chúng tôi và đắm chìm trong nghệ thuật của hương thơm.
                    </p>
                    <a href="/category"><h3>Khám Phá Bộ Sưu Tập Nước Hoa</h3></a>
                    <p>
                        Được chọn lọc từ những nguyên liệu tốt nhất, bộ sưu tập nước 
                        hoa của chúng tôi mang lại cho bạn những trải nghiệm thơm 
                        lâng lâng và độc đáo.
                    </p>
                    <p>
                        Hãy khám phá ngay để tìm kiếm mùi hương hoàn hảo cho phong cách của bạn.
                    </p>
                    <h3>Về Chúng Tôi</h3>
                    <p>
                        Chúng tôi là cửa hàng nước hoa uy tín, chuyên cung cấp 
                        những sản phẩm chất lượng cao từ các thương hiệu nổi tiếng. 
                        Với cam kết đảm bảo chất lượng, chúng tôi tự hào mang đến 
                        cho khách hàng những trải nghiệm mua sắm tuyệt vời nhất.
                    </p>
                    <p>
                        Hãy đồng hành cùng chúng tôi để khám phá thế giới hương thơm 
                        đẳng cấp và độc đáo.
                    </p>
                    <h3>Liên hệ với chúng tôi</h3>
                    <p >
                        Hãy dành thời gian để khám phá thông tin chi tiết về chúng tôi và 
                        <a href="{{url('views.interact.contact')}}" style="color: red;" > 
                            <b>liên hệ với chúng tôi</b>
                        </a> nếu có bất kỳ câu hỏi nào.
                    </p>
                </div>
            </div>
        </div>
    </div>   

    @include('layouts.inc.footer')
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endsection