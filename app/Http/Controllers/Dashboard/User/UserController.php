<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::search($request->query())->with('media','profile')->latest()->paginate(10)->appends([
                        'query' => $request->query()
                    ]);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.User.Partials.users', compact('users'))->render(),
            ]);
        }
        $usersAndTradersCount = User::count();
        $deliveryCount = User::where('role','deliver')->count();
        $usersCount = User::where('role','user')->count();
        return view('Dashboard.User.index',compact('users','deliveryCount','usersCount','usersAndTradersCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('Dashboard.User.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // if($request->type=='trader'){
        //     $typeMsg = 'التاجر';
        // }else{
        //     $typeMsg = 'المستخدم';
        // }
        $store = User::create($request->all());
        $store->profile()->create($request->all());
        if($request->hasFile('avatar')){
            $store->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }else{
            $store->copyMedia(public_path('assets/media/dashboard/avatar.png'))->toMediaCollection('avatar');
        }
        return redirect()->route('dashboard.users.index')->with('success','تم إضافة الحساب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('media','profile')->find($id);
        return view('Dashboard.User.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('media','profile')->find($id);
        return view('Dashboard.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $update = User::find($id);
        // if($update->type=='trader'){
        //     $typeMsg = 'التاجر';
        // }else{
        //     $typeMsg = 'المستخدم';
        // }

        $update->update($request->all());
        $update->profile->delete();
        $update->profile()->create($request->all());

        if($request->hasFile('avatar')){
            $update->clearMediaCollection('avatar');
            $update->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }
        return redirect()->route('dashboard.users.index')->with('success','تم تعديل الحساب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete  = User::find($id);

        // if($delete->type=='trader'){

        //     $typeMsg = 'التاجر';

        // } else {

        //     $typeMsg = 'المستخدم';

        // }

        $delete->clearMediaCollection('avatar');

        $delete->delete();

        return redirect()->route('dashboard.users.index')->with('success','تم حذف الحساب بنجاح');

    }

    public function blocked(Request $request){
        $users = User::whereStatus('blocked')->search($request->query())->with('media','profile')->latest()->paginate(10)->appends([
                        'query' => $request->query()
                    ]);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.User.Partials.users', compact('users'))->render(),
            ]);
        }
        $usersAndTradersCount = User::whereStatus('blocked')->count();
        $deliveryCount = User::whereStatus('blocked')->where('role','deliver')->count();
        $usersCount = User::whereStatus('blocked')->where('role','user')->count();
        return view('Dashboard.User.archived',compact('users','usersAndTradersCount','deliveryCount','usersCount'));
    }
    public function userSwitchStatus($id) {
        $user = User::findOrFail($id);
        $user->status = $user->status == 'active' ? 'blocked' : 'active';
        $user->save();
        return response()->json( 'تم تغيير حالة المستخدم بنجاح');
    }
}
