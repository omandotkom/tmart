<div class="container">
  
  <div class="row">
    <div class="col-lg-3">

      <h1 class="my-4">T-Mart</h1>
      @include('layouts.listsidebar')
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="{{url('/images/slide/1.jpg')}}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="{{url('/images/slide/2.jpg')}}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="{{url('/images/slide/3.jpg')}}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      <div class="row">

        @foreach($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="{{route('updateproduct',$product->id)}}"><img style="max-width : 200px; max-height : 200px;" class="card-img-top d-block mt-1 mx-auto img-fluid rounded" src="{{$product->image}}" alt="{{$product->name}}"></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="{{route('updateproduct',$product->id)}}">{{$product->name}} ({{$product->stock}})</a>
              </h4>
              <h5>{{rupiah($product->price)}} </h5>

              <p class="card-text">{{$product->description}}</p>
            </div>
            <div class="card-footer">
              <div class="btn-group float-right btn-group-sm" role="group">
                @if(Auth::check() && Auth::user()->role == "admin")

                <a class="btn btn-danger mr-2 btn-sm" href="{{route('removeproduct',$product->id)}}" role="button"><i class="fa fa-trash"></i></a>
                <a class="btn btn-primary btn-sm" href="{{route('updateproduct',$product->id)}}" role="button"><i class="fa fa-pencil-square-o"></i></a>

                @else
                @if($product->stock> 0)
                <a class="btn btn-primary btn-sm" href="{{route('addtocart',['product_id' => $product->id,'quantity' => 1])}}" role="button"><i class="fa fa-cart-plus"></i></a>
                @else
                Out of Stock
                @endif
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach


      </div>
      <!-- /.row -->
      {{$products->links()}}
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>