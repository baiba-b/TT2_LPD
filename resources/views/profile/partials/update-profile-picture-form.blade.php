<form method="POST" action="{{ route('profile.update_picture') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
        @if (auth()->user()->profile_picture)
            <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" style="width: 150px; height: 150px;">
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Save Changes
        </button>
    </div>
</form>
