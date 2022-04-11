@extends('layouts.lay')

@section('content')

    <div class="container-fluid mt-2">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Job</th>
                <th scope="col">Experience</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applicationDetails as $apps)
                <tr>
                    <td>{{ $apps->user->firstName }}</td>
                    <td>{{ $apps->user->lastName }}</td>
                    <td>{{ $apps->user->email }}</td>
                    <td>{{ $apps->user->phoneNumber }}</td>
                    <td>{{ \Carbon\Carbon::parse($apps->user->birth)->format('d/m/Y') }}</td>
                    <td>{{ $apps->job->name }}</td>
                    <td>{{ $apps->experience }}</td>
                    <td>{{ $apps->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
