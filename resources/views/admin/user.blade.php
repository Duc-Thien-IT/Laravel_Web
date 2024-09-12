<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
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
  </head>
  <body>
    @include('admin.header')

    @include('admin.slide')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

                <form action="{{url('user_search')}}" method="get">
                    @csrf
                    <input type="search" name="search">
                    <input type="submit" class="btn btn-success" value="Search">
                </form>

                <div class="div_deg">
                    <table class="table_deg">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>UserType</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>

                        @foreach($user as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->userType}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>
                                <a class="btn btn-danger" href="{{url('delete_user',$item->id)}}">Delete</a> ||
                                <a class="btn btn-success" href="{{url('edit_user',$item->id)}}">Edit</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>

                </div>

                <div class="div_deg">
                    {{$user->onEachSide(1)->links()}}
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