<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = new Repository($product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->model->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Formulaire non valide']);
        }

        $this->model->create($request->only($this->model->getModel()->fillable));
        return response()->json(['success' => 'Produit ajouté avec succès']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->model->show($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Formulaire non valide']);
        }

        $this->model->update([
            "label" => $request->label,
            "price" => (float)$request->price,
            "quantity" => (float)$request->quantity,
        ],$id);

        return response()->json(['success' => 'Le produit a été modifié avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = $this->model->show($id);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => 'Erreur !!!']);
        }

        $product->delete();
        return response()->json(['success' => 'Produit supprimé avec succès']);

    }
}
