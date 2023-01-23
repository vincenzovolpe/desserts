<?php

namespace App\Http\Controllers;

use App\Models\Dessert;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class DessertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // set permission
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $user = Auth::user();
        $ruolo_user = $user->getRoleNames();

        if($ruolo_user[0] != 'Admin') {
            $id = Auth::id();

            $desserts = Dessert::with('ingredients')->where('user_id', $id)->latest()->paginate(6);
        } else {
            $desserts = Dessert::with('ingredients')->latest()->paginate(6);
        }



        // Gestiamo i prezzi e la messa in vendita o il ritiro
        foreach ($desserts as $dessert) {
            $data_dessert = date_format($dessert->updated_at,"d-m-Y h:i:s");
            $data_attuale = date('d-m-Y h:i:s');

            $dateDiff = $this->dateDiffInDays($data_attuale, $data_dessert);

            switch ($dateDiff) {
                case '0':
                    $dessert->prezzo_vendita = $dessert->prezzo;
                    $dessert->save();
                    break;
                case '1':
                    $prezzo_finale = $this->cal_percentage(80, $dessert->prezzo);
                    $dessert->prezzo_vendita = $prezzo_finale;
                    $dessert->save();
                    break;
                case '2':
                    $prezzo_finale = $this->cal_percentage(20, $dessert->prezzo);
                    $dessert->prezzo_vendita = $prezzo_finale;
                    $dessert->save();
                    break;
                case '3':
                    $dessert->vendita = 0;
                    $dessert->save();
                    break;
            }
        }

        // Etichetta Prodotto non disponibile o scaduto
        foreach ($desserts as $dessert) {
            if($dessert->disponibilita == 0) {
                $dessert->disponibilita = $dessert->disponibilita. " (Prodotto esaurito)";
            }
            if($dessert->vendita == false) {
                $dessert->disponibilita = $dessert->disponibilita. " (Prodotto scaduto)";
            }
        }

        return view('desserts.index', compact('desserts'))->with('i', (request()->input('page', 1) - 1) * 6);
    }

    private function dateDiffInDays($data_attuale, $data_dessert)
    {

        $diff = strtotime($data_attuale) - strtotime($data_dessert);

        return (int)($diff / 86400);
    }

    private function cal_percentage($percentuale, $totale) {
        $prezzo = ($percentuale / 100) * $totale;
        return $prezzo;
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('desserts.create', [
            'ingredients' => Ingredient::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Trovo l'id dell' utente connesso
        $id = Auth::id();

        $request->validate([
            'nome' => 'required',
            'descrizione' => 'required',
            'prezzo' => 'required',
            'immagine' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'

        ]);

        $input = $request->all();

        //dd($input);

        if ($image = $request->file('immagine')) {
            $destinationPath = 'image/';
            $dessertImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $dessertImage);
            $input['immagine'] = "$dessertImage";
        }

        $input['user_id'] = $id;

        $dessert = Dessert::create($input);

        $dessert->ingredients()->sync($this->mapIngredientsQuantita($input['ingredients_quantita']));

        $dessert->ingredients()->sync($this->mapIngredientsMisura($input['ingredients_misura']));

        return redirect()->route('desserts.index')->with('success', 'Dessert creato con successo.');
    }


    private function mapIngredientsQuantita($ingredients)
    {
        return collect($ingredients)->map(function ($i) {
            return ['quantita' => $i];
        });
    }

    private function mapIngredientsMisura($ingredients)
    {
        return collect($ingredients)->map(function ($i) {
            return ['unita_misura' => $i];
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dessert  $dessert
     * @return \Illuminate\Http\Response
     */

    public function show(Dessert $dessert)
    {

        $desserts = Dessert::with('ingredients');

        return view('desserts.show', compact('dessert'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dessert  $dessert
     * @return \Illuminate\Http\Response
     */

    public function edit(Dessert $dessert)
    {
        $dessert->load('ingredients');

        $ingredients = Ingredient::get()->map(function ($ingredient) use ($dessert) {
            $ingredient->value_quantita = data_get($dessert->ingredients->firstWhere('id', $ingredient->id), 'pivot.quantita') ?? null;
            $ingredient->value_misura = data_get($dessert->ingredients->firstWhere('id', $ingredient->id), 'pivot.unita_misura') ?? null;
            return $ingredient;
        });

        return view('desserts.edit', [
            'ingredients' => $ingredients,
            'dessert' => $dessert,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dessert  $dessert
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Dessert $dessert)
    {
        $request->validate([
            'nome' => 'required',
            'descrizione' => 'required',
            'prezzo' => 'required'
            //'immagine' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $dessertImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $dessertImage);
            $input['immagine'] = "$dessertImage";
        } else {
            unset($input['immagine']);
        }

        $dessert->update($input);

        $dessert->ingredients()->sync($this->mapIngredientsQuantita($input['ingredients_quantita']));

        $dessert->ingredients()->sync($this->mapIngredientsMisura($input['ingredients_misura']));

        return redirect()->route('desserts.index')->with('success', 'Dessert aggiornato  con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dessert  $dessert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dessert $dessert)
    {
        $ImagePath = 'image/' . $dessert->image;
        unset($ImagePath);
        $dessert->delete();
        return redirect()->route('desserts.index')->with('success', 'Dessert cancellato con successo');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dessert  $dessert
     * @return \Illuminate\Http\Response
     */
}
