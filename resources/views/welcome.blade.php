@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-uppercase fw-bold mb-4 text-center">
                <h2>Lista Desserts disponibili</h2>
            </div>

            <div class="pull-right mt-4">
                @can('product-create')
                <a class="btn btn-light" href="{{ route('desserts.create') }}"> Crea nuovo Dessert</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

        {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> --}}

        <div class="row mt-4 data-masonry='{"percentPosition": true }'>
          @foreach ($desserts as $dessert)
          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="film card img-fluid mb-2 colonna">
                <div class="flip-box-inner">
                    <div class="flip-box-front">
                        <img class="card-img-top" src="/image/{{ $dessert->immagine }}" alt="{{ $dessert->nome }}">
                        <div class="card-img-overlay_normal">

                            <p class="top-left btn btn-light text-uppercase fw-bold">{{ $dessert->nome }}</p>
                            <p class="bottom-left btn btn-success btn-sm fw-bold">€ {{ $dessert->prezzo_vendita }}</p>
                            <p class="bottom-right btn btn-warning btn-sm fw-bold">{{ $dessert->disponibilita }} pz</p>
                        </div>
                    </div>
                    <div class="card-img-overlay">
                        <h4 class="card-title text-center">{{ $dessert->nome }}</h4>

                        <p class="card-text text-justify overview"><span>Descrizione: </span>{{ $dessert->descrizione }}</p>
                        <p class="card-text text-justify overview"><span>Ingredienti: </span>@foreach ($dessert->ingredients as $ingrediente)
                            {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}}@unless($loop->last)
                            ,
                            @endunless
                            @endforeach</p>


                    </div>
                    {{-- <div class="card-body"> --}}

                        {{-- <h4 class="card-title">{{ $dessert->nome }}</h4> --}}
                        {{-- <p class="card-text"> </p>
                        <a href="#" class="btn btn-success btn-sm">€ {{ $dessert->prezzo_vendita }}</a> --}}
                    {{-- </div> --}}
                    {{-- <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">

                        <div class="views">

                        </div>

                        <div class="stats">


                            <p class="card-text text-warning">Disponibilità: {{ $dessert->disponibilita }}</p>
                        </div>



                    </div> --}}
                </div>
            </div>
          </div>

          @endforeach

        </div>
        <div class="d-flex justify-content-center">
            {!! $desserts->links() !!}
        </div>



    {{-- <div class="row" data-masonry='{"percentPosition": true }''>

        @forelse ($desserts as $dessert)
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">

                    <img class="card-img" src="/image/{{ $dessert->immagine }}" alt="">

                    <div class="card-img-overlay">

                        <a href="#" class="btn btn-light btn-sm">€ {{ $dessert->prezzo_vendita }}</a>

                    </div>

                    <div class="card-body">

                        <h4 class="card-title">{{ $dessert->nome }}</h4>


                        <a class="btn btn-success stretched-link" style="position: relative;" href="{{ route('visualizza',$dessert->id) }}">Leggi di più</a>

                    </div>

                    <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">

                        <div class="views">

                        </div>

                        <div class="stats">

                            Disponibilità: {{ $dessert->disponibilita }}

                        </div>



                    </div>

                </div>
            </div>
        @empty

            <li>Non ci sono post</li>

        @endforelse

        {{ $desserts->links() }}

    </div> --}}

@endsection
