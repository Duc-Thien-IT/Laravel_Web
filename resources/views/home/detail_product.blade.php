<!DOCTYPE html>
<html>

<head>
  @include('home.head')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <!-- Product data section -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Detail Products
        </h2>
      </div>
      <div class="row">

        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{url('detail_product', $data->id)}}">
              <div class="img-box">
                <img src="/products/{{$data->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$data->title}}</h6>
                <h6>Price
                  <span>
                  {{$data->price}}
                  </span>
                </h6>
              </div>
            </a>
          </div>
        </div>
        
      </div>
     
    </div>
  </section>

  <!-- end Product data section -->

  <!-- info section -->

    @include('home.info')

  <!-- end info section -->

</body>

</html>