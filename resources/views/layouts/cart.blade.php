<script>
  function changequantity(cart_id, quantityid) {
    var qty = $(quantityid).val();
    var updateURL = "{{route('addtocartapi')}}".concat("/").concat(cart_id).concat("/").concat(qty);
    axios.get(updateURL)
      .then(function(response) {
        location.reload();

      })
      .catch(function(error) {
        // handle error
        Toastify({
          close: true,
          gravity: "top", // `top` or `bottom`
          position: 'center', // `left`, `center` or `right`
          text: "Gagal, please check quantity.",
          backgroundColor: "#FF6347",
          className: "error",
        }).showToast();
      })
      .then(function() {
        // always executed
      });
  }
</script>
<div class="container">

  <div class="row">
    <div class="col-lg-3">

      <h1 class="my-4">T-Mart</h1>
     @include('layouts.listsidebar')
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <h1 class="my-4"><i class="fa fa-cart-arrow-down"></i> Cart</h1>
      <div class="row my-4">

        <table class="table table-responsive-sm table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col">Item</th>
              <th scope="col" class="w-25">Picture</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
            </tr>
          </thead>
          <tbody>
            @foreach($itemlist as $product)
            <tr>
              <td scope="row"><a href="{{route('updateproduct',$product->product->id)}}">{{$product->product->name}}</a></td>
              <td><a href="{{route('updateproduct',$product->product->id)}}"><img src="{{$product->product->image}}" style="max-width : 15%" class="img-fluid img-thumbnail d-block rounded" /></a></td>
              <td>{{$product->product->price}} / item</td>
              <td>
                <div class="input-group">
                  <input type="numeric" class="form-control" value="{{$product->product_quantity}}" id="cart{{$product->id}}" aria-label="Item's Quantity" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <a class="btn btn-primary input-group-text" onclick="changequantity('{{$product->id}}','#cart{{$product->id}}')" id="basic-addon2" role="button">Save</a>
                    <a class="btn btn-primary input-group-text" href="{{route('removeitem',$product->id)}}" id="basic-addon2" role="button"><i class="fa fa-trash"></i></a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        
      </div>
      <a class="btn btn-primary float-right text-white" href="{{route('checkout')}}" role="button"><i class="fa fa-cart-arrow-down"></i> Checkout</a>
                   
      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>