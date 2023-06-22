<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="entity_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Entity') }}</label>
                        <select id="entity_id" wire:model="entity_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            <option value="{{ $entityFather->id }}">{{ $entityFather->name }}</option>
                            @foreach ($entities as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="entity_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="sector_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sector') }}</label>
                        <select id="sector_id" wire:model="sector_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name }} {{ $sector->description }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="sector_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="type_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Type') }}</label>
                        <select id="type_id" wire:model="type_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="type_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="indicator_type_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Type') }}
                            {{ __('Indicator') }}</label>
                        <select id="indicator_type_id" wire:model="indicator_type_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($indicator_types as $indicator_type)
                                <option value="{{ $indicator_type->id }}">{{ $indicator_type->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="indicator_type_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <a wire:click='exportExcel' wire:loading.attr="exportExcel" wire:target="exportExcel"
                            class="col-span-1 sm:col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer disabled:opacity-25 transition">
                            {{ __('Export') }}
                        </a>
                    </div>
                </div>
            </form>
        @endslot
    </x-data-form>

    <x-search-form>
        @slot('search')
            <form>
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <input type="text" id="search" wire:model="search"
                        class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder=" ">

                    @if ($search != null)
                        <a wire:click='resetSearch'
                            class="text-white absolute right-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                            X
                        </a>
                    @endif
                </div>
            </form>
        @endslot
    </x-search-form>

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
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($plannings as $planning)
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
                                            @if ($indicator_type_id != null)
                                                @if ($indicator->types->where('id', $indicator_type_id)->count() > 0)
                                                    <li>
                                                        {{ $indicator->description }}

                                                        <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                                            {{ __('Schedule') }}
                                                        </h1>

                                                        <table
                                                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                                                <tr
                                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                    @foreach ($indicator->schedules as $schedule)
                                                                        <td class="py-4 px-6">
                                                                            {{ $schedule->description }}
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </li>
                                                @endif
                                            @else
                                                <li>
                                                    {{ $indicator->description }}

                                                    <h1 class="text-lg m-2 text-gray-900 dark:text-white">
                                                        {{ __('Schedule') }}
                                                    </h1>

                                                    <table
                                                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                                            <tr
                                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                @foreach ($indicator->schedules as $schedule)
                                                                    <td class="py-4 px-6">
                                                                        {{ $schedule->description }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </li>
                                            @endif
                                            {{--  <li>
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
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            @foreach ($indicator->schedules as $schedule)
                                                                <td class="py-4 px-6">
                                                                    {{ $schedule->description }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </li>
                                            --}}
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
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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

                                                    <table
                                                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                                            <tr
                                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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

                                                    <table
                                                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                                            <tr
                                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
