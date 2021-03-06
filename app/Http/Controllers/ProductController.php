<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Tag;
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
        return view('products.create',[
        'colors'=>Color::all(),
        'sizes'=>Size::all(),
        'categories'=>Category::all(),
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
        $validatedData = $request->validate([
            'titleFr'=>'required|max:40',
            'descFr'=>'required|max:200',
            'titleAr'=>'required|max:40',
            'descAr'=>'required|max:200',
            'price'=>'required|numeric',
            'category'=>'required',
            'filename'=>'required',
            'filename.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);


        //dd($request->input('category'));
        $product = Product::create($validatedData);
        $colors = Color::all();
        $categories = Category::all();
        $sizes = Size::all();
        $color_stock = $request->input('color_stock');
        $size_stock = $request->input('size_stock');

        if($request->hasfile('filename'))

        {

            foreach($request->file('filename') as $key=>$file)
            {

                $input['imagename'] = time().'.'.$file->extension();

                $destinationPath = public_path('thumbnails');
                $img = Image::make($file->path());
                $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);

                $destinationPath = public_path('images');
                $file->move($destinationPath, $input['imagename']);
                $color = $colors[$key];
                $picture = Picture::create(['filename'=>$input['imagename'],'color_id'=>$color->id]);
                $product->pictures()->save($picture);

                $product->colors()->attach($color->id,['stock'=>$color_stock[$key]]);

              //  $color->products()->attach($product->id,['stock'=>$color_stock[$key]]);

            }

            foreach($sizes as $key=>$size) {
                if($size_stock[$key]!=0) {
                    $product->sizes()->attach($size->id,['stock'=>$size_stock[$key]]);
                }
            }
        }
        foreach ($request->input('category') as $key => $category) {
            if($category) {
                $product->categories()->attach($categories[$key]->id);
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
