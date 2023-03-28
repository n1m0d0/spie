<div class="grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-1 text-center md:col-span-12 p-4 mb-4">
        <h5 class="text-3xl font-bold leading-none text-gray-900 dark:text-white">
            {{ __('Territory') }}
        </h5>
    </div>

    <div class="col-span-1 md:col-span-12 p-2">
        <div
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">

                </h5>
            </div>

            @foreach ($departments as $department)
                <div class="flow-root">

                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <x-feathericon-book-open class="h-8 w-8 text-gray-500 mr-2" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                {{ __('Department') }}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ $department->name }}
                            </p>
                        </div>
                    </div>

                    <x-table-form>
                        @slot('table')
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('Municipality') }}
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('Indicator') }}
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($department->municipalities as $municipality)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $municipality->name }}
                                                </th>

                                                <th scope="row"
                                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    @php
                                                        $addition = 0;
                                                        foreach ($municipality->territories as $territory) {
                                                            if ($territory->planning != null) {
                                                                $addition = $territory->planning->indicators->count();
                                                            }
                                                        }
                                                    @endphp

                                                    {{ $addition }}
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endslot
                        @slot('paginate')
                        @endslot
                    </x-table-form>
                </div>
            @endforeach
        </div>
    </div>
</div>
