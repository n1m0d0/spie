<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <div class="grid md:grid-cols-4 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="pillar_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Pillar') }}</label>

                        <select id="pillar_id" wire:model="pillar_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($pillars as $pillar)
                                <option value="{{ $pillar->id }}">{{ $pillar->name }}-{{ $pillar->description }}</option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchPillar' type="text"
                            placeholder="{{ __('Search') }} {{ __('Pillar') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchPillar != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchPillars as $searchPillar)
                                    <li wire:click='selectPillar({{ $searchPillar->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchPillar->name }}-{{ $searchPillar->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="pillar_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="hub_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Hub') }}</label>

                        <select id="hub_id" wire:model="hub_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($hubs as $hub)
                                <option value="{{ $hub->id }}">{{ $hub->name }}-{{ $hub->description }}</option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchHub' type="text"
                            placeholder="{{ __('Search') }} {{ __('Hub') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchHub != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchHubs as $searchHub)
                                    <li wire:click='selectHub({{ $searchHub->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchHub->name }}-{{ $searchHub->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="hub_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="goal_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Goal') }}</label>

                        <select id="goal_id" wire:model="goal_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}-{{ $goal->description }}</option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchGoal' type="text"
                            placeholder="{{ __('Search') }} {{ __('Goal') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchGoal != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchGoals as $searchGoal)
                                    <li wire:click='selectGoal({{ $searchGoal->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchGoal->name }}-{{ $searchGoal->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="goal_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="result_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Result') }}</label>

                        <select id="result_id" wire:model="result_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($results as $result)
                                <option value="{{ $result->id }}">{{ $result->name }}-{{ $result->description }}
                                </option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchResult' type="text"
                            placeholder="{{ __('Search') }} {{ __('Result') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchResult != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchResults as $searchResult)
                                    <li wire:click='selectResult({{ $searchResult->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchResult->name }}-{{ $searchResult->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="result_id" />
                    </div>
                </div>

                <div class="grid md:grid-cols-4 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="action_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Action') }}</label>

                        <select id="action_id" wire:model="action_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($actions as $action)
                                <option value="{{ $action->id }}">{{ $action->name }}-{{ $action->description }}
                                </option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchAction' type="text"
                            placeholder="{{ __('Search') }} {{ __('Action') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchAction != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchActions as $searchAction)
                                    <li wire:click='selectAction({{ $searchAction->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchAction->name }}-{{ $searchAction->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="action_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="sector_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sector') }}</label>
                        <select id="sector_id" wire:model="sector_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name }}-{{ $sector->description }}
                                </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="sector_id" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="entity_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Entity') }}</label>
                        <select id="entity_id" wire:model="entity_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($entities as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                            @endforeach
                        </select>

                        <input wire:model='inputSearchEntity' type="text"
                            placeholder="{{ __('Search') }} {{ __('Entity') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">

                        @if ($inputSearchEntity != null)
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($searchEntities as $searchEntity)
                                    <li wire:click='selectEntity({{ $searchEntity->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $searchEntity->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-jet-input-error for="entity_id" />
                    </div>

                </div>

                <div class="grid md:grid-cols-4 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="code" id="code" wire:model='code'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="code"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Code') }}
                        </label>
                        <x-jet-input-error for="code" />
                    </div>

                    @if (Auth::user()->getRoleNames()[0] == 'creador territorial')
                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="action_code" id="action_code" wire:model='action_code'
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />

                            <label for="action_code"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                {{ __('Code') }} {{ __('Action') }}
                            </label>
                            <x-jet-input-error for="action_code" />
                        </div>
                    @endif
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="result_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            {{ __('Result description') }}
                        </label>
                        <textarea id="result_description" wire:model='result_description' rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""></textarea>
                        <x-jet-input-error for="result_description" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="action_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            {{ __('Action description') }}
                        </label>
                        <textarea id="action_description" wire:model='action_description' rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""></textarea>
                        <x-jet-input-error for="action_description" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-2">
                    @if ($activity == 'create')
                        <a wire:click='store' wire:loading.attr="disabled" wire:target="store"
                            class="col-span-1 sm:col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer disabled:opacity-25 transition">
                            {{ __('Create') }}
                        </a>
                    @endif

                    @if ($activity == 'edit')
                        <a wire:click='update' wire:loading.attr="disabled" wire:target="update"
                            class="col-span-1 sm:col-span-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 cursor-pointer disabled:opacity-25 transition">
                            {{ __('Update') }}
                        </a>
                        <a wire:click='clear' wire:loading.attr="disabled"
                            class="col-span-1 sm:col-span-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                            {{ __('Cancel') }}
                        </a>
                    @endif

                </div>
            </form>
        @endslot
    </x-data-form>
    <x-search-form>
        @slot('search')
            <div class="w-full grid grid-cols-1 sm:grid-cols-12 gap-2 items-center">
                <form class="col-span-1 md:col-span-6">
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
                <div class="col-span-1 md:col-span-6">
                    <label for="filterEntity_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Entity') }}</label>
                    <select id="filterEntity_id" wire:model="filterEntity_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Select an option') }}</option>
                        <option value="{{ $defaultFilterEntity->id }}">{{ $defaultFilterEntity->name }}</option>
                        @foreach ($filterEntities as $filterEntity)
                            <option value="{{ $filterEntity->id }}">{{ $filterEntity->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                                {{ __('Entity') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Connected') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Type') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Result description') }}
                            </th>
                            @if (Auth::user()->getRoleNames()[0] == 'creador territorial')
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Code') }} {{ __('Action') }}
                                </th>
                            @endif
                            <th scope="col" class="py-3 px-6">
                                {{ __('Action description') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Action') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('State') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Options</span>
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Actions</span>
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
                                    {{ $planning->entity->name }}
                                </td>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <ul>
                                        @foreach ($planning->plannings as $child)
                                            <li>
                                                {{ $child->code }}
                                                @if ($planning->is_approved == false)
                                                    <a wire:click='modalDisconnect({{ $child->id }})'
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </th>
                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($planning->types as $type)
                                            <li class="flex items-center gap-2">
                                                {{ $type->name }}
                                                @if ($planning->is_approved == false)
                                                    <a wire:click='modalDeleteType({{ $planning->id }}, {{ $type->id }})'
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-4 px-6">
                                    {{ $planning->result_description }}
                                </td>
                                @if (Auth::user()->getRoleNames()[0] == 'creador territorial')
                                    <td class="py-4 px-6">
                                        {{ $planning->action_code }}
                                    </td>
                                @endif
                                <td class="py-4 px-6">
                                    {{ $planning->action_description }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $planning->action->name }}
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
                                <td class="py-4 px-6 text-right">
                                    @if ($planning->is_approved == false)
                                        <ul>
                                            <li>
                                                <a wire:click='edit({{ $planning->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Edit') }}</a>
                                            </li>

                                            <li>
                                                <a wire:click='modalConnect({{ $planning->id }})'
                                                    class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">{{ __('Connect') }}</a>
                                            </li>

                                            <li>
                                                <a wire:click='modalDelete({{ $planning->id }})'
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($planning->is_approved == false)
                                        <ul>
                                            <li>
                                                <a wire:click='modalAddType({{ $planning->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Type') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('page.indicator', $planning) }}"
                                                    class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">{{ __('Indicator') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('page.territory', $planning) }}"
                                                    class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">{{ __('Territory') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('page.finance', $planning) }}"
                                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer">{{ __('Finance') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('page.showObservation', $planning) }}"
                                                    class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline cursor-pointer">{{ __('Observation') }}</a>
                                            </li>
                                        </ul>
                                    @endif
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

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete plannings') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-trash class="h-20 w-20 text-red-500 mr-2" />
                <p>
                    {{ __('Once deleted, the record cannot be recovered.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('deleteModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='delete' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="addModalType">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-blue-500 mr-2" />
                {{ __('Add') }} {{ __('Type') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-folder-plus class="h-20 w-20 text-blue-500 mr-2" />
                <div class="relative z-0 mb-6 w-full group">
                    <label for="type_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Dissociation') }}</label>
                    <select id="type_id" wire:model="type_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Select an option') }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="type_id" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('addModalType', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='addType' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="deleteTypeModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete') }} {{ __('Type') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-trash class="h-20 w-20 text-red-500 mr-2" />
                <p>
                    {{ __('Once deleted, the record cannot be recovered.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('deleteTypeModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='deleteType' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="connectModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-orange-500 mr-2" />
                {{ __('Connect') }} {{ __('Planning') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 items-center gap-2">
                <label for="parent_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Planning') }}</label>

                <select id="parent_id" wire:model="parent_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">{{ __('Select an option') }}</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->code }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="parent_id" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('connectModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='connect' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="disconnectModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete') }} {{ __('Connect') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-trash class="h-20 w-20 text-red-500 mr-2" />
                <p>
                    {{ __('Once deleted, the record cannot be recovered.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('disconnectModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='disconnect' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
