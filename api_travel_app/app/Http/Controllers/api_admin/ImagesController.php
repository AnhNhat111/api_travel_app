<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\images;
use Carbon\Carbon;
use Validator;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = imgaes::get()->sortBy('name')->paginate(15);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $images = $request->input('images');
        $date = Carbon::now();
        $date_now = $date->format('Ymdhis');
        $data = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{
            if($images){
               foreach ($images as $image) {
                    
                    $TNew = images::create([
                        'name' => $date_now.$image["name"],
                        'tour_id' => $image["tour_id"],
                        'image_path' => $image["image_path"] ?? null
                    ]);

                    $data[] = $TNew;
               }
           }else{
            $TNew = images::create([
                'name' => $request["name"],
                'tour_id' => $request["tour_id"],
                'image_path' => $request["image_path"] ?? null
            ]);
            $data = $TNew;
           }
           return respone()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$ids)
    {
        $ids = $request->input('ids');
        $delete = images::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }


        return response()->json($data);
    }
}
