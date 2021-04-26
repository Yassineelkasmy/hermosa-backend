<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index',['products'=>Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title_fr'=>'required|max:40',
            'desc_fr'=>'required|max:200',
            'title_ar'=>'required|max:40',
            'desc_ar'=>'required|max:200',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'filename'=>'required',
            'filename.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);



        $product = Product::create($validatedData);
        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $file)
            {

                $input['imagename'] = time().'.'.$file->extension();

                $destinationPath = public_path('thumbnails');
                $img = Image::make($file->path());
                $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);

                $destinationPath = public_path('images');
                $file->move($destinationPath, $input['imagename']);
                $picture = Picture::create(['filename'=>$input['imagename']]);
                $product->pictures()->save($picture);

            }
        }

        $request->session()->flash('status','Product was created !');

        return redirect()->route('products.show',['product'=>$product->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {



        //$request->session()->reflash();
        return view('products.show',['product'=>Product::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit', ['product'=>Product::findOrFail($id)]);
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
        $validatedData = $request->validate([
            'title'=>'required|max:40',
            'description'=>'required|max:200',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',

        ]);


        $product = Product::findOrFail($id);
        $product->fill($validatedData);
        $product->save();

        $request->session()->flash('status','Product was updated !');

        return redirect()->route('products.show',['product'=>$product->id]);
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
