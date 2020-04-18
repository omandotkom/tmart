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
      <div class="list-group">
        <a href="#" class="list-group-item">Category 1</a>
        <a href="#" class="list-group-item">Category 2</a>
        <a href="#" class="list-group-item">Category 3</a>
      </div>

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
      <i class="fa fa-plus"></i> View Product</h1>
      @php
        $edit = false;
        @endphp
      @endif
      <div class="row my-4">

        <div class="card w-100">
          <div class="card-header">
            Product Detil
          </div>
          <img src="@if(isset($product)){{$product->image}}@endif" id="image_preview" class="card-img-top rounded mt-3 w-25 mx-auto img-fluid" alt="">
          <div class="card-body">
            @if(!$edit)
            <form method="post" enctype="multipart/form-data" action="{{route('saveproduct','add')}}">
            @else
            <form method="post" enctype="multipart/form-data" action="{{route('saveproduct','edit')}}">

            @endif
            @csrf
            @if(Auth::user()->role == "admin")  
              
            <div class="form-group">
              <label for="image">Product Picture</label>
                @if($edit)
                <input  type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Product Image" id="image">
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
                <label for="name">Product Name</label><br>
                @if(Auth::user()->role != "buyer")
                <input type="text" name="name" value="@if(isset($product)){{$product->name}}@endif" required class="form-control" id="name" placeholder="Enter product name">
                @else
                <label id="name">{{$product->name}}</label>
                @endif  
              </div>
              <div class="form-group">
                <label for="stock">Product Stock</label>
                <input type="numeric" class="form-control" id="stock" value="@if(isset($product)){{$product->stock}}@endif" required name="stock" placeholder="Enter product's stock number">
              </div>
              <div class="form-group">
                <label for="price">Product Price / Item</label>
                <input type="numeric" class="form-control" id="price" value="@if(isset($product)){{$product->price}}@endif" required name="price" placeholder="Enter product's price">
              </div>
              <div class="form-group">
                <label for="weight">Product Weight (gram)</label>
                <input type="numeric" class="form-control" id="weight" value="@if(isset($product)){{$product->weight}}@endif" required name="weight" placeholder="Enter product's weight">
              </div>
              <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control" id="description" placeholder="Jl. Panjaitan no.34 rumah warna biru" name="description" rows="3">@if(isset($product)){{$product->description}}@endif</textarea>
              </div>
              @if(Auth::user()->role =="admin")
              <button type="submit" class="btn float-right btn-primary">Upload</a>
              @endif
            </form>
          </div>
        </div>

      </div>

      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>