<script>



</script>
<div class="container">

  <div class="row">
    <div class="col-lg-3">

      <h1 class="my-4">T-Mart</h1>
      @include('layouts.listsidebar')
    </div>

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <h1 class="my-4"><i class="fa fa-money"></i> Payment</h1>
      <div class="row my-4">

        <div class="card w-100">
          <div class="card-header">
            Order Payment
          </div>
          @php
          $grandtotal = 0;
          @endphp
          <div class="card-body">
            <div class="row my-4">
              <dl class="row m-2">
                @foreach($itemlist as $product)
                <dt class="col-sm-3">{{$product->product->name}} x {{$product->product_quantity}}</dt>
                @php
                $totalitem = $product->product->price * $product->product_quantity;
                $grandtotal = $grandtotal + $totalitem;
                @endphp
                <dd class="col-sm-9">{{rupiah($totalitem)}}</dd>
                @endforeach

                <dt class="col-sm-3">Ongkos Kirim</dt>
                @php
                $grandtotal = $grandtotal + $ongkir;
                @endphp
                <dd class="col-sm-9">{{rupiah($ongkir)}}</dd>
              </dl>

            </div>
            <form enctype="multipart/form-data" target="_blank" method="post" action="{{route('generateinvoice')}}">
              <input type="hidden" name="grandtotal" value="{{$grandtotal}}">
              <input type="hidden" name="name" value="{{$request->name}}">
              <input type="hidden" name="phone" value="{{$request->phone}}">
              <input type="hidden" name="province" value="{{$request->provincename}}">
              <input type="hidden" name="city" value="{{$request->cityname}}">
              <input type="hidden" name="postalcode" value="{{$request->postalcode}}">
              <input type="hidden" name="address" value="{{$request->alamat}}">
              <input type="hidden" name="courier" value="{{$request->courier}}">
              <input type="hidden" name="deliverycost" value="{{$request->deliverycost}}">
              @csrf
              <button type="submit" class="btn mx-auto btn-info">Unduh Invoice</button>

            </form>

            <h5 class="card-title text-center mt-1">Payment Method</h5>

            <div class="row my-4">
              <dl class="row w-100 m-2">

                <dt class="col-sm-3"><img class="img-thumbnail img-fluid" src="{{url('shop/payment/dana.png')}}" alt="DANA App"></dt>
                <dd class="col-sm-9"><b>081393558430</b> a.n <b>Veronica Anggie Meida Eka Pratiwi</b></dd>
                <dt class="col-sm-3"><img class="img-thumbnail img-fluid" src="{{url('shop/payment/bca.png')}}" alt="BCA"></dt>
                <dd class="col-sm-9">a.n DNID 081393558430<br>Virtual Account : <b>3901081393558430</b></dd>
                <dt class="col-sm-3"><img class="img-thumbnail img-fluid" src="{{url('shop/payment/bni.png')}}" alt="BNI"></dt>
                <dd class="col-sm-9">a.n DNID 081393558430<br>Virtual Account : <b>8810081393558430</b></dd>
                <dt class="col-sm-3"><img class="img-thumbnail img-fluid" src="{{url('shop/payment/mandiri.png')}}" alt="MANDIRI"></dt>
                <dd class="col-sm-9">a.n DNID 081393558430<br>Virtual Account : <b>89508081393558430</b></dd>
                <dt class="col-sm-3"><img class="img-thumbnail img-fluid" src="{{url('shop/payment/btn.png')}}" alt="BTN"></dt>
                <dd class="col-sm-9">a.n DNID 081393558430<br>Virtual Account : <b>8528081393558430</b></dd>

              </dl>
            </div>
            <h5 class="card-title text-center mt-1">Cara Membayar</h5>
            <ol>
              <li>Pilih salah satu metode pembayaran yang tertera di atas.</li>
              <li>Nominal yang harus di transfer adalah <b>{{rupiah($grandtotal)}}.</b></li>
              <li>Pastikan nominal yang ditransfer tepat.</li>
              <li>Screenshoot (jika dengan m-banking) atau foto bukti pembayaran (jika dari atm).</li>
              <li>Unggah bukti pembayaran di kolom <b>Bukti Pembayaran</b></li>
            </ol>
            <form enctype="multipart/form-data" method="post" action="{{route('order')}}">
              <input type="hidden" name="grandtotal" value="{{$grandtotal}}">
              <input type="hidden" name="name" value="{{$request->name}}">
              <input type="hidden" name="phone" value="{{$request->phone}}">
              <input type="hidden" name="province" value="{{$request->provincename}}">
              <input type="hidden" name="city" value="{{$request->cityname}}">
              <input type="hidden" name="postalcode" value="{{$request->postalcode}}">
              <input type="hidden" name="address" value="{{$request->alamat}}">
              <input type="hidden" name="courier" value="{{$request->courier}}">
              @csrf
              <div class="form-group">
                <label for="image">Bukti Pembayaran</label>
                <input required type="file" accept="image/*" name="image" class="form-control @error('pembayaran') is-invalid @enderror" placeholder="Bukti pembayaraan" id="pembayaran">
                @error('pembayaran')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn float-right btn-primary">Upload</a>

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