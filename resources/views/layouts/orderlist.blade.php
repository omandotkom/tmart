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

  $(document).ready(function() {

    $("#province").change(function() {
      var selectedProvince = $(this).children("option:selected").val();
      var url = "{{route('citiesapi')}}".concat("/").concat(selectedProvince);
      axios.get(url).then(function(response) {
        $("#city").empty();
        $("#provincename").val($("#province").children("option:selected").html());

        response.data.forEach(fill);


      }).catch(function(error) {
        console.log(error);
      })
    });

    function fill(item, index) {

      $('#city').append(`<option class="val" value="${item.city_id}"> 
      ${item.type} ${item.city_name} 
                                  </option>`);
    }

    function fillcourier(item, index) {
      console.log(item);
      $('#courier').append(`<option class="val" value="JNE,${item.service},${item.cost[0].value}"> 
JNE ${item.service} ${item.cost[0].etd} hari (${item.cost[0].value})   
                            </option>`);
    }
    $("#city").change(function() {
      var selectedCity = $(this).children("option:selected").val();

      var curl = "{{route('citydetailapi')}}".concat("/").concat("{{Auth::user()->id}}").concat("/").concat(selectedCity);

      axios.get(curl).then(function(response) {
        $("#postalcode").val(response.data.data.destination_details.postal_code);
        $("#courier").empty();
        $("#cityname").val($("#city").children("option:selected").html());

        response.data.costs.forEach(fillcourier);
        console.log(response.data.costs);
        // console.log(response.data.results[0]);
      }).catch(function(error) {
        console.log(error);
      });
    });
  })
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
      <h1 class="my-4"><i class="fa fa-cart-arrow-down"></i> @if(Auth::user()->role == "buyer") Your @endif Transactions</h1>
      <div class="row my-4">
        @foreach($orderlist as $order)
        <div class="card mb-2 ml-2 mr-2 w-100">
          <div class="card-header text-white bg-dark">
            Transaction by {{$order->user->name}} ({{$order->status}})
          </div>
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-shopping-bag"></i> Transaction #{{$order->id}} ({{$order->status}})</h5>
            <div class="row my-2">
              <table class="table table-hover mw-25 table-sm">
                <thead>

                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->detil as $detil)
                  <tr>
                    <td>{{$detil->product->name}}</td>
                    <td>{{$detil->product_quantity}} item(s)</td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
            <div class="row ml-2 my-4">
              <p class="card-text"><i class="fa fa-user-circle-o"></i> {{$order->name}} ({{$order->phone}})</p><br>
              <p class="card-text text-wrap"><i class="fa fa-home"></i> {{$order->address}}, {{$order->city}}, {{$order->province}}. {{$order->postalcode}}</p>
            </div>
            <div class="row ml-2">
              @php
              $c = explode(",",$order->courier);
              @endphp
              <p class="card-text"><i class="fa fa-truck"></i> {{$c[0]}} {{$c[1]}} (ID: {{$order->trackingnumber}})</p><br>
            </div>
            <div class="row ml-2 my-4">
              @php
              $imgasset = asset("/images/".$order->image);
              @endphp

              <p class="card-text">Total Transaction : {{$order->grandtotal}} (<a href="{{$imgasset}}" target="_blank">Payment Info</a>)
            </div>
            <div class="row ml-2 my-4">
              <p class="card-text"></p><br>
            </div>
          </div>
          @if(Auth::user()->role == "admin")
          <div class="card-footer text-muted">
            <div class="btn-group float-right btn-group-sm" role="group" aria-label="Action">
              @switch($order->status)
              @case('PaymentWaitingConfirmation')
              <form method="post" action="{{route('updateorderstatus',['id' => $order->id,'status'=>'PaymentConfirmed'])}}">
                @csrf
                <button type="submit" class="btn btn-outline-success btn-sm">Accept Payment</button>
              </form>
              @break
              @case('PaymentConfirmed')
              <form method="post" action="{{route('updateorderstatus',['id' => $order->id,'status'=>'Shipped'])}}">
                @csrf
                <div class="input-group">
                <input type="text" class="form-control" required placeholder="Delivery Tracking ID" name="trackingid" aria-label="Delivery Tracking ID" aria-describedby="basic-addon{{$order->id}}">
                <div class="input-group-append">
                <button type="submit" id="basic-addon{{$order->id}}" class="btn btn-outline-primary btn-sm">Add Tracking ID</button>
              
                </div>
            </div>
            </form>
            @break
            @default

            @break
            @endswitch
          </div>
        </div>
        @else
        <div class="card-footer text-muted">
            <div class="btn-group float-right btn-group-sm" role="group" aria-label="Action">
              @switch($order->status)
              @case('Shipped')
              <form method="post" action="{{route('updateorderstatus',['id' => $order->id,'status'=>'Done'])}}">
                @csrf
                <button type="submit" class="btn btn-outline-success btn-sm">Package Arrived</button>
              </form>
              @break
            @default

            @break
            @endswitch
          </div>
        </div>
        @endif
      </div>
      @endforeach

    </div>

    <!-- /.row -->
  </div>
  <!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>