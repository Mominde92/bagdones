<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class AddressController  extends Controller
{
    protected $namespace = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Address::get();
           

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', 'address.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'address';
        $page_description = 'This page is to show all the records in Address table';

        return view('address.index', compact('page_title', 'page_description'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Address::all();
        $page_title = 'Add New Address';
        $page_description = 'This page is to add new record in Address table';

        //
        return view('address.create', compact('page_title', 'page_description' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories', 'max:50'],
            'name_locale' => ['required', 'unique:categories', 'max:50'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        $input = $request->all();
     
  
    if ($image = $request->file('image')) {
        $destinationPath = 'uploads/Address/';
        $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $recordImage);
        $input['image'] = "$recordImage";
    }


        Address::create($input);
        return redirect()->action([AddressController::class, 'index'])->with('success','Address created successfully.');;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $Address)
    {
        $Address = Address::find($Address->id);
        $page_title = 'Show Address';
        $page_description = 'This page is to show Address details';
        //
        return view('address.show',compact('Address', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $Address)
    {
        $Address = Address::find($Address->id);
        $page_title = 'Edit Address';
        $page_description = 'This page is to edit record in Address table';
        //
        return view('address.edit',compact('Address', 'page_title', 'page_description','Address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $Address)
    {
        //
        // dd($request);
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($Address), 'max:50'],
            'name_locale' => [Rule::unique('categories', 'name_locale')->ignore($Address), 'max:50'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/Address/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['image'] = "$recordImage";
        }else{
            unset($input['image']);
        }
        // dd($request);
        $Address->update($input);
       
        return redirect()->action([AddressController::class, 'index'])
                        ->with('success','Address updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = Address::where('id',$request->id)->delete();
        return Response()->json($com);
    }

   
}
