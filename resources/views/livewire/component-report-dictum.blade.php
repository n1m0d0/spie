<div class="grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-1 text-center md:col-span-12 p-4 mb-4">
        <h5 class="text-3xl font-bold leading-none text-gray-900 dark:text-white">
            {{ __('Dictum') }}
        </h5>
    </div>

    @foreach ($hubs as $hub)
        <div class="col-span-1 md:col-span-6 p-2">
            <div
                class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        {{ $hub->name }} - {{ $hub->description }}
                    </h5>
                </div>


                <div class="flow-root">
                    <x-table-form>
                        @slot('table')
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('EE') }}
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('M') }}
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('R') }}
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                {{ __('A') }}
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($hub->goals as $goal)
                                            @foreach ($goal->results as $result)
                                                @foreach ($result->actions as $action)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <th scope="row"
                                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $action->result->goal->hub->name }}
                                                        </th>

                                                        <th scope="row"
                                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $action->result->goal->name }}
                                                        </th>

                                                        <th scope="row"
                                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $action->result->name }}
                                                        </th>

                                                        <th scope="row"
                                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $action->name }}
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endslot
                        @slot('paginate')
                        @endslot
                    </x-table-form>
                </div>
            </div>
        </div>
    @endforeach
</div>
