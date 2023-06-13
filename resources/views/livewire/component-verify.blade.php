<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="sector_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sector') }}</label>
                        <select id="sector_id" wire:model="sector_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name }}-{{ $sector->description }}</option>
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
                        <x-jet-input-error for="entity_id" />
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
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <ul>
                                        @foreach ($planning->plannings as $child)
                                            <li>
                                                {{ $child->code }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </th>
                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($planning->types as $type)
                                            <li class="flex items-center gap-2">
                                                {{ $type->name }}
                                                {{--
                                                @if ($planning->is_approved == false)
                                                    <a wire:click='modalDeleteType({{ $planning->id }}, {{ $type->id }})'
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                                @endif
                                                --}}
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

                                <td class="py-4 px-6">
                                    <ul>
                                        <li>
                                            <a href="{{ route('page.show', $planning) }}"
                                                class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">{{ __('Show') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('page.showIndicator', $planning) }}"
                                                class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer">{{ __('Indicator') }}</a>
                                        </li>
                                        {{--  
                                        @if ($planning->is_approved == false)
                                            <li>
                                                <a wire:click='modalAddType({{ $planning->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Type') }}</a>
                                            </li>
                                        @endif
                                        --}}
                                        <li>
                                            <a wire:click='modalValidate({{ $planning->id }})'
                                                class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">{{ __('Validate') }}</a>
                                        </li>
                                        @if ($planning->is_approved == false)
                                            <li>
                                                <a href="{{ route('page.observation', $planning) }}"
                                                    class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline cursor-pointer">{{ __('Observation') }}</a>
                                            </li>
                                        @endif
                                    </ul>
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
