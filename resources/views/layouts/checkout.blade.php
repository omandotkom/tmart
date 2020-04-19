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
      @include('layouts.listsidebar')
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <h1 class="my-4"><i class="fa fa-cart-arrow-down"></i> Checkout</h1>
      <div class="row my-4">

        <div class="card w-100">
          <div class="card-header">
            Package Receiver
          </div>
          <div class="card-body">
            <h5 class="card-title">Give us receiver's complete address :)</h5>
            <form method="post" action="{{route('payment')}}">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Receiver Name</label>
                <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter receiver name">
               </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Phone Number</label>
                <input type="tel" class="form-control" id="exampleInputPassword1" required name="phone" placeholder="Enter phone number">
              </div>
              <div class="form-group">
                <label for="province">Provinsi</label>
                <select class="form-control" id="province" name="province">
                  @foreach($provinces as $province)
                  <option value="{{$province['province_id']}}">{{$province['province']}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city">

                </select>
              </div>
              <div class="form-group">
                <label for="postal">Postal Code</label>
                <input type="text" class="form-control" name="postalcode" id="postalcode">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat Rumah</label>
                <textarea class="form-control" id="alamat" placeholder="Jl. Panjaitan no.34 rumah warna biru" name="alamat" rows="3">Perumahan Telaga Harapan Blok D9 Nomor 4, Desa Telaga Murni, Cikarang Barat</textarea>
              </div>
              <div class="form-group">
                <label for="courier">Jenis Pengiriman</label>
                <select class="form-control" id="courier" name="courier">
                </select>
              </div>
              <input type="hidden" id="provincename" name="provincename" />
              <input type="hidden" id="cityname" name="cityname" />
              <button type="submit" class="btn float-right btn-primary">Pay</a>
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