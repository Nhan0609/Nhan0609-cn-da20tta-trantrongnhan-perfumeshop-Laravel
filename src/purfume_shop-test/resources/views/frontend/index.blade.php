@extends('layouts.front')

@section('title')
    Welcome to Perfume Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    
<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded" src="{{asset('assets/images/gif.gif')}}" style="object-fit: cover" />
                </div>
            </div>
            <div class="col-lg-7">
                <div class="border-start border-5 border-primary ps-5 mb-5">
                    <h6 class="text-primary text-uppercase">Về chúng tôi</h6>
                    <h1 class="display-5 text-uppercase mb-0">
                        <b>PERFUME SHOP</b> <br> 
                        <p style="padding: 30px">Hòa Mình Trong Thế Giới Hương Thơm</p>
                    </h1>
                </div>
                <h4 class="text-body mb-4">
                    Mỗi chai nước hoa là một chuyến phiêu lưu khám phá, 
                    là một hành trình đến với thế giới của mùi hương tinh tế và nghệ thuật. 
                    Trải qua thời gian, nước hoa không chỉ là một sản phẩm, 
                    mà là biểu tượng của cái đẹp và sự sang trọng.
                </h4>
                <div class="bg-light p-4">
                    <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                aria-selected="true">
                                Nhiệm vụ của chúng tôi
                            </button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                aria-selected="false">
                                Tầm nhìn của chúng tôi
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                            aria-labelledby="pills-1-tab">
                            <p class="mb-0">
                                <b>1. Cung Cấp Sản Phẩm Chất Lượng Cao: </b>
                                Đảm bảo cung cấp nước hoa chất lượng cao từ các thương hiệu nổi tiếng 
                                và đáng tin cậy để đáp ứng nhu cầu và mong muốn của khách hàng.
                            </p>
                            <br>
                            <p class="mb-0">
                                <b>2. Tạo Trải Nghiệm Mua Sắm Độc Đáo: </b>
                                Tạo ra không gian mua sắm thoải mái và thuận lợi, 
                                có thể kèm theo các dịch vụ như thử nghiệm mẫu và tư vấn cá nhân.
                            </p>
                            <br>
                            <p class="mb-0">
                                <b>3. Tư Vấn Khách Hàng: </b>
                                Hỗ trợ và tư vấn khách hàng trong việc chọn lựa nước hoa phù hợp 
                                với phong cách và sở thích cá nhân của họ.
                            </p>
                             
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <p class="mb-0">
                                Tầm nhìn của chúng tôi là trở thành địa điểm mua sắm nước hoa hàng đầu, 
                                nơi mọi khách hàng đều trải nghiệm được sự tinh tế và sang trọng của thế giới hương thơm. 
                                Chúng tôi không chỉ cung cấp những sản phẩm nước hoa chất lượng cao từ các thương hiệu nổi tiếng mà còn tạo ra một không gian mua sắm độc đáo, 
                                nơi khách hàng có thể khám phá và tận hưởng những trải nghiệm nước hoa đặc sắc. 
                                Chúng tôi cam kết đồng hành cùng khách hàng trong hành trình tìm kiếm hương thơm phản ánh đẳng cấp và cá tính riêng của họ. 
                                Với sự chuyên nghiệp và tận tâm, chúng tôi xây dựng một cộng đồng người hâm mộ nước hoa, 
                                nơi mà mỗi chai nước hoa không chỉ là một sản phẩm mà còn là một tác phẩm nghệ thuật đầy ý nghĩa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Start --}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Danh Mục </h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($trending_category as $tcategory)
                        <div class="item">
                            <a href="{{ url('category/'.$tcategory->slug)}}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/'.$tcategory->image) }}" alt="Ảnh Danh Mục Trending">
                                    <div class="card-body">
                                        <h5>{{ $tcategory->name }}</h5>
                                        <p>
                                            {{ $tcategory->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Hot</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($featured_products as $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span> 
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Nhiều Lượt Xem</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($productsRecommend->take(6) as $keyRecommend => $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span>
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                    <h5> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        {{ $prod->view_count }} Lượt Xem
                                    </h5>
                                </div>
                            </a>
                        </div> 
                    @endforeach
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