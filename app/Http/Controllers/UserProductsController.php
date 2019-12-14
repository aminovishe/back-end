<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProduct;
use Illuminate\Http\Request;
use App\Product;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class UserProductsController extends Controller
{
    protected $model;
    protected $auth;
    protected $productRepo;

    public function __construct(UserProduct $userProduct, AuthController $authController, Product $product)
    {
        $this->model = new Repository($userProduct);
        $this->productRepo = new Repository($product);
        $this->auth = $authController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric',
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Erreur !!']);
        }

        try {
            if (!$user = $this->auth->me($request->token)) {
                return response()->json(['error' => 'Token invalid !!']);
            } else {
                $user = $this->auth->me($request->token);
                $product = $this->productRepo->show($request->productId);

                if (!$product){
                    return response()->json(['error' => 'ProductId Invalid !!']);
                } else {
                    $product->quantity = $product->quantity - (float)$request->quantity;
                    $product->save();
                }
                $userProduct = new UserProduct();
                $userProduct->setAttribute('quantity',$request->quantity);
                $userProduct->setAttribute('user_id',$user->original->id);
                $userProduct->setAttribute('product_id',$request->productId);
                $userProduct->save();

                return response()->json(['success' => 'Merci !! Vous avez achetez '. $request->quantity .' pièces avec succès.']);
            }
        } catch (Exception $e) {
            return response()->json(['code' => 404, 'message' => 'Something went wrong']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
