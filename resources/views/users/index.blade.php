@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestione Utenti</h2>
        </div>

        <div class="pull-right mt-4">
          @can('user-create')
            <a class="btn btn-light" href="{{ route('users.create') }}"> Crea Nuovo Utente</a>
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
   <th>Email</th>
   <th>Ruoli</th>
   <th width="280px">Action</th>
 </tr>

 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge text-bg-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>

    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Dettagli</a>
      @can('user-edit')
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Modifica</a>
      @endcan

      @can('user-delete')
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
      @endcan

    </td>

  </tr>

 @endforeach

</table>


{!! $data->render() !!}

@endsection
