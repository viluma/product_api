<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use App\API\ApiError;


class ProductController extends Controller
{   
    private $product;
    public function __construct(Product $product){

        $this->Product=$product;
    }

    
    public function index(){


        return response()->json($this->Product->paginate(10));
    }

    public function show(Product $id){
        $product=$this->Product->find($id);
        if(!$product){
            return response()->json(['msg' => 'Produto nao encontrado!'], 211);
        }
        $data=['data'=>$product];
        
    }
    public function store(Request $request)
    { 
        try {
            
            $productData = $request->all();
            $this->Product->create($productData);
            return response()->json(['msg' => 'Produto criado com sucesso!'], 211);

        }catch (\Exception $e){
            if (config('app.debug')){
                return response()-> json(ApiError::errorMessage($e->getMessage(), 1010));

            }
            return response()->json(ApiError::errorMessage('Houve uma erro ao realizar a operacao',1010));

        }
    
    
    
    }
    public function update(Request $request, $id)
    { 
        try {
            
            $productData = $request->all();
            $product = $this->Product->find($id);
            $product->update($productData);
            return response()->json(['msg' => 'Produto actualizado com sucesso!'], 211);

        }catch (\Exception $e){
            if (config('app.debug')){
                return response()-> json(ApiError::errorMessage($e->getMessage(), 1011));

            }
            return response()->json(ApiError::errorMessage('Houve uma erro ao realizar a operacao de actualizacao',1011));

        }
    
    
    
    }
    public function delete(Product $id)
    { 
        try {
            
            $id->delete();
            return response()->json(['msg' => 'Produto '.$id->name.' removido com sucesso!'], 200);

        }catch (\Exception $e){
            if (config('app.debug')){
                return response()-> json(ApiError::errorMessage($e->getMessage(), 1012));

            }
            return response()->json(ApiError::errorMessage('Houve uma erro ao realizar a operacao de remocao',1012));

        }
    
    
    
    }
		

}
