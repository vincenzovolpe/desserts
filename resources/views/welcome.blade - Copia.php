@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Desserts</h2>
            </div>

            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('desserts.create') }}"> Crea nuovo Dessert</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Immagine</th>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Ingredienti</th>
            <th>Prezzo</th>
            <th>Disponibilita</th>
            <th width="280px">Azione</th>
        </tr>

	    @foreach ($desserts as $dessert)

	    <tr>
	        <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $dessert->immagine }}" width="100px"></td>
	        <td>{{ $dessert->nome }}</td>
	        <td>{{ $dessert->descrizione }}</td>
            <td>
                @foreach ($dessert->ingredients as $ingrediente)
                {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}} ,
                @endforeach
            </td>
            <td>€ {{ $dessert->prezzo_vendita }}</td>
            <td>{{ $dessert->disponibilita }}</td>
	        <td>
                <a class="btn btn-info" href="{{ route('visualizza',$dessert->id) }}">Visualizza</a>
                @can('product-edit')
                <a class="btn btn-primary" href="{{ route('desserts.edit',$dessert->id) }}">Modifica</a>
                @endcan

                @can('product-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['desserts.destroy', $dessert->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Cancella', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                @endcan
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $desserts->links() !!}

@endsection
