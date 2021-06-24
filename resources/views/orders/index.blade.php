<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Order List') }}
      </h2>
  </x-slot>

  <div>
      <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
          <div class="block mb-8">
              <a href="{{ route('orders.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Add Order') }}</a>
          </div>
            @if (session('status'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 mb-8 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">{{ session('status') }}</p>
                    <!-- <p class="text-sm">Make sure you know how these changes affect you.</p> -->
                    </div>
                </div>
            </div>
            @endif
          <div class="flex flex-col" x-data="">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-200 w-full">
                              <thead>
                              <tr>
                                  <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Title') }}
                                  </th>
                                  <th scope="col" class="hidden lg:table-cell px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Wood Material') }}
                                  </th>
                                  <th scope="col" class="hidden lg:table-cell px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Color') }}
                                  </th>
                                  <th scope="col" class="hidden lg:table-cell px-6 py-3 w-56 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Description') }}
                                  </th>
                                  <th scope="col" class="hidden lg:table-cell px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Price') }}
                                  </th>
                                  <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  {{ __('Status') }}
                                  </th>

                                  <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                  </th>
                              </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                              @foreach ($orders as $order)
                                  <tr>
                                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $order->title }}
                                      </td>

                                      <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          {{ $order->wood_material->name }}
                                      </td>

                                      <td class="hidden lg:table-cell px-6 py-2 whitespace-nowrap text-sm text-gray-900">
                                        {{ $order->color->name }}
                                        <div class="w-8 h-4 mt-1" style="background-color: {{$order->color->code}};"></div>
                                      </td>
                                      <td class="hidden lg:table-cell px-6 py-4 w-56 whitespace-wrap text-sm text-gray-900">
                                      {!! \Illuminate\Support\Str::limit($order->description, $limit = 100, $end = '...') !!}
                                      </td>
                                      <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($order->price) {{number_format($order->price)}}
                                        @else -
                                        @endif
                                      </td>

                                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"  x-bind:class="{
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

                                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                          <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">{{ __('View') }}</a>
                                          <!-- <a href="{{ route('orders.edit', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">{{ __('Edit') }}</a> -->
                                          <!-- <form class="inline-block" action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                              <input type="hidden" name="_method" value="DELETE">
                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                              <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                          </form> -->
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="mx-10 my-10">{{ $orders->links() }}</div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
