@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Visualizza Dessert</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-light" href="{{ route('vetrina') }}"> Indietro</a>
            </div>
        </div>
    </div>


    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Immagine:</strong>
                <img src="/image/{{ $dessert->immagine }}" width="500px">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $dessert->nome }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prezzo:</strong>
                {{ $dessert->prezzo }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Disponibilita:</strong>
                {{ $dessert->disponibilita }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descrizione:</strong>
                {{ $dessert->descrizione }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ingredienti: </strong>
                @foreach ($dessert->ingredients as $ingrediente)
                    {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}} ,
                @endforeach
            </div>
        </div>


    </div> --}}

    <div class="row">

        <div class="col-sm-12">

            <h1 class="post-title">{{ $dessert->nome }}</h1>

            <img class="col-md-4" src="{{ asset("/image/$dessert->immagine")}}">

            <div class="post-content">

                {{ $dessert->descrizione }}

            </div>

            <br>

            <p>Ingredienti: @foreach ($dessert->ingredients as $ingrediente)
                {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}} ,
                @endforeach</p>

            <p>Prezzo: € {{ $dessert->prezzo_vendita }}</p>

            <p>Disponibilità: {{ $dessert->disponibilita }}</p>

        </div>

    </div>
@endsection

