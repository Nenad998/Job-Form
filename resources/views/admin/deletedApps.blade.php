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
            <li><a class="nav-link"  href="{{ route('admin.home') }}">Home</a> </li>
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
        @foreach($trashedApps as $app)
            <tr>
                <td>{{ \Carbon\Carbon::parse($app->job->date)->format('d/m/Y') }}</td>
                <td>{{ $app->id }}</td>
                <td>{{ $app->user->firstName }}</td>
                <td>{{ $app->user->lastName }}</td>
                <td>{{ $app->user->email }}</td>
                <td>{{ $app->user->phoneNumber }}</td>
                <td>{{ \Carbon\Carbon::parse($app->user->birth)->format('d/m/Y') }}</td>
                <td>{{ $app->job->name }}</td>
                <td>{{ $app->experience }}</td>
                <td>{{ $app->status }}</td>
                <td>
                    <form class="formButton" action="{{ route('restore', $app->id) }}" method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                    </form>
                    <form class="formButton" action="{{ route('delete', $app->id) }}" method="post">
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

</body>
</html>
