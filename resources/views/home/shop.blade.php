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
      <div class="div_deg">
          {{$product->onEachSide(1)->links()}}
      </div>
    </div>
  </section>

  <style type="text/css">
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg{
            border: 2px solid black;
        }

        th{
            background-color: skyblue;
            color: #333;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td{
            border: 1px solid black;
            text-align: center;
        }
</style>