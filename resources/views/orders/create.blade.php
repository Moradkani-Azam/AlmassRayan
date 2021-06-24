<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-6 md:gap-6">
            <div class="md:col-span-1 flex justify-between"></div>

            <div class="mt-5 md:mt-0 md:col-span-4">
                <form method="post" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Title -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="title">
                                {{ __('Title') }}
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="title" type="text" value="{{ old('title', '') }}" name="title" />
                                @error('title')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="wood_material">
                                {{ __('Wood Material') }}
                                </label>
                                <select name="wood_material" id="wood_material" class="form-multiselect border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($wood_materials as $id => $wm)
                                    <option value="{{ $id }}"{{ $id == old('wood_material') ? ' selected' : '' }}>{{ $wm }}</option>
                                @endforeach
                                </select>
                                @error('wood_material')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="color">
                                {{ __('Color') }}
                                </label>
                                <select name="color" id="color" class="form-multiselect border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}"{{ $color->id == old('color') ? ' selected' : '' }} style="background-color: {{$color->code}};">{{ $color->name }}</option>
                                @endforeach
                                </select>
                                @error('color')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dimensions -->
                            <div class="col-span-6 sm:col-span-6">
                                <label class="block font-medium text-sm text-gray-700" for="dimensions">
                                {{ __('Dimensions') }}
                                </label>
                                <span class="font-s text-sm text-gray-700">Width: </span>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 mr-5 w-1/5" id="dimensions[width]" type="text" name="dimensions[width]" value="{{ old('dimensions[width]', '') }}"/>
                                <span class="font-s text-sm text-gray-700">Length: </span>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 mr-5 w-1/5" id="dimensions[length]" type="text" name="dimensions[length]" value="{{ old('dimensions[length]', '') }}"/>
                                <span class="font-s text-sm text-gray-700">Height: </span>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 w-1/5" id="dimensions[height]" type="text" name="dimensions[height]" value="{{ old('dimensions[height]', '') }}"/>
                                @error('dimensions.*')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-span-6 sm:col-span-6">
                                <label class="block font-medium text-sm text-gray-700" for="description">
                                {{ __('Description') }}
                                </label>
                                <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" name="description" >{{ old('description', '') }} </textarea>
                                @error('description')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 uppercase text-black font-bold py-2 px-4 rounded">{{ __('Cancel') }}</a>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
