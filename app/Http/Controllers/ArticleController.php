<?php

namespace App\Http\Controllers;

use App\Models\CloudFile;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(){
        $articles= Product::where('vendor_id', auth('vendor')->user()->id)->latest()->with('image')->get();
        return view('dashboard.vendors.articles.index',compact('articles'));
        
    }
    public function create(){
        return view('dashboard.vendors.articles.create');

    }
    public function handleCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'description' =>'required',
            'price' => 'required|integer'
            
            
            // 'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Le nom du produit est requis',
            'description.required' => 'La description du produit est requise',
            'price.required' => 'Le prix du produit est requis',
            // 'price.integer' => 'price must be integer',
            // // 'image.required' => 'required',
            // 'image.image' => 'must be an image',

        ]);

        try {
            DB::beginTransaction();
            $productData = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'vendor_id' =>auth('vendor')->user()->id,
            ];
            // dd($request);

            $product = Product::create($productData);


            $this->handleImageUpload($product, $request,'image', 'cloud_files/articles','cloud_file_id');

            //gerer ici l'upload des images

           

            // dd($productData);


            DB::commit();
            return redirect()->route('articles.index')->with('success', 'Produit enregistré');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete(Product $article)
    {
        $article->delete();
        return back()->with("successDelete", "Article supprimé avec succès");
    }
    public function handleImageUpload($data, $request, $inputKey,$destination,$attributeName){

     if ($request->hasFile($inputKey
     
     )){
                //chemin vers le fichier
            $filePath = $request->file($inputKey)->store( "$destination", 'public');

            $cloudFile = CloudFile::create([
                'path' => $filePath
            ]);
            $data->{$attributeName} = $cloudFile->id;
            $data->update();
     }
    }
}
