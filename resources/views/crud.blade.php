<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($data['title']) }}
            </h2>
            <x-button class="ml-4 bg-sky-500/100 text-white add-new" type="button">
                {{ __("Add $data[action]") }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-table-crud :data="$data" />
            </div>
        </div>
    </div>
</x-app-layout>
