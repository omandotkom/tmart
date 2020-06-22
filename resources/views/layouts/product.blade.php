<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image_preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  $(document).ready(function() {


    $("#image").change(function() {
      readURL(this);
    });
  });
</script>
<div class="container">

  <div class="row">
    <div class="col-lg-3">

      <h1 class="my-4">T-Mart</h1>
      @include('layouts.listsidebar')

    </div>

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <h1 class="my-4">
        @if(Auth::user()->role == "admin")
        @if(isset($product))
        <i class="fa fa-pencil"></i> Edit Product</h1>
      @php
      $edit = true;
      @endphp
      @else
      <i class="fa fa-plus"></i> Add Product</h1>
      @php
      $edit = false;
      @endphp
      @endif

      @else
      <i class="fa fa-info-circle"></i> View Product</h1>
      @php
      $edit = false;
      @endphp
      @endif
      <div class="row my-4">

        <div class="card w-100">
          <div class="card-header">
            Product Detil
          </div>
          <img src="@if(isset($product)){{$product->image}}@endif" id="image_preview" class="card-img-top d-block rounded mt-3 w-25 mx-auto img-fluid" alt="">
          <div class="card-body">
            @if(!$edit)
            <form method="post" enctype="multipart/form-data" action="{{route('saveproduct','add')}}">
              @else
              <form method="post" enctype="multipart/form-data" action="{{route('saveproduct','edit')}}">

                @endif
                @csrf
                @if(Auth::user()->role == "admin")

                <div class="form-group">
                  <strong><label for="image">Product Picture</label></strong>
                  @if($edit)
                  <input type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Product Image" id="image">
                  <input type="hidden" name="id" value="{{$product->id}}">
                  @else
                  <input required type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Product Image" id="image">

                  @endif
                  @error('image')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  @csrf
                </div>
                @endif
                <div class="form-group">
                  <strong><label for="name">Product Name</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <input type="text" name="name" value="@if(isset($product)){{$product->name}}@endif" required class="form-control" id="name" placeholder="Enter product name">
                  @else
                  <br><label id="name">{{$product->name}}</label>
                  @endif
                </div>
                <div class="form-group">
                  <strong> <label for="stock">Product Stock</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <input type="numeric" class="form-control" id="stock" value="@if(isset($product)){{$product->stock}}@endif" required name="stock" placeholder="Enter product's stock number">
                  @else
                  <br><label id="stock">{{$product->stock}}</label>
                  @endif
                </div>
                <div class="form-group">
                  <strong><label for="price">Product Price / Item</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <input type="numeric" class="form-control" id="price" value="@if(isset($product)){{$product->price}}@endif" required name="price" placeholder="Enter product's price">
                  @else
                  <br><label id="price">{{rupiah($product->price)}}<label>
                      @endif
                </div>
                <div class="form-group">
                  <strong><label for="weight">Product Weight (gram)</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <input type="numeric" class="form-control" id="weight" value="@if(isset($product)){{$product->weight}}@endif" required name="weight" placeholder="Enter product's weight">
                  @else
                  <br> <label id="weight">{{$product->weight}} grams<label>
                      @endif
                </div>
                <div class="form-group">
                  <strong><label for="description">Product Description</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <textarea class="form-control" id="description" placeholder="Deskripsi barang" name="description" rows="3">@if(isset($product)){{$product->description}}@endif</textarea>
                  @else
                  <br> <label id="description text-wrap">{{$product->description}}<label>
                      @endif
                </div>
                <div class="form-group">
                  <strong><label for="category">Product Category</label></strong>
                  @if(Auth::user()->role != "buyer")
                  <select name="category" class="custom-select">
                    <option selected>Select Product Category</option>
                    @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                  </select>
                  @else
                  <br> <label id="weight">{{$category->name}}<label>
                      @endif
                </div>
                @if(Auth::user()->role =="admin")
                <button type="submit" class="btn float-right btn-primary">Upload</a>
                  @endif
              </form>
          </div>
        </div>

      </div>
      @if(!isset($mode))
      <div class="row my-4">
        <div class="card w-100">
          <h5 class="card-header">Product Comment</h5>
          <div class="card-body">

            <form method="post" action="{{route('comment')}}">
              <div class="form-group">
                @csrf
                <label for="comment">Comment {{$product->name}}</label>
                <textarea required class="form-control" name="comment" id="comment" rows="3"></textarea>
                <button type="submit" class="btn mt-3 float-right btn-secondary btn-sm">Comment</button>

              </div>
              <input type="hidden" name="productid" value="{{$product->id}}">
            </form>
          </div>
        </div>
      </div>
      @if(isset($product))
      <div class="row my-4">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">{{$product->comments->count()}} comments on {{$product->name}}</h5>
            <dl>

              @foreach($product->comments as $comment)
              <dt>{{$comment->user->name}} <small>({{$comment->created_at}})</small></dt>
              <dd>{{$comment->comment}}</dd>

              @endforeach
            </dl>
          </div>
        </div>
      </div>
      @endif
      @endif
      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>