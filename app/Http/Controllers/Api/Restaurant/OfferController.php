<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    //List Of Offers

    public function listOffer(Request $request){
        $offers=$request->user()->offers()->with('restaurant')->paginate();

        return apiResponse(1,'success',$offers);

    }

    // Create Offer
    public function createOffer(Request $request)
    {
        $validation=validator()->make($request->all(),[

            'name'=>'required',
            'image'=>'required',
            'content'=>'required',
            'restaurant_id'=>'required',
            'date_from'=>'required',
            'date_to'=>'required',


        ]);
        if ($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }

        $offer=Offer::create($request->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/meals/';    // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();    // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
            $image->move($destinationPath, $name);    // uploading file to given path
            $offer->update(['image' => 'uploads/items/' . $name]);
        }

        return apiResponse(1,'Offer Added Successfully',$offer);


    }

    public function updateOffer(Request $request)
    {
        $validation=validator()->make($request->all(),[

            'name'=>'unique:offers,name,'.$request->user()->id,
            'image'=>'unique:offers,image,'.$request->user()->id,
            'content'=>'unique:offers,content,'.$request->user()->id,
            'date_from'=>'unique:offers,date_from,'.$request->user()->id,
            'date_to'=>'unique:offers,date_to,'.$request->user()->id,


        ]);

        if ($validation->fails()){

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }

        //Update Meal
        $offer=$request->user()->offers()->find($request->offer_id);
        if (!$offer)
        {
            return apiResponse(0,'there is no offer with this information');
        }
        $offer->update($request->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/meals/';    // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();    // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
            $image->move($destinationPath, $name);    // uploading file to given path
            $offer->update(['image' => 'uploads/items/' . $name]);
        }
        return apiResponse(1, 'Modified Successfully',$offer);
    }
    public function deleteOffer(Request $request)
    {
        $offer=$request->user()->offers()->find($request->offer_id);
        if (!$offer)
        {
            return apiResponse(0,'there is no offer with this information');
        }
        $offer->delete($request->all());
        return apiResponse(1, 'Successfully deleted');

    }
}
