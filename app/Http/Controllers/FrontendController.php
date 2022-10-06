<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaStore;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Home;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\App;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'ُEcommerce';
        $page_description = '';

        $lang = App::getLocale();
        //select all records
        $homeRecords = Home::paginate(4);
        $updatedItems = $homeRecords->getCollection();


        // $ = Home::all();
        $result =[];

        foreach ($updatedItems as $key => $homeRecord) {
            $data = [];
           if(strtolower( $homeRecord->content_type->name) == 'offer'){
            $data['content_type'] = 'offer';
            $data['appearance'] = $homeRecord->appearance->number;
           }
           elseif(strtolower( $homeRecord->content_type->name) == 'category'){
            $data['content_type'] = 'category';
            $data['appearance'] = $homeRecord->appearance->number;
           }
           elseif(strtolower( $homeRecord->content_type->name) == 'sub category'){
            $data['content_type'] = 'sub_category';
            $data['appearance'] = $homeRecord->appearance->number;
            
             

            $subCategory =[
                'id'=>$homeRecord->subCategory->id,
                'name'=>$lang == 'en' ? $homeRecord->subCategory->name : $homeRecord->subCategory->name_locale,
                'parent_id' => $homeRecord->subCategory->parent_id,
                'image'=> $homeRecord->subCategory->image != null ? asset('uploads/category/' . $homeRecord->subCategory->image): $homeRecord->subCategory->image ,
                'cover_image'=>  $homeRecord->subCategory->cover_image != null ? asset('uploads/category/' . $homeRecord->subCategory->cover_image): $homeRecord->subCategory->cover_image


            ];
            
            $data['sub_category']=$subCategory;

           }
           elseif( strtolower( $homeRecord->content_type->name) == 'item'){
            $data['content_type'] = 'item';
            $data['appearance'] = $homeRecord->appearance->number;
            //item 
            //Todo bring item  
            $data['item']= $homeRecord->item->getByLang($lang);
            
           }
           elseif(strtolower( $homeRecord->content_type->name) == 'store'){
            $data['content_type'] = 'store';
            $data['appearance'] = $homeRecord->appearance->number;
            //store 
        
           }
           array_push($result , $data);
           
        }//end for
        
        $items_store_slider = $items = $items_store = $items_id = $sub_category_item_name = $sub_category_item_name_slider = $Categories = '';
        for ($x = 0; $x < count($result); $x++) 
        {   
            if($result[$x]['appearance'] == '101' || $result[$x]['appearance'] == '102' || $result[$x]['appearance'] == '103')
            {
                $Categories = Category::get();
            }
            if($result[$x]['appearance'] == '201')
            {
                $id = $result[$x]['sub_category']['id'] ; 
                $items =  Item::where('sub_category_id',$id)->get();
                $sub_category_item_name = $result[$x]['sub_category']['name'];
            }
            if($result[$x]['appearance'] == '202')
            {
                $id = $result[$x]['sub_category']['id'] ; 
                $items_store =  Item::select('items.id','items.name','items.description','items.price','items.new_price', 'items.main_screen_image','items.cover_image' , 'items.in_stock' , 'stores.name as store_name','stores.id as store_id','stores.image as store_image')
                ->where('sub_category_id',$id)
                ->leftjoin('stores', 'stores.id', '=', 'items.store_id')->get();
                $sub_category_item_name_store = $result[$x]['sub_category']['name'];
            }

            if($result[$x]['appearance'] == '203')
            {
                $id = $result[$x]['sub_category']['id'] ; 
                $items_store_slider =  Item::select('items.id','items.name','items.description','items.price','items.new_price', 'items.main_screen_image','items.cover_image' , 'items.in_stock' , 'stores.name as store_name','stores.id as store_id','stores.image as store_image')
                ->where('sub_category_id',$id)
                ->leftjoin('stores', 'stores.id', '=', 'items.store_id')->get();
                $sub_category_item_name_slider = $result[$x]['sub_category']['name'];
            }
            if($result[$x]['appearance'] == '300')
            {
                $id = $result[$x]['item']['id'] ; 
                $items_id =  Item::where('id',$id)->get();
            }

        }
      
        return view('frontend.index', compact('page_title', 'page_description','result','Categories','items','items_store','items_store_slider','items_id','homeRecords','sub_category_item_name','sub_category_item_name_slider','sub_category_item_name_store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function show(Store $store)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
    }
}
