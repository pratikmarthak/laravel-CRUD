<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('brands.index', compact('brands'));
    }

    public function store(Request $request){
        //dd($request->all());
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_logo' => 'required|mimes:jpg,jpeg,png',
        ],[
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.max' => 'Brand Less Then 255Chars',
        ]);

        $brand_image = $request->file('brand_logo');
        $img_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $img_gen.'.'.$img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        //dd($request->all());
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_logo' => $last_img,
        ]);

        return redirect()->back()->with('success','Brand Inserted Successfully');
    }
}
