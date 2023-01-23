@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Profilo Utente </h2>
        </div>

        <div class="pull-right mt-4 mb-4">
            <a class="btn btn-light" href="{{ route('users.index') }}"> Indietro</a>
        </div>
    </div>
</div>


<div class="row text-white">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $user->name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Ruoli:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge text-bg-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>

</div>

@endsection
