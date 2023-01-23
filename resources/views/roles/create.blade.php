@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Crea Nuovo Ruolo</h2>
        </div>

        <div class="pull-right mt-4 mb-4">
            <a class="btn btn-light" href="{{ route('roles.index') }}"> Indietro</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>

@endif


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group mb-4">
            <strong>Nome:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>

        <div class="form-group mb-4">
            <strong>Permessi:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>

            <br/>
            @endforeach
        </div>

        <button type="submit" class="btn btn-light">Crea</button>
    </div>

</div>

{!! Form::close() !!}


@endsection
