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

          <h1>Add User</h1>
            <div class="div_product">
                
                <form action="{{url('upload_user')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="input_deg">
                        <label>Name</label>
                        <input type="text" name="name" required style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>

                    <div class="input_deg">
                        <label>Email</label>
                        <textarea name="email" required></textarea>
                    </div>

                    <div class="input_deg">
                        <label>UserType</label>
                        <input type="text" name="userType" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>
                    
                    <div class="input_deg">
                        <label>Phone</label>
                        <input type="number" name="phone" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>

                    <div class="input_deg">
                        <label>Address</label>
                        <input type="text" name="address" style="height: 38px; margin-top:3px; width: 260px;"/>
                    </div>

                    <div class="btn_submit">
                        <input class="btn btn-success" type="submit" value="Save" />
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