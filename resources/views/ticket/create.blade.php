<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">

        <h1 class="text-white">Create new support tieket</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md  overflow-hidden sm:rounded-lg">
            <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input placeholder="Enter the title" id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea placeholder="Enter a descriptions" id="description" name="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="attachment" :value="__('Attachment(if any)')" />
                    <x-text-input id="attachment" class="block mt-1 w-full" type="file" name="attachment" :value="old('attachment')"  autofocus />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        Create
                    </x-primary-button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>