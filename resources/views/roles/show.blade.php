@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>

        <div class="pull-right mt-4 mb-4">
            <a class="btn btn-light" href="{{ route('roles.index') }}"> Indietro</a>
        </div>
    </div>
</div>


<div class="row text-white">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }}@unless($loop->last)
                        ,
                        @endunless</label>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
