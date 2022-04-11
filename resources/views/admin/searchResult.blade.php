<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Admin</title>
    <style>
        .formButton{
            display: inline-block;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if(Auth::user())
                <li>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        Logout
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-primary btn-sm" href="{{ route('deletedApps') }}" role="button">Deleted applications</a>
        </div>
        <div class="col-md-4">
            <form method="get" action="/search" class="d-flex">
                <input class="form-control me-2" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" type="text">
                <input class="btn btn-primary" type="submit" value="Search">
            </form>
        </div>
    </div>
</div>


<div class="container-fluid mt-2">

    @include('flash.flashMessages')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Submited Date</th>
            <th scope="col">Application ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Job</th>
            <th scope="col">Experience</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($searchResults as $apps)
            <tr>
                <td>{{ \Carbon\Carbon::parse($apps->date)->format('d/m/Y') }}</td>
                <td>{{ $apps->id }}</td>
                <td>{{ $apps->firstName }}</td>
                <td>{{ $apps->lastName }}</td>
                <td>{{ $apps->email }}</td>
                <td>{{ $apps->phoneNumber }}</td>
                <td>{{ \Carbon\Carbon::parse($apps->birth)->format('d/m/Y') }}</td>
                <td>{{ $apps->name }}</td>
                <td>{{ $apps->experience }}</td>
                <td>{{ $apps->status }}</td>
                <td>
                    <form class="formButton" action="{{ route('approve') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="formId" value="{{ $apps->id }}">
                        <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                    </form>
                    <form class="formButton" action="{{ route('deny') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="formId" value="{{ $apps->id }}">
                        <button type="submit" class="btn btn-warning btn-sm">Deny</button>
                    </form>
                    <form class="formButton" action="{{ route('softDelete', $apps->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <div class="row">
        {{ $searchResults->links() }}
    </div>
</div>

</body>
</html>
