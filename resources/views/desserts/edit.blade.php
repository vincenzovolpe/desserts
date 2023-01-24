@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifica Dessert</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a class="btn btn-light" href="{{ route('desserts.index') }}"> Indietro</a>
            </div>
        </div>
    </div>


    @if ($errors->any())

        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif


    <form action="{{ route('desserts.update',$dessert->id) }}" method="POST" enctype="multipart/form-data">

    	@csrf

        @method('PUT')


         <div class="row justify-content-center text-white">

		    <div class="col-xs-12 col-sm-12 col-md-6">
		        <div class="form-group mb-4">
		            <strong>Nome:</strong>
		            <input type="text" name="nome" value="{{ $dessert->nome }}" class="form-control" placeholder="Nome">
		        </div>

		        <div class="form-group mb-4">
		            <strong>Descrizione:</strong>
		            <textarea class="form-control" style="height:150px" name="descrizione" placeholder="Descrizione">{{ $dessert->descrizione }}</textarea>
		        </div>

		        <div class="form-group mb-4">
		            <strong>Prezzo:</strong>
		            <input type="number" name="prezzo" value="{{ $dessert->prezzo }}" class="form-control" placeholder="Prezzo">
		        </div>

		        <div class="form-group mb-4">
                    <strong>Disponibilita:</strong>
		            <input type="number" name="disponibilita" value="{{ $dessert->disponibilita }}" class="form-control" placeholder="Disponibilita">
		        </div>

                <div class="form-group mb-4">
                    <strong>Ingredienti:</strong>
                    <table>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td><input {{ $ingredient->value_quantita ? 'checked' : null }} data-id="{{ $ingredient->id }}" type="checkbox" class="ingredient-enable"></td>
                                <td>{{ $ingredient->nome }}</td>
                                <td><input value="{{ $ingredient->value_quantita ?? null }}" {{ $ingredient->value_quantita ? null : 'disabled' }} data-id="{{ $ingredient->id }}" name="ingredients_quantita[{{ $ingredient->id }}]" type="text" class="ingredient-amount form-control" placeholder="Quantità"></td>
                                <td><input value="{{ $ingredient->value_misura ?? null }}" {{ $ingredient->value_misura ? null : 'disabled' }} data-id="{{ $ingredient->id }}" name="ingredients_misura[{{ $ingredient->id }}]" type="text" class="ingredient-misura form-control" placeholder="Unità di misura"></td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="form-group mb-4">
                    <strong>Immagine:</strong>
                    <input type="file" name="image" class="form-control" placeholder="immagine">
                    <img src="{{ asset("/image/$dessert->immagine")}}" width="300px">
                </div>

		      <button type="submit" class="btn btn-light">Modifica</button>
		    </div>

		</div>

    </form>

@endsection
