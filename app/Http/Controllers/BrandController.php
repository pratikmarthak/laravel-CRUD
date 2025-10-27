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

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_logo' => 'required|mimes:jpg,jpeg,png',
        ], [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.max' => 'Brand Less Then 255Chars',
        ]);

        $brand_image = $request->file('brand_logo');
        $img_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $img_gen . '.' . $img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location . $img_name;
        $brand_image->move($up_location, $img_name);

        //dd($request->all());
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_logo' => $last_img,
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|max:255',
            'brand_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.max' => 'Brand Less Then 255 Chars',
        ]);

        $old_image = $request->old_logo;
        $brand_image = $request->file('brand_logo');

        if ($brand_image) {
            $img_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $img_gen . '.' . $img_ext;
            $up_location = 'images/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            //dd($request->all());
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_logo' => $last_img,
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
        }
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_logo;
        unlink($img);

        Brand::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }
}
