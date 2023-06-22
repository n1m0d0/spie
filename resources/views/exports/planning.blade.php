<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">
                {{ __('Code') }}
            </th>

            <th scope="col" class="py-3 px-6">
                {{ __('Entity') }}
            </th>

            <th scope="col" class="py-3 px-6">
                {{ __('Type') }}
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
        </tr>
    </thead>

    <tbody>
        @foreach ($plannings as $planning)
            @php
                $visibility = false;
            @endphp

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $planning->code }}
                </th>

                <td class="py-4 px-6">
                    {{ $planning->entity->name }}
                </td>

                <td class="py-4 px-6">
                    <ul>
                        @foreach ($planning->types as $type)
                            <li class="flex items-center gap-2">
                                {{ $type->name }}
                            </li>

                            @php
                                if ($type->id == 9 || $type->id == 10 || $type->id == 11) {
                                    $visibility = true;
                                }
                            @endphp
                        @endforeach
                    </ul>
                </td>

                <td class="py-4 px-6">
                    {{ $planning->sector->name }} {{ $planning->sector->description }}
                </td>

                <td class="py-4 px-6">
                    @foreach ($planning->action->result->goal->hub->pillars as $pilar)
                        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
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
                        @if ($indicator_type_id != null)
                            @if ($indicator->types->where('id', $indicator_type_id)->count() > 0)
                                {{ $indicator->description }}

                                <br>

                                <h1 class="text-lg m-2 text-gray-900 dark:text-white">{{ __('Schedule') }}
                                </h1>

                                <ul
                                    class="flex flex-wrap items-center justify-center mb-6 text-gray-900 dark:text-white">
                                    @foreach ($indicator->schedules as $schedule)
                                        <li>
                                            {{ $schedule->date }} => {{ $schedule->description }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            {{ $indicator->description }}

                            <br>

                            <h1 class="text-lg m-2 text-gray-900 dark:text-white">{{ __('Schedule') }}
                            </h1>

                            <ul class="flex flex-wrap items-center justify-center mb-6 text-gray-900 dark:text-white">
                                @foreach ($indicator->schedules as $schedule)
                                    <li>
                                        {{ $schedule->date }} => {{ $schedule->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </td>

                <td class="py-4 px-6">
                    @foreach ($planning->territories as $territory)
                        <ul>
                            <li>
                                {{ $territory->municipality->department->name }}
                                <br>
                                {{ $territory->municipality->name }}
                            </li>
                        </ul>
                    @endforeach
                </td>

                <td class="py-4 px-6">
                    @foreach ($planning->finances as $finance)
                        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                            <li>
                                <p>
                                    {{ __('Programmatic Category') }}:
                                    {{ $finance->programmatic_category }}
                                    <br>
                                    {{ __('Budget') }}: {{ $finance->budget }}
                                </p>

                                <br>

                                <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                    {{ __('Consolidated') }}</h1>

                                <ul
                                    class="flex flex-wrap items-center justify-center mb-6 text-gray-900 dark:text-white">
                                    @foreach ($finance->consolidateds as $consolidated)
                                        <li>
                                            {{ $consolidated->date }} => {{ $consolidated->budget }}
                                        </li>
                                    @endforeach
                                </ul>

                                <br>

                                @if ($visibility)
                                    <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                        {{ __('Investment') }}</h1>

                                    <ul
                                        class="flex flex-wrap items-center justify-center mb-6 text-gray-900 dark:text-white">
                                        @foreach ($finance->investments as $investment)
                                            <li>
                                                {{ $investment->date }} => {{ $investment->budget }}
                                            </li>
                                        @endforeach
                                    </ul>

                                    <br>

                                    <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                        {{ __('Current') }}</h1>

                                    <ul
                                        class="flex flex-wrap items-center justify-center mb-6 text-gray-900 dark:text-white">
                                        @foreach ($finance->currents as $current)
                                            <li>
                                                {{ $current->date }} => {{ $current->budget }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        </ul>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
