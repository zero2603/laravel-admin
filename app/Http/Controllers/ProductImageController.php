<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ProductImage;
use Corcel\Model\Post;
use Woocommerce;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if(session()->has('product_id')) {
            $id = session('product_id');
            $images = ProductImage::where('product_id', $id)->get();
            return view('product.image', ['product_images' => $images]);
        } else 
            return redirect('/product');
    }

    public function create() {
    	return view('product.add-image');
    }

    public function store(Request $request) {
    	if($request->hasFile('images')) {
            $root = url('/');
            $image_data = []; // use for update product
            $product_id = session('product_id');

            $i = 0; // position
            $deleteList = [];   // list image of product in wordpress
            $localDeleteList = [];  // list image of product in laravel storage
            //get all old images
            $old_images = Woocommerce::get('products/'.$product_id)['images'];

            foreach ($old_images as $key => $value) {
                // push old images into array to use update 
                array_push($image_data, [
                    'src' => $value['src'],
                    'position' => $key
                ]);
                // push old image into delete array
                $filename = basename($value['src']);
                array_push($deleteList, $value['id']);
                array_push($localDeleteList, 'public/images/'.$filename);
                $i++;
            }
            // delete old image in both wordpress and laravel
            Post::whereIn('ID', $deleteList)->delete();
            // Storage::delete($localDeleteList);

            // push new image into array to update
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $image->store('public/images');

                // save in database
                $imageProduct = new ProductImage([
                    'filename' => $filename,
                    'product_id' => $product_id,
                    'image_wp_post_id' => 0 //default value
                ]);
                $imageProduct->save();

                // add image data to array
                array_push($image_data, [
                    'src' => $root. '/storage/app/public/images/'. $filename,
                    'position' => $i
                ]);
                $i++;
            }
            if(!empty($image_data)) {
                $product = Woocommerce::put('products/'.$product_id, ['images' => $image_data]);
                $imageList = ProductImage::where('product_id', $product_id)->get();
                foreach ($imageList as $key => $image) {
                    $image->image_wp_post_id = $product['images'][$key]['id'];
                    $image->save();
                }
            }
        }
        
    	return redirect('product');
    }

    public function destroy($id) {
        $image = ProductImage::find($id);
        $filename = $image->filename;
        Post::find($image->image_wp_post_id)->delete();
        Storage::delete('public/images/'.$filename);
        $image->delete();
        return redirect('/product/images');
    } 
}
