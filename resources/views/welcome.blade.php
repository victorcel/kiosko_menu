@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    {{ $total->links() }}
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($total as $user)
                            <div class="jumbotron">
                                <li>{{ $user->lastname }}</li>
                                <li>{{ $user->firstname }}</li>
                                <li>{{ $user->acct }}</li>
                                <li>{{ $user->resultado }}</li>
                            </div>



                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
