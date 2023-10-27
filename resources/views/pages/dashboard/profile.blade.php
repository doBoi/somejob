@extends('layouts.app')

@section('title', 'Profile')


@section('content')
<main class="h-full overflow-y-auto">

  <div class="container mx-auto">
    <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
      <div class="col-span-12">
        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
          Edit My Profile
        </h2>

        <p class="text-sm text-gray-400">
          Enter your data Correctly & Properly
        </p>
      </div>

    </div>
  </div>

  <section class="container px-6 mx-auto mt-5">
    <div class="grid gap-5 md:grid-cols-12">
      <main class="col-span-12 p-4 md:pt-0">
        <div class="px-2 py-2 mt-2 bg-white rounded-xl">
          <form action="{{ route('member.profile.update',Auth::user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="">
              <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">

                  <div class="col-span-6">
                    <div class="flex items-center mt-1">

                      @if ($user->detail_user->photo !== null)
                      <img class="inline-block w-16 h-16 overflow-hidden bg-gray-100 rounded-full"
                        src="{{ url(Storage::url($user->detail_user->photo)) }}" alt="">
                      @else
                      <span class="inline-block w-16 h-16 overflow-hidden bg-gray-100 rounded-full">
                        <svg class="w-full h-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                          <path
                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                      </span>
                      @endif
                      <input name="photo" type="file" accept="image/*" id="actual-btn" style="display:none" />
                      <button type="button"
                        class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <label for="actual-btn">Choose File</label>
                      </button>
                      <a href="{{ route('member.delete.photo.profile') }}" type="button"
                        class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-red-700 bg-transparent rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        onclick="return confirm('Are you sure want to delete your profile')">
                        Delete
                      </a>
                    </div>
                    @if ($errors->has('photo'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('photo') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6 lg:col-span-3">
                    <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Full Name</label>

                    <input placeholder="Your Name" type="text" name="name" id="name" autocomplete="name"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ Auth::user()->name ? Auth::user()->name : old('name') }}" required>

                    @if ($errors->has('name'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('name') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6 lg:col-span-3">
                    <label for="role" class="block mb-3 font-medium text-gray-700 text-md">Role</label>

                    <input placeholder="Youre Role" type="text" name="role" id="role" autocomplete="role"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $user->detail_user->role ?? '' }}" required>

                    @if ($errors->has('role'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('role') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6 lg:col-span-3">
                    <label placeholder="Your Email" for="email"
                      class="block mb-3 font-medium text-gray-700 text-md">Email Address</label>

                    <input placeholder="Your Email" type="text" name="email" id="email" autocomplete="email"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ Auth::user()->email ? Auth::user()->email : '' }}" required>

                    @if ($errors->has('email'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('email') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6 lg:col-span-3">
                    <label for="contact_number" class="block mb-3 font-medium text-gray-700 text-md">Contact
                      Number</label>

                    <input placeholder="0822100000" type="number" name="contact_number" id="contact_number"
                      autocomplete="contact_number"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{$user->detail_user->contact_number ? $user->detail_user->contact_number : " "}}"
                      required>

                    @if ($errors->has('contact_number'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('contact_number') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="biography" class="block mb-3 font-medium text-gray-700 text-md">Biography</label>

                    <textarea placeholder="Enter your biography here.." type="text" name="biography" id="biography"
                      autocomplete="biography"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      rows="4"> {{$user->detail_user->biography ?? " "}} </textarea>

                    @if ($errors->has('biography'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('biography') }}</p>
                    @endif

                    <div class=" col-span-6">
                      <label for="Experience" class="block mb-3 font-medium text-gray-700 text-md">My Experience</label>
                      @forelse ($experience_user as $experience)
                      <input type="text" name="Experience[{{ $experience['id'] }}]"
                        id="Experience[{{ $experience['id'] }}]" autocomplete="Experience[{{ $experience['id'] }}]"
                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{$experience['experience'] ?? ""}}" placeholder="Add Experience...">

                      @if ($errors->has('Experience[{{ $experience->id }}]'))
                      <p class="text-red-700 mb-3 text-sm">{{ $errors->first('Experience') }}
                      </p>
                      @endif

                      @empty
                      <input placeholder="More than 9 years of experience" type="text" name="Experience[]"
                        id="Experience" autocomplete="Experience"
                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{$experience['experience'] ?? old('Experience')}}">
                      @if ($errors->has('Experience'))
                      <p class="text-red-700 mb-3 text-sm">{{ $errors->first('Experience') }}
                      </p>
                      @endif

                      <input placeholder="Knowledge in the fields of interface design, marketing and etc" type="text"
                        name="Experience[]" id="Experience" autocomplete="Experience"
                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{$experience['experience'] ?? old('Experience')}}">
                      @if ($errors->has('Experience'))
                      <p class="text-red-700 mb-3 text-sm">{{ $errors->first('Experience') }}
                      </p>
                      @endif

                      <input placeholder="Lead Developer at Sony Music for 8 Years" type="text" name="Experience[]"
                        id="Experience" autocomplete="Experience"
                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{$experience['experience'] ?? old('Experience')}}">
                    </div>
                    @if ($errors->has('Experience'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('Experience') }}
                    </p>
                    @endif
                    @endforelse
                  </div>
                </div>
              </div>

              <div class="px-4 py-3 text-right sm:px-6">
                <a href="{{ route('member.dashboard.index') }}" type="button"
                  class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                  onclick="return confirm('Are you sure want to leave this page? ')">
                  Cancel
                </a>
                <button type="submit"
                  class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                  onclick="return confirm('Are you sure want to make change? ')">
                  Save Changes
                </button>
              </div>

            </div>
          </form>

        </div>
      </main>
    </div>
  </section>

</main>
@endsection
