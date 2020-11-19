@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('เข้าสู่ระบบ') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('prelogin') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('ชื่อผู้ใช้') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                @error('username')
                                @if(strpos($message,'no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>ไม่พบชื่อผู้ใช้นี้</strong>
                                </span>
                                @else
                                <span class="invalid-feedback" role="alert">
                                    <strong>กรุณากรอกชื่อผู้ใช้</strong>
                                </span>
                                @endif
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                @if(strpos($message,"no"))
                                <span class="invalid-feedback" role="alert">
                                    <strong>รหัสผ่านไม่ถูกต้อง</strong>
                                </span>
                                @else
                                <span class="invalid-feedback" role="alert">
                                    <strong>กรุณากรอกรหัสผ่าน</strong>
                                </span>
                                @endif
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('เข้าสู่ระบบ') }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
