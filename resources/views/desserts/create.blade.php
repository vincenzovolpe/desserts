@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Aggiungi Nuovo Dessert</h2>
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


    {!! Form::open(array('route' => 'desserts.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}

         <div class="row justify-content-center text-white">

            <div class="col-xs-12 col-sm-12 col-md-6">
		        <div class="form-group mb-4">
		            <strong>Nome:</strong>
                    {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
		        </div>

		        <div class="form-group mb-4">
		            <strong>Descrizione:</strong>
                    {!! Form::textarea('descrizione', null, array('placeholder' => 'Descrizione','class' => 'form-control')) !!}
		        </div>

		        <div class="form-group mb-4">
		            <strong>Prezzo:</strong>
                    {!! Form::number('prezzo', null, array('placeholder' => 'Prezzo','class' => 'form-control')) !!}
		        </div>

		        <div class="form-group mb-4">
		            <strong>Disponibilita:</strong>
                    {!! Form::number('disponibilita', null, array('placeholder' => 'Disponibilita','class' => 'form-control')) !!}
		        </div>


                <div class="form-group mb-4">
                    <strong>Ingredienti:</strong>
                    <table>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td><input {{ $ingredient->value ? 'checked' : null }} data-id="{{ $ingredient->id }}" type="checkbox" class="ingredient-enable"></td>
                                <td>{{ $ingredient->nome }}</td>
                                <td><input value="{{ $ingredient->value ?? null }}" {{ $ingredient->value ? null : 'disabled' }} data-id="{{ $ingredient->id }}" name="ingredients_quantita[{{ $ingredient->id }}]" type="text" class="ingredient-amount form-control" placeholder="Quantità"></td>
                                <td><input value="{{ $ingredient->value ?? null }}" {{ $ingredient->value ? null : 'disabled' }} data-id="{{ $ingredient->id }}" name="ingredients_misura[{{ $ingredient->id }}]" type="text" class="ingredient-misura form-control" placeholder="Unità di misura"></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {!! Form::select('ingredients[]', $ingredients,[], array('class' => 'form-control','multiple')) !!} --}}
                </div>

                <div class="form-group mb-4">
                    <strong>Immagine Dessert:</strong>
                    {!! Form::file('immagine', null) !!}
                </div>

		            <button type="submit" class="btn btn-light">Inserisci</button>
		    </div>

		</div>
    </form>

@endsection
