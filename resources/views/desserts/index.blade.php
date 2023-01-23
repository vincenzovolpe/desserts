@extends('layouts.app')
@section('content')


        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Gestione Desserts</h2>
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

        {{-- <div class="container">
            <!-- Content here -->
        </div> --}}


        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered text-white mt-4">
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

                        {{-- @php
                            echo $dessert;
                        @endphp --}}
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><img src="/image/{{ $dessert->immagine }}" width="100px"></td>
                            <td>{{ $dessert->nome }}</td>
                            <td>{{ $dessert->descrizione }}</td>
                            <td>
                                @foreach ($dessert->ingredients as $ingrediente)
                                {{$ingrediente->pivot->quantita}} {{$ingrediente->pivot->unita_misura}} {{$ingrediente->nome}}@unless($loop->last)
                                ,
                                @endunless
                                @endforeach
                            </td>
                            <td>€ {{ $dessert->prezzo }}</td>
                            <td>{{ $dessert->disponibilita }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('desserts.show',$dessert->id) }}">Dettagli</a>
                                @can('product-edit')
                                <a class="btn btn-warning" href="{{ route('desserts.edit',$dessert->id) }}">Modifica</a>
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
                </div>
            {!! $desserts->links() !!}
        </div>

@endsection
