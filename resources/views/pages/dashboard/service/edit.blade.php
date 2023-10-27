@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')

<main class="h-full overflow-y-auto">
  <div class="container mx-auto">
    <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
      <div class="col-span-12">
        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
          Edit Your Service
        </h2>
        <p class="text-sm text-gray-400">
          Edit the services you provide
        </p>
      </div>
    </div>
  </div>
  @if ($errors->all())
  @foreach ($errors->all('<p>:message</p>') as $input_error)
  <p class="text-red-700 mb-3 text-sm">{{ $input_error }}</p>
  @endforeach
  @endif
  <!-- breadcrumb -->
  <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
    <ol class="inline-flex p-0 list-none">
      <li class="flex items-center">
        <a href="{{ route('member.service.index') }}" class="text-gray-400">My Services</a>
        <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
          <path
            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
        </svg>
      </li>
      <li class="flex items-center">
        <p class="font-medium">Edit Your Service</p>
      </li>
    </ol>
  </nav>

  <section class="container px-6 mx-auto mt-5">
    <div class="grid gap-5 md:grid-cols-12">
      <main class="col-span-12 p-4 md:pt-0">
        <div class="px-2 py-2 mt-2 bg-white rounded-xl">
          <form action="{{ route('member.service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="">
              <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">

                  <div class="col-span-6">
                    <label for="title" class="block mb-3 font-medium text-gray-700 text-md">Judul Service</label>

                    <input placeholder="Service apa yang ingin kamu tawarkan?" type="text" name="title" id="title"
                      autocomplete="title"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $service->title ??'' }}">

                    @if ($errors->has('title'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('title') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="description" class="block mb-3 font-medium text-gray-700 text-md">Deskripsi
                      Service</label>
                    <textarea placeholder="Jelaskan Service apa yang kamu tawarkan?" type="text" name="description"
                      id="description" autocomplete="description"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      cols="30" rows="5">{{ $service->description ??'' }}
                    </textarea>
                    @if ($errors->has('description'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('description') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="service-name" class="block mb-2 font-medium text-gray-700 text-md">Keunggulan Service
                      kamu</label>

                    <p class="block mb-3 text-sm text-gray-700">
                      Hal apa aja yang didapakan dari service kamu?
                    </p>
                    @if (count($advantage_service))
                    @foreach ($advantage_service as $key => $item)

                    <input placeholder="Keunggulan " type="text" name="advantage_service[{{ $item->id }}]"
                      id="advantage_service" autocomplete="advantage_service"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $item->advantage ?? '' }}">

                    @if ($errors->has('advantage_service'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_service') }}</p>
                    @endif
                    @endforeach
                    @else
                    <input placeholder="Keunggulan 1" type="text" name="advantage_services[]" id="advantage_services"
                      autocomplete="advantage_services"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ old('advantage_services') }}">
                    @if ($errors->has('advantage_services'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_services') }}</p>
                    @endif

                    <input placeholder="Keunggulan 2" type="text" name="advantage_services[]" id="advantage_services"
                      autocomplete="advantage_services"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('advantage_services'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_services') }}</p>
                    @endif

                    <input placeholder="Keunggulan 3" type="text" name="advantage_services[]" id="advantage_services"
                      autocomplete="advantage_services"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('advantage_services'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_services') }}</p>
                    @endif
                    @endif
                    <div id="newServicesRow"></div>
                    <button type="button"
                      class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                      id="addServicesRow">
                      Tambahkan Keunggulan +
                    </button>
                  </div>

                  <div class="col-span-6 -mb-6">
                    <label for="service-name" class="block mb-3 font-medium text-gray-700 text-md">Estimasi Service &
                      Jumlah Revisi</label>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <select id="delivery_time" name="delivery_time" autocomplete="delivery_time"
                      class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      @if ($service->delivery_time)
                      <option value="{{ $service->delivery_time }}">{{ $service->delivery_time }} Hari</option>
                      @endif
                      <option value="0">Butuh Berapa hari service kamu selesai?</option>
                      <option value="2">2 Hari</option>
                      <option value="4">4 Hari</option>
                      <option value="8">8 Hari</option>
                      <option value="16">16 Hari</option>
                      <option value="32">32 Hari</option>
                    </select>
                    @if ($errors->has('delivery_time'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('delivery_time') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <select id="revision_limit" name="revision_limit" autocomplete="revision_limit"
                      class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      @if ($service->revision_limit)
                      <option value="{{ $service->revision_limit }}">{{ $service->revision_limit }} Hari</option>
                      @endif
                      <option value="0">Maksimal Revisi service kamu</option>
                      <option value="2">2</option>
                      <option value="4">4</option>
                      <option value="6">6</option>
                      <option value="8">8</option>
                      <option value="10">10</option>
                    </select>

                    @if ($errors->has('revision_limit'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('revision_limit') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="price" class="block mb-3 font-medium text-gray-700 text-md">Harga Service
                      Kamu</label>

                    <input placeholder="Total Harga Service Kamu" type="number" name="price" id="price"
                      autocomplete="price"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $service->price }}">

                    @if ($errors->has('price'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('price') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="thumbnail" class="block mb-3 font-medium text-gray-700 text-md">Thumbnail Service
                      Feeds</label>
                    @if ($thumbnail_service)
                    @foreach ($thumbnail_service as $key => $thumbnail)
                    <div>
                      <input placeholder="Keunggulan 1" type="file" name="thumbnail[{{ $thumbnail->id }}]"
                        accept="image/*" id="thumbnail" autocomplete="thumbnail"
                        class="inline-block w-1/2 py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{ url(Storage::url($thumbnail->thumbnail)) }}">
                      <img class="inline-block w-15 h-15 my-2 overflow-hidden bg-gray-100 rounded-md"
                        src="{{ url(Storage::url($thumbnail->thumbnail)) }}" alt="">
                    </div>
                    @if ($errors->has('thumbnail'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('thumbnail') }}</p>
                    @endif
                    @endforeach
                    @else
                    <input placeholder="Keunggulan 1" type="file" name="thumbnails" id="thumbnails"
                      autocomplete="thumbnails"
                      class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('thumbnails'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('thumbnails') }}</p>
                    @endif

                    <input placeholder="Keunggulan 2" type="file" name="thumbnails" id="thumbnails"
                      autocomplete="thumbnails"
                      class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('thumbnails'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('thumbnails') }}</p>
                    @endif

                    <input placeholder="Keunggulan 3" type="file" name="thumbnails" id="thumbnails"
                      autocomplete="thumbnails"
                      class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('thumbnails'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('thumbnails') }}</p>
                    @endif
                    @endif

                    <div id="newThumbnailRow"></div>

                    <button type="button"
                      class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                      id="addThumbnailRow">
                      Tambahkan Gambar +
                    </button>
                  </div>

                  <div class="col-span-6">
                    <label for="advantage_user" class="block mb-3 font-medium text-gray-700 text-md">Keunggulan
                      kamu</label>
                    @if ($advantage_user)
                    @foreach ($advantage_user as $key => $item)
                    <input placeholder="Keunggulan mu" type="text" name="advantage_user[{{ $item->id }}]"
                      id="advantage_user" autocomplete="advantage_user"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $item->advantage }}">
                    @if ($errors->has('advantage_user'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_user') }}</p>
                    @endif
                    @endforeach

                    @else
                    <input placeholder="Keunggulan 1" type="text" name="advantage_users[]" id="advantage_users"
                      autocomplete="advantage_users"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('advantage_users'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_users') }}</p>
                    @endif

                    <input placeholder="Keunggulan 2" type="text" name="advantage_users[]" id="advantage_users"
                      autocomplete="advantage_users"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('advantage_users'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_users') }}</p>
                    @endif

                    <input placeholder="Keunggulan 3" type="text" name="advantage_users[]" id="advantage_users"
                      autocomplete="advantage_users"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if ($errors->has('advantage_users'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('advantage_users') }}</p>
                    @endif
                    @endif


                    <div id="newAdvantagesRow"></div>
                    <button type="button"
                      class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                      id="addAdvantagesRow">
                      Tambahkan Keunggulan +
                    </button>
                  </div>

                  <div class="col-span-6">
                    <label for="note" class="block mb-3 font-medium text-gray-700 text-md">Note <span
                        class="text-gray-400">(Optional)</span></label>

                    <input placeholder="Hal yang ingin disampaikan oleh kamu?" type="text" name="note" id="note"
                      autocomplete="note"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $service->note ??'' }}">
                    @if ($errors->has('note'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('note') }}</p>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="tagline" class="block mb-3 font-medium text-gray-700 text-md">Tagline <span
                        class="text-gray-400">(Optional)</span></label>
                    @if ($tagline)
                    @foreach ($tagline as $key => $item)
                    <input placeholder="Tagline" type="text" name="tagline[{{ $item->id }}]]" id="tagline"
                      autocomplete="tagline"
                      class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                      value="{{ $item->tagline }}">
                    @if ($errors->has('tagline'))
                    <p class="text-red-700 mb-3 text-sm">{{ $errors->first('tagline') }}</p>
                    @endif
                    @endforeach
                    @endif

                    <div id="newTaglineRow"></div>
                    <button type="button"
                      class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                      id="addTaglineRow">
                      Tambahkan Tagline +
                    </button>
                  </div>

                </div>
              </div>

              <div class="px-4 py-3 text-right sm:px-6">

                <button type="reset"
                  class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                  Cancel
                </button>

                <button type="submit"
                  class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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

@push('after-script')

<script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
<script type="text/javascript">
  // add row
$("#addAdvantagesRow").click(function() {
var html = '';
html += '<input placeholder="Keunggulan Mu" type="text" name="advantage_users[]" id="advantage_users" autocomplete="advantage_users" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

$('#newAdvantagesRow').append(html);
});

// remove row
$(document).on('click', '#removeAdvantagesRow', function() {
$(this).closest('#inputFormAdvantagesRow').remove();
});
</script>

<script type="text/javascript">
  // add row
  $("#addServicesRow").click(function() {
  var html = '';
  html += '<input placeholder="Keunggulan Service" type="text" name="advantage_services[]" id="advantage_services" autocomplete="advantage_services"class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

  $('#newServicesRow').append(html);
  });

  // remove row
  $(document).on('click', '#removeServicesRow', function() {
  $(this).closest('#inputFormServicesRow').remove();
  });
</script>

<script type="text/javascript">
  // add row
  $("#addTaglineRow").click(function() {
  var html = '';
  html += '<input placeholder="Tagline" type="text" name="taglines[]" id="taglines" autocomplete="taglines" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" >';

  $('#newTaglineRow').append(html);
  });

  // remove row
  $(document).on('click', '#removeTaglineRow', function() {
  $(this).closest('#inputFormTaglineRow').remove();
  });
</script>

<script type="text/javascript">
  // add row
$("#addThumbnailRow").click(function() {
var html = '';
html += '<input placeholder="Keunggulan 3" type="file" name="thumbnails[]" id="thumbnails" autocomplete="thumbnails"  class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" >';

$('#newThumbnailRow').append(html);
});

// remove row
$(document).on('click', '#removeThumbnailRow', function() {
$(this).closest('#inputFormThumbnailRow').remove();
});
</script>

@endpush
