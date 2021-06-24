<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Show Order') }}
        </h2>
    </x-slot>

    <div x-data="">
        <form method="post" action="{{ route('orders.changeStatus', $order->id) }}">
            @csrf
            @method('put')
            <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="block mb-8">
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">{{ __('Back to list') }}</a>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('ID') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->id }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Title') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->title }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Wood Material') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->wood_material->name }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Color') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->color->name }}
                                            <div class="inline-block w-8 h-4" style="background-color: {{$order->color->code}};"></div>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Dimensions') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            Width: {{ $order->dimensions['width'] }}, Length: {{ $order->dimensions['length'] }}, Height: {{ $order->dimensions['height'] }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Description') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->description }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('price') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900 bg-white">
                                            <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1" type="text" name="price" id="price" value="{{ $order->price }}" {{ $order->status === 2 ? 'disabled': '' }}>
                                            @error('price')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            x-bind:class="{
                                            'bg-yellow-100 text-yellow-800' : {{ $order->status }} === 0 ,
                                            'bg-blue-100 text-blue-800' : {{ $order->status }} === 1,
                                            'bg-green-100 text-green-800' : {{ $order->status }} === 2,
                                            'bg-red-100 text-red-800' : {{ $order->status }} === -1,
                                            }">
                                                @if($order->status == 0) Awaiting review
                                                @elseif($order->status == 1) Awaiting customer approval
                                                @elseif($order->status == 2) Completed
                                                @elseif($order->status == -1) Reject
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                        {{ __('Created At') }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $order->created_at }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-8">
                @if($order->status !== 2)
                    @if($order->status !== -1)
                        <button name="reject" value="-1" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-gray-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Reject') }}
                        </button>
                    @endif
                    <button name="accept" value="1" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Accept') }}
                    </button>
                @else
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">{{ __('Back to list') }}</a>
                @endif
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
