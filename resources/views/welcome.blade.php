@extends('layouts.lay')

@section('content')

<div class="container">
    @include('flash.flashMessages')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 class="mt-3 mb-3">Job applications</h2>
            <form action="{{ route('submitForm') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    @if(Auth::user())
                        <input type="text" class="form-control" name="firstName" value="{{ Auth::user()->firstName }}">
                        @error('firstName')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @else
                        <input type="text" class="form-control" name="firstName">
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    @if(Auth::user())
                        <input type="text" class="form-control" name="lastName" value="{{ Auth::user()->lastName }}">
                        @error('lastName')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @else
                        <input type="text" class="form-control" name="lastName">
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    @if(Auth::user())
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @else
                        <input type="email" class="form-control" name="email">
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    @if(Auth::user())
                        <input type="number" class="form-control" name="phoneNumber" value="{{ Auth::user()->phoneNumber }}">
                    @else
                        <input type="number" class="form-control" name="phoneNumber">
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputState">Job</label>
                    <select id="inputState" class="form-control" name="job_id">
                        @foreach($jobs as $job)
                           <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @error('job_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="experience">
                    <label class="form-check-label" for="inlineCheckbox1">Previous experience</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            @if(Auth::user() && Auth::user()->role == 0)
                <a class="btn btn-success" href="{{ route('appDetails') }}" role="button">Details about sent application</a>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

@endsection

