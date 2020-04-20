<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">T-Mart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fa fa-home"></i> Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                @if(Auth::user() !== null and Auth::user()->role == "buyer")
                <li class="nav-item">
                    <a class="nav-link" href="{{route('showcart')}}"><i class="fa fa-shopping-cart"></i> Cart @auth @if(isset($cart)) <sup><span class="badge badge-pill badge-danger">{{$cart}}</span><sup>
                        @endif @endauth</a>
                </li>
                @endif
                @auth
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('orderlist')}}">Transactions</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown nav-link">
                        <label class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-o"></i> {{Auth::user()->name}}
                        </label>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('userlogout')}}">Logout</a>
                        </div>
                    </div>
                </li>
                
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>