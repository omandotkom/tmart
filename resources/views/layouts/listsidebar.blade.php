@auth
@if(Auth::user()->role == "admin")
<div class="list-group">
        <a href="{{route('addproduct')}}" class="list-group-item">Tambah Barang</a>
        <a href="{{route('orderlist')}}" class="list-group-item">Transaksi</a>
</div>
@elseif(Auth::user()->role == "buyer")
<div class="list-group">
        <a href="#" class="list-group-item">Category 1</a>
        <a href="#" class="list-group-item">Category 2</a>
        <a href="#" class="list-group-item">Category 3</a>
</div>
@endif
@endauth
@guest
<div class="list-group">
        <a href="#" class="list-group-item">Category 1</a>
        <a href="#" class="list-group-item">Category 2</a>
        <a href="#" class="list-group-item">Category 3</a>
</div>
@endguest

