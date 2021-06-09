<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{

    /** constructor: setting middlewares */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        // dd(1);
        $users = User::all();
        return view('admin.dashboard.users.index', compact('users'));
    } // end of index



    public function create()
    {

        return view('admin.dashboard.users.create');
    } // end of create


    public function store(Request $request)
    {
       // dd('1');
        // validation is here not in UserRequest : to return errors with json => failed vilidation setting is needed instead
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['sometimes', 'required',  'min:6'],
            'phone' => ['required', 'array', 'min:1'],
            'phone.*' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
            'photo' => ['image'],
        ]);

        $requested_data = $request->except('phone', 'photo', '_token', 'method');

        // handling photo
        $requested_data['photo'] = $request->photo ?  $this->handlePhoto('create', $request->photo) : 'default.png';


        // create user
        $user = User::create($requested_data);

        // assign phones to user
        foreach ($request->phone as $index => $phone) {
            $user->phones()->create(['phone' => $phone]);
        } // end foreach

        return view('admin.dashboard.users._user_row', compact('user'));
    } // end of store


    public function edit(User $user)
    {
        return view('admin.dashboard.users.edit', compact('user'));
    } // end of edit


    public function update(User $user, Request $request)
    {
        // dd($request->phone);

        $request->validate([
            'name' => 'sometimes|required',
            'email' => ['sometimes','required',
                        Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|nullable|min:6',
            'phone' => ['sometimes','required', 'array', 'min:1'],
            'phone.*' => ['regex:/^([0-9\s\-\+\(\)]*)$/','min:10', 'max:13',],
                        // Rule::unique('phones')->ignore($user->id)],
            'photo' => ['image'],
        ]);

        $requested_data =  $request->except(['_token', '_method', 'photo']);


       // handling image
        $requested_data['photo'] =  ($request->photo) ? $this->handlePhoto('edit', $request->photo) :  $user->photo;


        // check if phone update
        if ($request->phone) {

            // assign phones to user
            foreach ($request->phone as $index => $phone) {
                $user->phones()->update(['phone' => $phone]);

            } // end foreach
        }

        if (! $request->password){
            $requested_data['password'] = $user->password;
        }



        $user->update($requested_data) ; // use save not to fill passw with null  

        return response()->json([
            'user' => $user,
        ]);

    } // end of update


    public function destroy(User $user)
    {
        // helper function delete image if exist
        delete_image('users', $user->photo);
        $user->delete();
        return response()->json([
            'user_id' => $user->id,

        ]);
    } // end of destroy


    // handling photo 
    public function handlePhoto($create_or_edit, $photo)
    {
        // delete the old photo frome storage
        $create_or_edit == 'edit' ?  delete_image('users', $photo) : '';

        // helper manages image uploading
        save_image('users', $photo);

        return $photo->hashName();

    } // end of handle photo



    // add phone : calls view that show new text input for phone
    public function addPhone()
    {
        return view('admin.dashboard.users._extra_phone');
    }

}// end of user controller
