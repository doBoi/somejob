<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Profile\UpdateDetailUserRequest;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;


use App\Models\DetailUser;
use App\Models\ExperienceUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $user = User::where('id', Auth::user()->id)->first();
        $experience_user = ExperienceUser::where('detail_user_id', $user->detail_user->id)
            ->Orderby('id', 'asc')
            ->get();

        return view('pages.dashboard.profile', compact('user', 'experience_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailUserRequest $request_detail_user, UpdateProfileRequest $request_profile): \Illuminate\Http\RedirectResponse
    {
        // return var_dump($request->all());

        $data_profile = $request_profile->all();
        $data_detail_user = $request_detail_user->all();

        //get photo user
        $get_photo = DetailUser::where('user_id', Auth::user()->id)->first();
        //delete old photo from storage if any
        if (isset($data_detail_user['photo'])) {
            $data = 'storage/' . $get_photo['photo'];
            if (File::exists($data)) {
                File::delete($data);
            } else {
                File::delete('storage/app/public' . $get_photo['photo']);
            }
        }

        //store file photo to storage
        if (isset($data_detail_user['photo'])) {
            $data_detail_user['photo'] = $request_detail_user->file('photo')->store('assets/photo', 'public');
        }


        //update user
        $user = User::find(Auth::user()->id);
        $user->update($data_profile);


        //update detail user
        $detail_user = DetailUser::find($user->detail_user->id);
        $detail_user->update($data_detail_user);

        // save to experience
        $experience_user_id = ExperienceUser::where('detail_user_id', $detail_user->id)->first();
        if (isset($experience_user_id)) {
            foreach ($data_profile['Experience'] as $key => $value) {
                $experience_user = ExperienceUser::find($key);
                $experience_user->detail_user_id = $detail_user->id;
                $experience_user->experience = $value;
                $experience_user->save();
            }
        } else {
            foreach ($data_profile['Experience'] as $key => $value) {
                if (isset($value)) {
                    $experience_user = new ExperienceUser;
                    $experience_user->detail_user_id = $detail_user->id;
                    $experience_user->experience = $value;
                    $experience_user->save();
                }
            }
        }

        toast()->success('Update Has Been Success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return abort(404);
    }

    //custom

    public function delete($id)
    {
        //get user
        $get_user_photo = DetailUser::where('user_id', Auth::user()->id)->first();
        $path_photo = $get_user_photo['photo'];

        // second update value to null
        $data = DetailUser::find($get_user_photo['id']);
        $data->photo = NULL;
        $data->save;

        $data = 'storage/' . $path_photo;
        if (File::exists($data)) {
            File::delete($data);
        } else {
            File::delete('storage/app/public/' . $path_photo);
        }

        toast()->success('Delete Has been success');

        return back();
    }
}
