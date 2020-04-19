@auth
@if(Auth::user()->role == "admin")
<div class="list-group">
        <a href="{{route('addproduct')}}" class="list-group-item">Tambah Barang</a>
        <a href="{{route('orderlist')}}" class="list-group-item">Transaksi</a>
        <a href="{{route('viewusers')}}" class="list-group-item">Pengguna</a>
</div>
@elseif(Auth::user()->role == "buyer")
<div class="list-group">
        <a href="{{route('index')}}" class="list-group-item">Semua</a>
        <a href="{{route('showbycategory','beras')}}" class="list-group-item">Beras</a>
        <a href="{{route('showbycategory','bumbu')}}" class="list-group-item">Bumbu Dapur</a>
        <a href="{{route('showbycategory','daging')}}" class="list-group-item">Daging</a>
        <a href="{{route('showbycategory','garam')}}" class="list-group-item">Garam</a>
        <a href="{{route('showbycategory','gula')}}" class="list-group-item">Gula</a>
        <a href="{{route('showbycategory','jagung')}}" class="list-group-item">Jagung</a>
        <a href="{{route('showbycategory','makanan')}}" class="list-group-item">Makanan</a>
        <a href="{{route('showbycategory','minuman')}}" class="list-group-item">Minuman</a>
        <a href="{{route('showbycategory','minyak')}}" class="list-group-item">Minyak</a>
        <a href="{{route('showbycategory','gas')}}" class="list-group-item">Minyak Tanah</a>
        <a href="{{route('showbycategory','susu')}}" class="list-group-item">Susu</a>
        <a href="{{route('showbycategory','telur')}}" class="list-group-item">Telur</a>
        <a href="{{route('showbycategory','other')}}" class="list-group-item">Lainnya</a>
</div>
@endif
@endauth
@guest
<div class="list-group">
        <a href="#" class="list-group-item">Beras</a>
        <a href="#" class="list-group-item">Bumbu Dapur</a>
        <a href="#" class="list-group-item">Daging</a>
        <a href="#" class="list-group-item">Garam</a>
        <a href="#" class="list-group-item">Gula</a>
        <a href="#" class="list-group-item">Jagung</a>
        <a href="#" class="list-group-item">Makanan</a>
        <a href="#" class="list-group-item">Minuman</a>
        <a href="#" class="list-group-item">Minyak</a>
        <a href="#" class="list-group-item">Minyak Tanah</a>
        <a href="#" class="list-group-item">Susu</a>
        <a href="#" class="list-group-item">Telur</a>
        <a href="#" class="list-group-item">Lainnya</a>
</div>
@endguest