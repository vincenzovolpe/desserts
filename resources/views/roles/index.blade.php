@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestione Ruoli</h2>
        </div>

        <div class="pull-right mt-4">
        @can('role-create')
            <a class="btn btn-light" href="{{ route('roles.create') }}"> Crea Nuovo Ruolo</a>
        @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))

    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>

@endif


<table class="table table-bordered text-white mt-4">
  <tr>
     <th>No</th>
     <th>Nome</th>
     <th width="280px">Azione</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Dettagli</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Modifica</a>
            @endcan

            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach

</table>

{!! $roles->render() !!}

@endsection
