    <!DOCTYPE html>
    <html>
    <head> 
        @include('admin.css')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <style type="text/css"> 
            input[type='text']{
                width: 350px;
                height: 35px;
            }

            .table{
                text-align: center;
                margin: auto;
                border: 2px solid black;
                margin-top: 50px;
            }

            th{
                background-color: skyblue;
                padding: 15px;
                font-size: 20px;
                font-weight: bold;
                color: white;
            }

            td{
                color: while;
                padding: 10px;
                border: 1px solid skyblue; 
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

                    <div class="div_deg">
                        <h2>Add Category</h2>
                        <form action="{{url('add_category')}}" method="POST">

                        @csrf
                            <div>
                                <input type="text" name="category"/>
                                <input type="submit" value="Add" style="width: 150px; height: 36px; color: #333; background-color: #00FF00; border-radius: 5px; font-weight: bold; font-size: 18px;"/>
                            </div>
                        </form>

                    </div>

                    <div>
                        <table class="table">
                            <tr>
                                <th>ID Category</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $item)
                            <tr>
                                <th>{{$item->id}}</th>
                                <th>{{$item->category_name}}</th>
                                <th>
                                    <a class="btn btn-danger" href="{{url('delete_category', $item->id)}}">Delete</a> | 
                                    <a class="btn btn-success" href="{{url('edit_category', $item->id)}}">Edit</a>
                                </th>
                            </tr>
                            @endforeach
                        </table>
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