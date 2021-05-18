<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Auth;
use Session;

class OfferController extends Controller
{
    public function index(Request $request) {
        $this->validate($request, [
            'post_id' => 'exists:posts,id|numeric',
            'price' => 'required',
            
        ]);
        $offer = new Offer;
        $offer->user_id = Auth::user()->id;
        $offer->post_id = $request->post_id;
        $offer->price = $request->price;
        $offer->save();

        Session::flash('success', 'Dziękuję za złożenie oferty');
        return redirect()->back();
    }
    
    
    
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'post_id' => 'exists:posts,id|numeric',
            'price' => 'required',
        ]);
        $offer->user_id = Auth::user()->id;
        $offer->post_id = $request->post_id;
        $offer->price = $request->price;
        $offer->save();

        Session::flash('success', 'Dziękuję za złożenie oferty');
        return redirect()->back();
    }
    
    
}
