<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Language;



class UsersController extends Controller
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

            $data = User::get();
           
            $results = [];
            foreach($data as $User){
                // $country->image = env('APP_URL') . '/uploads/country/' . $country->image;
                $User->image = asset('uploads/User/' . $User->image);
                array_push($results, $User);
            }

            return DataTables::of($results)->addIndexColumn()
                ->addColumn('action', 'users.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Users';
        $page_description = 'This page is to show all the records in User table';

        return view('users.index', compact('page_title', 'page_description'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::all();
        $page_title = 'Add New User';
        $page_description = 'This page is to add new record in User table';
        $languages = Language::get();
        //
        return view('users.create', compact('page_title', 'page_description' ,'languages'));
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
            'user_token' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'login_type' => 'required',
            'image_path' => 'required',
            'language_id' => 'required',
           
        ]);
        $input = $request->all();
     
  
    if ($image = $request->file('image')) {
        $destinationPath = 'uploads/User/';
        $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $recordImage);
        $input['image'] = "$recordImage";
    }


        User::create($input);
        return redirect()->action([UserController::class, 'index'])->with('success','User created successfully.');;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        $User = User::find($User->id);
        $page_title = 'Show User';
        $page_description = 'This page is to show User details';
        //
        return view('users.show',compact('User', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        $User = User::find($User->id);
        $page_title = 'Edit User';
        $page_description = 'This page is to edit record in User table';
        //
        return view('users.edit',compact('User', 'page_title', 'page_description','User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
        // dd($request);
        $request->validate([
            'user_token' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'login_type' => 'required',
            'image_path' => 'required',
            'language_id' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/User/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['image'] = "$recordImage";
        }else{
            unset($input['image']);
        }
        // dd($request);
        $User->update($input);
       
        return redirect()->action([UserController::class, 'index'])
                        ->with('success','User updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = User::where('id',$request->id)->delete();
        return Response()->json($com);
    }

   
}
