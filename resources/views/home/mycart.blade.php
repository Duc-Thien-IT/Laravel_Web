<!DOCTYPE html>
<html>

<head>
  @include('home.head')
  <style>
    /* CSS for the table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  <h1 style="text-align: center;">My Cart</h1>
  <table>
    <thead>
      <tr>
        <th>Product Title</th>
        <th>Price</th>
        <th>Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @php
          $value = 0;
      @endphp

      @foreach($cart as $item)
      <tr>
        <td>{{$item->product->title}}</td>
        <td>${{$item->product->price}}</td>
        <td><img width="150" height="150" src="/products/{{$item->product->image}}"></td>
        <td><a href="" class="btn btn-danger">Remove</a></td>
      </tr>

      @php
          $value += $item->product->price;
      @endphp

      @endforeach

      <tr>
        <td style="color: red">Total</td>
        <td>${{$value}}</td>
        <td></td>
        <td><a href="" class="btn btn-success" style="width: 90px;">Pay</a></td>
      </tr>

    </tbody>
  </table>

  <div>
    <form action="{{url('comfirm_order')}}" method="post">
        @csrf
        <div>
            <label>Receiver Name</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>

        <div>
            <label>Receiver Address</label>
            <input type="text" name="address" value="{{Auth::user()->address}}">
        </div>

        <div>
            <label>Receiver Phone</label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Please Order"/>
        </div>
    </form>
  </div>
  <!-- end shop section -->

  <!-- info section -->
  @include('home.info')
  <!-- end info section -->
</body>

</html>
