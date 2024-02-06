<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">

        <h1 class="text-white">Update support ticket</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md  overflow-hidden sm:rounded-lg">
            <form method="post" action="{{ route('tickets.update',$ticket->id) }}" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $ticket->title }}" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
                         focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">{{ $ticket->description }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="attachment" :value="__('Attachment(if any)')" />
                    <x-text-input id="attachment" class="block mt-1 w-full" type="file" name="attachment" :value="old('attachment')"  autofocus />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        Update
                    </x-primary-button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>