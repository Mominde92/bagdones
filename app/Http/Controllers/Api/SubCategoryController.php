<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Resources\Category as CategoryResourse;
class SubCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = App::getLocale();
        // dd($lang );
        if($lang == 'en'){
            $categories = Category::select('id','name', 'parent_id' ,'cover_image')->where('parent_id','!=', null)->paginate(10);
        }elseif($lang == 'ar'){
            $categories = Category::select('id','name_locale as name', 'parent_id' ,'cover_image' )->where('parent_id','!=', null)->paginate(10);
        }
        // dd('ssss');
        
        foreach($categories as $category){
            $category->image = asset('uploads/category/' . $category->image);
            // array_push($results, $category);
        }
       
 
        foreach($categories as $category){

            if(!is_null($category->cover_image))
            {
                $category->cover_image = asset('uploads/category/' . $category->cover_image);
          }
         }

        return $this->sendResponse($categories, 'categories retrieved successfully.');
    }


    public function getSubCategories($id){
        $lang = App::getLocale();
        $name = 'name as name' ; 

        if($lang == 'ar'){
            $name = 'name_local as name';
        }
        $categories = Category::select('id',$name,'image', 'parent_id','cover_image' )->where('parent_id', $id)->paginate(10); 
        foreach($categories as $category){

            if(!is_null($category->cover_image))
            {
                $category->cover_image = asset('uploads/category/' . $category->cover_image);
          }
         }
        return $this->sendResponse($categories, 'SubCategories retrieved successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataAjax(Request $request)
    {
        
        $search = $request->search;
        $parent_id = isset($request->parent_id) ? $request->parent_id : null ;
        // if($request->ajax()){
            if($search == ''){
                $categories = Category::orderby('name','asc')->
                select('id','name' , 'name_locale') ;
        
             }else{
                $categories = Category::orderby('name','asc')
                ->select('id','name','name_locale')
                ->where('name', 'like', '%' .$search . '%') ;
           
             }
             //filter on parent_id
             if($parent_id != null){
                 $categories->where('parent_id','=', $parent_id);
             }else{
                 $categories->where('parent_id','!=', null);
             }
            
             $subCats = $categories->limit(10)->get();
            //  return response()->json($categories->toSql());
            $response = [];
             foreach($subCats as $category){
                $response[] = array(
                     "id"=>$category->id,
                     "text"=>$category->name .' - '.$category->name_locale 
                );
             }
             return response()->json($response);
        // }
        
    }
}
