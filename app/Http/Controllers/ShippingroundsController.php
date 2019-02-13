<?php

namespace App\Http\Controllers;

use App\Models\Shippinground;
use App\Http\Requests\ShippingroundsRequest as Request;

class ShippingroundsController extends Controller {
    public $model;

    /**
     * ShippingroundsController constructor.
     */
    public function __construct() {
        $this->model = new Shippinground;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $shippingrounds = $this->model->orderBy('sorting_id', 'ASC')->get();          
          
        return response()->json(['shippingrounds' => $shippingrounds]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $data['sorting_id'] = $this->model->orderBy('sorting_id', 'DESC')->pluck('sorting_id')->first() + 1;
        $data['file1'] = '';
        //var_dump($data);
        if ($request->file('file1')) {
            $data['file1'] = '/storage/' . $request->file('file1')->store('shippingrounds');
        }  
        if ($request->file('file2')) {
            $data['file2'] = '/storage/' . $request->file('file2')->store('shippingrounds');
        }  
        if ($request->file('file3')) {
            $data['file3'] = '/storage/' . $request->file('file3')->store('shippingrounds');
        }        
        $shippinground = $this->model->create($data);
        return response()->json(['success' => $shippinground ? true : false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $shippinground = $this->model->whereId($id)->first();        
        return response()->json(['shippinground' => $shippinground]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $shippinground = $this->model->whereId($id)->first();
        return response()->json(['shippinground' => $shippinground]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->except('_method');
      
        //var_dump($data);
      
        if ($request->file('file1') && $request->file('file1') != 'undefined') {
          
          $filename = $request->file('file1')->getClientOriginalName();
          //var_dump($filename);
          
            $data['file1'] = '/storage/' . $request->file('file1')->storeAs('shippingrounds',$filename);
        }
      
        if ($request->file('file2') && $request->file('file2') != 'undefined') {
          
          $filename = $request->file('file2')->getClientOriginalName();
          //var_dump($filename);
          
            $data['file2'] = '/storage/' . $request->file('file2')->storeAs('shippingrounds',$filename);
        }
      
        if ($request->file('file3') && $request->file('file3') != 'undefined') {
          
          $filename = $request->file('file3')->getClientOriginalName();
          //var_dump($filename);
          
            $data['file3'] = '/storage/' . $request->file('file3')->storeAs('shippingrounds',$filename);
        }
      
      
      
        $success = $this->model->whereId($id)->update($data);
        return response()->json(compact('success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = $this->model->destroy($id);
        return response()->json(['success' => $result]);
    }

    /**
       * @param $oldId
       * @param $newId
       * @return \Illuminate\Http\JsonResponse
       */
      public function sort($oldId, $newId) {
          $shippinground = $this->model->whereSortingId($oldId)->first();
          $result = $shippinground->update(['sorting_id' => $newId]);
          $query = $this->model->whereBetween('sorting_id', ($oldId < $newId ? [$oldId, $newId] : [$newId, $oldId]))
              ->where('id', '!=', $shippinground->id);
          if ($oldId > $newId) $query->increment('sorting_id');
          else $query->decrement('sorting_id');

          return response()->json(['success' => $result]);
      }

}
