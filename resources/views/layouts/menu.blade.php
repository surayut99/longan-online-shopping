<div class="d-flex lg-nav navbar navbar-expand-lg navbar-light lg-nav-menu" style="background-color: whitesmoke">

    <div class="d-flex mr-auto">

        <a class="nav-link" href="{{route('pages.home')}}">
            <img src="{{asset('storage/pictures/icons/logo.png')}}" style="height:50px">
            หน้าหลัก
        </a>
    </div>
    <div class="d-flex ml-auto">
        @auth
        @if(Auth::user()->role == 'seller')
        <a class="nav-link" href={{route('products.index')}}>จัดการสินค้า</a>
        @endif
        <a class="nav-link" href="{{route('profile.index')}}">โปรไฟล์</a>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('ออกจากระบบ') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @else
        @if (Route::has('register'))
        <a class="nav-link" href="{{route('register')}}">ลงทะเบียน</a>
        @endif
        @if (Route::has('login'))
        <a class="nav-link" href="{{route('login')}}">เข้าสู่ระบบ</a>
        @endif
        @endauth
    </div>
</div>
