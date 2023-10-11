<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('dashboard') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Back</a>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <label for="" class="font-medium mb-5">Details of Uploaded Document - {{ $document->original_filename }}</label>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unique Key
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Style
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sanmar Mainframe Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Size
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Piece Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Last Updated Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($csvDetails as $csvDetail)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $csvDetails->firstItem() + $loop->index }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->unique_key }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->product_title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->product_description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->style }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->sanmar_mainframe_color }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->size }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->color_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->piece_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $csvDetail->updated_at->format('d/m/Y H:i:s') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-center">
                                            No records found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $csvDetails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
