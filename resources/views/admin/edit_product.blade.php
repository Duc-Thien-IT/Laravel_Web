<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .div_product{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        h1{
            color: white;
        }

        label{
            display: inline-block;
            width: 250px;
            font-size: 18px;
            color: white;
        }

        input[type='text']{
            width: 350px;
            height: 50px;
        }

        textarea{
            width: 450px;
            height: 80px;
        }

        .input_deg{
            padding: 15px;
        }

        .btn_submit{
            justify-content: center;
        }

        .btn_submit > input{
            width: 100px;
            margin-left: 270px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.slide')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <h1>Add Product</h1>
            <div class="div_product">
                
                <form action="{{url('update_product', $data->id)}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="input_deg">
                        <label>Product Title</label>
                        <input type="text" name="title" value="{{$data->title}}" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>

                    <div class="input_deg">
                        <label>Description</label>
                        <textarea name="description">{{$data->description}}"</textarea>
                    </div>

                    <div class="input_deg">
                        <label>Price</label>
                        <input type="text" name="price" value="{{$data->price}}" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>
                    
                    <div class="input_deg">
                        <label>Quantity</label>
                        <input type="number" name="quantity" value="{{$data->quantity}}" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>

                    <div class="input_deg">
                        <label>Product Category</label>
                        <select name="category">
                            <option value="{{$data->category}}">{{$data->category}}</option>
                            @foreach($category as $data)
                            <option value="{{$data->category_name}}">{{$data->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input_deg">
                        <label>Current Image</label>
                        <img src="/products/{{$data->image}}" width="150px" height="150px"/>
                    </div>

                    <div class="input_deg">
                        <label>New Image</label>
                        <input type="file" name="image"/>
                    </div>

                    <div class="btn_submit">
                        <input class="btn btn-success" type="submit" value="Update" />
                    </div>
                </form>
                
            </div>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>