<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyRestaurantRequest;
use App\Restaurant;
use App\RestaurantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.index', compact('restaurant', 'id'));
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
        $restaurant = Restaurant::find($id);    
        $restaurant->name = $request->name; 
        $restaurant->code = $request->code; 
        $restaurant->email = $request->email; 
        $restaurant->phone = $request->phone; 
        $restaurant->desc = $request->desc; 

        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
            'email'=> 'unique:restaurants|required',
            'phone'=> 'max:10|min:10',
        ]);
        $restaurant->update();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data Updated successfully'
            ]
        )->redirect(route('restaurant.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
            abort_unless(\Gate::allows('restaurant_delete'), 403);
    
            $restaurant->delete();
    
            return back();
        }

    public function create(){
        return view('restaurant.create');
    }

    public function store(Request $request)
    {
        $restaurant = new Restaurant();
           
        $restaurant->name = $request->name; 
        $restaurant->code = $request->code; 
        $restaurant->email = $request->email; 
        $restaurant->phone = $request->phone; 
        $restaurant->desc = $request->desc; 

        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
            'email'=> 'unique:restaurants|required',
            'phone'=> 'max:10|min:10',
        ]);
        $restaurant->save();
        
        // code for image 

        // $restaurant_image = new RestaurantImage();
        // if ($validator->passes()) {
            // $restaurant_image->restaurant_id = $restaurant->id
            // $input = $request->file('image');    
            // $new_name = rand() . '.' .$input()->getClientOriginalExtension();    
            // // $input->move(public_path('images'), $new_name);
            // RestaurantImage::create($input->move(public_path('images'), $new_name));   
    
            // return response()->json(['success'=>'done']);
    
        //   }
        // $restaurant_image->image = $request->image; 
        // $restaurant_image->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
            );
    }


    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Restaurant::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}