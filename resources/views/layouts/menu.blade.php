<div class="d-flex lg-nav navbar navbar-expand-lg navbar-light lg-nav-menu" style="background-color: whitesmoke">
    <div class="d-flex mr-auto">
        <a href="{{route('pages.home')}}">
            Longan
        </a>
    </div>
    <div class="d-flex ml-auto lg-space-l">
        @auth
        @if(Auth::user()->role == 'seller')
        <a href={{route('products.index')}}>จัดการสินค้า</a>
        @endif
        <a href="{{route('profile.index')}}">โปรไฟล์</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('ออกจากระบบ') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @else
        @if (Route::has('register'))
        <a href="{{route('register')}}">ลงทะเบียน</a>
        @endif
        @if (Route::has('login'))
        <a href="{{route('login')}}">เข้าสู่ระบบ</a>
        @endif
        @endauth
    </div>
</div>
