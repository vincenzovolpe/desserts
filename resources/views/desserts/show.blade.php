@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Visualizza Dessert</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a class="btn btn-light" href="{{ route('desserts.index') }}"> Indietro</a>
            </div>
        </div>
    </div>


    <div class="row text-white justify-content-center">

        <div class="col-sm-6">

                <div class="form-group text-center mb-4">
                    {{-- <strong>Immagine:</strong> --}}
                    <img src="{{ asset("/image/$dessert->immagine")}}" width="500px">
                </div>

                <div class="form-group mb-4">
                    <strong>Nome:</strong>
                    {{ $dessert->nome }}
                </div>

                <div class="form-group mb-4">
                    <strong>Prezzo:</strong>
                    {{ $dessert->prezzo }}
                </div>

                <div class="form-group mb-4">
                    <strong>Disponibilità:</strong>
                    {{ $dessert->disponibilita }}
                </div>

                <div class="form-group mb-4 giustificato">
                    <strong>Descrizione:</strong>
                    {{ $dessert->descrizione }}
                </div>

                <div class="form-group mb-4">
                    <strong>Ingredienti: </strong>
                    @foreach ($dessert->ingredients as $ingrediente)
                        {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}}@unless($loop->last)
                        ,
                        @endunless
                    @endforeach
                </div>


        </div>




    </div>

    @endsection

