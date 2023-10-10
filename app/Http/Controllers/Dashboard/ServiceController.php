<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;


use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Order;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\ThumbnailService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $services = Service::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        //add to service
        $service = Service::create($data);

        // add to advantage service
        foreach ($data['advantage_service'] as $key => $value) {
            $advantage_service = new AdvantageService;
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add to advantage user
        foreach ($data['advantage_user'] as $key => $value) {
            $advantage_user = new AdvantageUser;
            $advantage_user->service_id = $service->id;
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // add to thumbnail service
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {

                $path = $file->store(
                    'assets/service/thumbnail',
                    'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        // add to tagline
        foreach ($data['tagline'] as $key => $value) {
            $tagline = new Tagline;
            $tagline->service_id = $service->id;
            $tagline->advantage = $value;
            $tagline->save();
        }


        toast()->success('Save has been Succces');
        return redirect()->route('member.service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $advantage_service = AdvantageService::where('service_id', $service->id)->get();
        $advantage_user = AdvantageUser::where('service_id', $service->id)->get();
        $thumbnail_service = ThumbnailService::where('service_id', $service->id)->get();
        $tagline = Tagline::where('service_id', $service->id)->get();

        // return $thumbnail_service;
        return view('pages.dashboard.service.edit', compact('advantage_service', 'advantage_user', 'thumbnail_service', 'tagline', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();


        // Update tp Service
        $service->update($data);


        // ADVANTAGE SERVICE
        // Update to advantage service
        foreach ($data['advantage_service'] as $key => $value) {
            $advantage_service = AdvantageService::find($key);
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add New to advantage service
        if (isset($data['advantage_service'])) {
            foreach ($data['advantage_service'] as $key => $value) {
                $advantage_service = new AdvantageService;
                $advantage_service->service_id = $service->id;
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
        }


        // ADVANTAGE USER
        //update
        foreach ($data['advantage_user'] as $key => $value) {
            $advantage_user = AdvantageUser::find($key);
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // add
        if (isset($data['advantage_user'])) {
            foreach ($data['advantage_user'] as $key => $value) {
                $advantage_user = new AdvantageUser;
                $advantage_user->service_id = $service->id;
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }
        }

        //TAGLINE
        // Update to tagline
        foreach ($data['tagline'] as $key => $value) {
            $tagline = Tagline::find($key);
            $tagline->advantage = $value;
            $tagline->save();
        }

        //Add New to Tagline
        if (isset($data['tagline'])) {
            foreach ($data['tagline'] as $key => $value) {
                $tagline = new Tagline;
                $tagline->service_id = $service->id;
                $tagline->advantage = $value;
                $tagline->save();
            }
        }

        // THUMBNAIL
        // Update to thumbnail service
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $key => $value) {

                //get old photo
                $get_photo = ThumbnailService::where('id', $key)->first();

                //store photo
                $path = $value->store(
                    'assets/service/thumbnail',
                    'public'
                );

                //update thumbnail
                $thumbnail_service = ThumbnailService::find($key);
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }

            //delete thumbnail
            $data = 'storage/' . $get_photo['thumbnail'];

            if (File::exists($data)) {
                File::delete($data);
            } else {
                File::delete('storage/app/public/' . $get_photo['thumbnail']);
            }
        }

        // Add New to thumbnail service
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {

                $path = $file->store(
                    'assets/service/thumbnail',
                    'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }


        toast()->success('Update has been Succces');
        return redirect()->route('member.service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return abort(404);
    }
}
