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

                            <th scope="col" class="py-3 px-6">
                                {{ __('State') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                            $visibility = false;
                        @endphp

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $planning->code }}
                            </th>

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
                                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                        <li>
                                            {{ $indicator->description }}

                                            <h1 class="text-lg m-2 text-gray-900 dark:text-white">{{ __('Schedule') }}
                                            </h1>

                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        @foreach ($indicator->schedules as $schedule)
                                                            <th scope="col" class="py-3 px-6">
                                                                {{ $schedule->date }}
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        @foreach ($indicator->schedules as $schedule)
                                                            <td class="py-4 px-6">
                                                                {{ $schedule->description }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </li>
                                    </ul>
                                @endforeach
                            </td>

                            <td class="py-4 px-6">
                                @foreach ($planning->territories as $territory)
                                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                        <li>
                                            {{ $territory->municipality->department->name }}
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

                                            <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                                {{ __('Consolidated') }}</h1>

                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        @foreach ($finance->consolidateds as $consolidated)
                                                            <th scope="col" class="py-3 px-6">
                                                                {{ $consolidated->date }}
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        @foreach ($finance->consolidateds as $consolidated)
                                                            <td class="py-4 px-6">
                                                                {{ $consolidated->budget }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>

                                            @if ($visibility)
                                                <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                                    {{ __('Investment') }}</h1>

                                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                    <thead
                                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                        <tr>
                                                            @foreach ($finance->investments as $investment)
                                                                <th scope="col" class="py-3 px-6">
                                                                    {{ $investment->date }}
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            @foreach ($finance->investments as $investment)
                                                                <td class="py-4 px-6">
                                                                    {{ $investment->budget }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                                    {{ __('Current') }}</h1>

                                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                    <thead
                                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                        <tr>
                                                            @foreach ($finance->currents as $current)
                                                                <th scope="col" class="py-3 px-6">
                                                                    {{ $current->date }}
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            @foreach ($finance->currents as $current)
                                                                <td class="py-4 px-6">
                                                                    {{ $current->budget }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        </li>
                                    </ul>
                                @endforeach
                            </td>

                            <td class="py-4 px-6">
                                <ul>
                                    @if (is_null($planning->is_approved))
                                        <li class="text-yellow-400">{{ __('Pending') }}</li>
                                    @endif
                                    @if ($planning->is_approved == true)
                                        <li class="text-green-400">{{ __('Approved') }}</li>
                                    @endif
                                    @if ($planning->is_approved == false)
                                        <li class="text-orange-400">{{ __('Review') }}</li>
                                    @endif
                                </ul>
                            </td>

                            <td class="py-4 px-6">
                                <ul>
                                    <li>
                                        <a wire:click='modalValidate({{ $planning->id }})'
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">{{ __('Validate') }}</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endslot

        @slot('paginate')
        @endslot
    </x-table-form>

    <x-dialog-modal wire:model="validateModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-blue-500 mr-2" />
                {{ __('Validate') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-folder-plus class="h-20 w-20 text-blue-500 mr-2" />
                <div class="relative z-0 mb-6 w-full group">
                    <select id="is_approved" wire:model="is_approved"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Select an option') }}</option>
                        <option value="1">{{ __('Approved') }}</option>
                        <option value="0">{{ __('Review') }}</option>
                    </select>
                    <x-jet-input-error for="is_approved" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('validateModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='validatePlanning' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
