<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;


class MultiPicController extends Controller
{
    public function index()
    {
        $images = Multipic::latest()->paginate(15);
        return view('multipic.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = $request->file('images');

        foreach ($images as $image) {
            $img_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $img_gen . '.' . $img_ext;
            $up_location = 'images/multipic/';
            $last_img = $up_location . $img_name;

            $image->move($up_location, $img_name);

            Multipic::insert([
                'images' => $last_img,
                'created_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Images Uploaded Successfully');
    }
}
