<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderImage;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function store(Request $request)
    {
        $tshirtOrder = new Order();
        $tshirtOrder->user_id = auth()->user()->id; // Associate the order with the authenticated user
        $tshirtOrder->type = $request->input('type');
        $tshirtOrder->fabric= $request->input('fabric');
        $tshirtOrder->color = $request->input('color'); // Update this to match your color field name
        $tshirtOrder->print_type = $request->input('print_type');
        $tshirtOrder->textcolor = $request->input('textcolor');
        $tshirtOrder->textfont = $request->input('textfont');
        $tshirtOrder->text = $request->input('text'); 
        $tshirtOrder->save();
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $uploadPath = 'uploads/customtshirt/';
            $file->move($uploadPath, $filename);
    
            $tshirtPrint = new OrderImage();
            $tshirtPrint->orders_id = $tshirtOrder->id; // Associate the TshirtPrint with the corresponding TshirtOrder
            $tshirtPrint->image = $uploadPath.$filename;
            $tshirtPrint->save();
        }
        if ($request->has('exported_image')) {
            $dataUrl = $request->input('exported_image');
            $imageData = substr($dataUrl, strpos($dataUrl, ",") + 1);
            $decodedImageData = base64_decode($imageData);
            $filename = 'final_design_' . time() . '.png';
            $filePath = 'uploads/customtshirt/' . $filename;
            file_put_contents($filePath, $decodedImageData);

            $tshirtPrint = new OrderImage();
            $tshirtPrint->orders_id = $tshirtOrder->id;
            $tshirtPrint->finalimage = $filePath;
            $tshirtPrint->save();
        }
        return redirect('/');
    }
}

    