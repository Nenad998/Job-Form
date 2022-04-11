@extends('layouts.lay')

@section('content')

    <div class="container-fluid">
        <div>
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light mt-5">
                    <div class="text-center">
                        <h3 class="text-primary">Create Account</h3>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" name="firstName">
                                @error('firstName')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" class="form-control" name="lastName">
                                @error('lastName')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control" name="email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="number" class="form-control" name="phoneNumber">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Date of Birth</label>
                                <input type="date" class="form-control" name="birth">
                                @error('birth')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid col-12 mx-auto">
                                <button class="btn btn-primary btn-block" type="submit"><span></span> Sign up</button>
                            </div>
                            <p class="text-center mt-3">Already have an account?
                                <a href="{{ route('login') }}">Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
