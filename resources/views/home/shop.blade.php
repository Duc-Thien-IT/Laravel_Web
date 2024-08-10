<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">

        @foreach($product as $item)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{url('detail_product', $item->id)}}">
              <div class="img-box">
                <img src="products/{{$item->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$item->title}}</h6>
                <h6>Price
                  <span>
                  {{$item->price}}
                  </span>
                </h6>
              </div>
              <div>
                <a class="btn btn-success" href="{{url('add_cart', $item->id)}}">Add To Cart</a>
              </div>
            </a>
          </div>
        </div>
        @endforeach
        
      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>