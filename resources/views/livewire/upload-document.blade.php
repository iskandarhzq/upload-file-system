<div>
    <label for="" class="font-medium">Upload Documents</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple wire:model="uploadFiles">
    {{-- If files uploaded, display the filename --}}
    @foreach ($uploadFiles as $index => $uploadFile)
        <div class="mt-3">
            <div class="border shadow-sm sm:rounded-lg rounded-1 flex flex-row justify-between items-center p-3" style="height: 60px;">
                <div class="flex flex-row justify-center items-center">
                    <i class="fas fa-file-upload text-lg text-gray-500 mr-3"></i>
                    <h6 class="font-normal text-sm">{{ $uploadFile->getClientOriginalName() }}</h6>
                </div>
                <div role="button" wire:click="removeUpload({{ $index }})">
                    <i class="fas fa-trash text-red-500 mr-3"></i>
                </div>
            </div>
        </div>
    @endforeach
    <div class="flex items-center justify-end">
        <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-3 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click='clearUploadDocument'>Clear</button>
        <button type="button" wire:click='onUploadDocument'
            @if (count($uploadFiles) == 0) class="text-white bg-green-400 dark:bg-green-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mt-3" disabled @else class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-3 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" @endif>Upload</button>
    </div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <label for="" class="font-medium">List of Uploaded Documents</label>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        File Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $document->created_at?->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $document->original_filename }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $document->status }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
</div>
