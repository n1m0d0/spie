<div>
    <x-table-form>
        @slot('table')
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Code') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Sector') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Pillar') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Hub') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Goal') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Result') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Action') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Result description') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Action description') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Indicator') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Territory') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                {{ __('Finance') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($plannings as $planning)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $planning->code }}
                                </th>

                                <td class="py-4 px-6">
                                    {{ $planning->sector->name }} {{ $planning->sector->description }}
                                </td>

                                <td class="py-4 px-6">
                                    @foreach ($planning->action->result->goal->hub->pillars as $pilar)
                                        <ul
                                            class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                            <li>
                                                {{ $pilar->name }} {{ $pilar->description }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->action->result->goal->hub->name }}
                                    {{ $planning->action->result->goal->hub->description }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->action->result->goal->name }}
                                    {{ $planning->action->result->goal->description }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->action->result->name }} {{ $planning->action->result->description }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->action->name }} {{ $planning->action->description }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->result_description }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $planning->action_description }}
                                </td>

                                <td class="py-4 px-6">
                                    @foreach ($planning->indicators as $indicator)
                                        <ul
                                            class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                            <li>
                                                {{ $indicator->description }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>

                                <td class="py-4 px-6">
                                    @foreach ($planning->territories as $territory)
                                        <ul
                                            class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                            <li>
                                                {{ $territory->municipality->department->name }}
                                                {{ $territory->municipality->name }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>

                                <td class="py-4 px-6">
                                    @foreach ($planning->finances as $finance)
                                        <ul
                                            class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                            <li>
                                                <p>
                                                    {{ __('Programmatic Category') }}:
                                                    {{ $finance->programmatic_category }}
                                                    <br>
                                                    {{ __('Budget') }}: {{ $finance->budget }}
                                                </p>
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endslot
        @slot('paginate')
            {{ $plannings->links('vendor.livewire.custom') }}
        @endslot
    </x-table-form>
</div>
