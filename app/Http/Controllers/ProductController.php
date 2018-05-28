<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Corcel\Model\Post;
use App\ProductImage;
use Woocommerce;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
    	$partner_id = Auth::id();
    	$products = Post::type('product')->hasMeta('_partner_id', $partner_id)->whereIn('post_status', ['publish', 'pending'])->orderBy('ID', 'desc')->paginate(10);
    	return view('product.index', array('products' => $products));
    }

    public function create() {
    	return view('product.create');
    }

    public function store(Request $request) {
        $partner_id = Auth::user()->id;

        $data = array(
            'name' => $request->input('product_name'),
            'type' => 'simple',
            'regular_price' => $request->input('price'),
            'description' => $request->input('description'),
            'status' => 'pending',
            'meta_data' => [
                [
                    'key' => '_lat_value',
                    'value' => $request->input('lat')
                ],
                [
                    'key' => '_long_value',
                    'value' => $request->input('lng')
                ],
                [
                    'key' => '_address_value',
                    'value' => $request->input('address')
                ],
                [
                    'key' => '_partner_id',
                    'value' => $partner_id
                ],
                [
                    'key' => '_price_private_value',
                    'value' =>  $request->input('private_price')
                ]
            ],
        );

        $product = Woocommerce::post('products', $data);

        if($request->hasFile('images')) {
            $root = url('/');
            $image_data = []; // use for update product
            $product_id = $product['id'];

            $i = 0;
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
        return redirect("/product");
    }

    public function edit($id) {
        $product = Post::find($id);
        $product_data = [
            'id' => $product->ID,
            'title' => $product->post_title,
            'description' => $product->post_content,
            'price' => $product->_regular_price,
            'private_price' => $product->_price_private_value,
            'lat_value' => $product->_lat_value,
            'long_value' => $product->_long_value,
            'address' => $product->_address_value
        ];
        return view('product.edit', ['product_data' => $product_data]);
    }

    public function update($id, Request $request) {
        $data = [
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'regular_price' => $request->input('price'),
            'meta_data' => [
                [
                    'key' => '_price_private_value',
                    'value' => $request->input('private_price')
                ],
                [
                    'key' => '_lat_value',
                    'value' => $request->input('lat')
                ],
                [
                    'key' => '_long_value',
                    'value' => $request->input('lng')
                ],
                [
                    'key' => '_address_value',
                    'value' => $request->input('address')
                ]
            ]
        ];

        Woocommerce::put('products/'.$id, $data);
        session(['product_id' => $id]);

        return redirect('/product/images');
    }

    public function show($id) {
        return redirect('/product');
    }

    public function destroy($id) {    
        $attachments = Post::where('post_parent', $id)->get();
        $deleteList = [];
        foreach ($attachments as $attachment) {
            $image = ProductImage::where('image_wp_post_id', $attachment->ID)->get();
            $filename = $image[0]->filename;
            array_push($deleteList, 'public/images/'.$filename);
            //delete attachment image in wordpress
            $attachment->delete();
        }
        //delete image in laravel storage
        Storage::delete($deleteList);
        // delete all record of this product in product image table
        ProductImage::where('product_id', $id)->delete();
        // delete product
        Post::find($id)->delete();
        
        return redirect('/product');
    }
}
