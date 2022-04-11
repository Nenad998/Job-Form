@if(\Session::has('successSubmit'))
    <div class="alert alert-success text-center mt-3">
        {{ \Session::get('successSubmit') }}
    </div>
@endif


@if(\Session::has('alreadySent'))
    <div class="alert alert-danger text-center mt-3">
        {{ \Session::get('alreadySent') }}
    </div>
@endif

@if(\Session::has('delete'))
    <div class="alert alert-danger text-center mt-3">
        {{ \Session::get('delete') }}
    </div>
@endif

@if(\Session::has('mustLogged'))
    <div class="alert alert-danger text-center mt-3">
        {{ \Session::get('mustLogged') }}
    </div>
@endif
