<x-layout>
    <div class="flex justify-center items-center">
        <div class="bg-white w-full p-10 rounded-lg shadow-md m-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Write Your Ticket</h2>
            <p class="text-gray-600 mt-1">Write your ticket details below.</p>

            <form action="{{ route('tickets.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title" class=" block text-sm text-gray-700 font-medium mt-1">Title</label>
                    <input type="text" name="title" id="title" placeholder="Software installation request" value="{{ old('title') }}"
                        class=" px-3 py-2 border border-gray-300  appearance-none rounded-lg placeholder-gray-400 focus:outline-none w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('title') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                </div>

                <div>
                    <label class="block text-sm text-gray-700 font-medium mt-1" for="categories">Category</label>
                    <select name="category" id="categories" class="px-3 py-2 border border-gray-300  appearance-none rounded-lg placeholder-gray-400 focus:outline-none w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('category') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                        <option value="" hidden></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select> 
                </div>

                <div>
                    <label for="message" class="block text-sm text-gray-700 font-medium mt-1">Message</label>
                    <textarea 
                        name="message" 
                        id="message" 
                        placeholder="Describe the issue in detail…" 
                        rows="6"
                        class="px-3 py-2 border appearance-none resize-none rounded-lg placeholder-gray-400 focus:outline-none w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('message') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">{{ old('message') }}</textarea>
                </div>

                <div>
                    <label for="priority" class="block text-sm text-gray-700 font-medium mt-1">Priority</label>
                    <select name="priority" id="priority" class="px-3 py-2 border border-gray-300  appearance-none rounded-lg placeholder-gray-400 focus:outline-none w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('priority') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                        <option value="" hidden></option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select> 
                </div>

                <div>
                    <label for="attachment" class="block text-sm text-gray-700 font-medium mt-1.5">File Upload</label>
                    <input type="file" name="attachment[]" multiple id="attachment" class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700         {{ $errors->has('attachment') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                    <small class="block text-sm text-gray-500 mt-1">Maximum file size: 10MB</small>
                </div>

                  <div>
                    <button class="mt-3 w-full flex border-transparent bg-blue-600 hover:bg-blue-700 justify-center py-2 px-4 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-200 text-sm font-medium rounded-md" type="submit">+ Create Ticket</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>