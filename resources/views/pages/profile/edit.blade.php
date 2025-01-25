<x-layout>
    <x-navbar/>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-6">
            <input type="file" name="profile_picture" placeholder="Select an image..."/>
        </div>
        <x-button type="submit" name="Save"/>
        <x-link-button href="/profile" name="Back"/>
    </form>
</x-layout>
