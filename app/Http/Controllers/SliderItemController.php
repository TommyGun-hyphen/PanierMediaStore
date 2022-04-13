<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class SliderItemController extends Controller
{
    public function index(){
        $items = SliderItem::all();
        return view('slider.index', compact('items'));
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = Str::uuid().'.'.$image->getClientOriginalExtension();
            $destination_path = public_path('images');
            $img = Image::make($image->getRealPath());
            $img->save($destination_path .'/'. $fileName);
            SliderItem::create([
                'image_url' => '/images/'.$fileName,
                'link' => $request->input('link')
            ]);
        }
        return redirect()->back();
    }
    public function destroy($item_id){
        $item = SliderItem::findOrFail($item_id);
        $item->delete();
        File::delete( public_path().$item->image_url);
        return redirect()->back();
    }
}
