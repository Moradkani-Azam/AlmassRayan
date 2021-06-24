<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-6 md:gap-6">
            <div class="md:col-span-1 flex justify-between"></div>

            <div class="mt-5 md:mt-0 md:col-span-4">
                <form method="post" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Article Image -->
                            <div x-data="{imageName: null, imagePreview: null}" class="col-span-6 sm:col-span-4">
                                <!-- Article Image File Input -->
                                <input type="file"
                                name="image" class="hidden" x-ref="image" x-on:change="
                                                    imageName = $refs.image.files[0].name;
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        imagePreview = e.target.result;
                                                    };
                                                    reader.readAsDataURL($refs.image.files[0]);
                                            ">

                                <label class="block font-medium text-sm text-gray-700" for="image">
                                {{ __('Image') }}
                                </label>

                                <!-- Current Article image -->
                                <div class="mt-2" x-show="! imagePreview">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"  class="h-1/2 w-1/2 object-cover">
                                </div>

                                <!-- New Article image Preview -->
                                <div class="mt-2" x-show="imagePreview">
                                    <span class="block w-44 h-44" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
                                    </span>
                                </div>

                                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.image.click()">
                                        {{ __('Select A New Image') }}
                                    </x-jet-secondary-button>
                                    @if ($article->image)
                                        <x-jet-secondary-button id="deleteimage" type="button" class="mt-2" x-on:click.prevent="
                                        var id={{ $article->id }}
                                        $.ajax({
                                            url:'{{ route('articles.deleteimage', $article->id) }}',
                                            method:'get',
                                            success:function(data) {
                                                location.reload();
                                            }
                                        })
                                        ">
                                            {{ __('Remove Image') }}
                                        </x-jet-secondary-button>
                                    @endif
                            </div>

                            <!-- Title -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="title">
                                {{ __('Title') }}
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="title" type="text" value="{{ old('title', $article->title) }}" name="title" />
                                @error('title')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- User -->
                            <!-- <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="user">
                                {{ __('User') }}
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="user" type="text" name="user" value="{{ old('user', $article->user->name) }}"/>
                                @error('user')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div> -->

                            <!-- Body -->
                            <div class="col-span-6 sm:col-span-6">
                                <label class="block font-medium text-sm text-gray-700" for="body">
                                {{ __('Body') }}
                                </label>
                                <textarea id="mytextarea" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" name="body" >{{ old('body', $article->body) }}</textarea>
                                @error('body')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 uppercase text-black font-bold py-2 px-4 rounded">{{ __('Cancel') }}</a>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
