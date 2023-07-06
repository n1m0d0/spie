<div>
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
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Type') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Formula') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Base line') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Goal') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Measure') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Dissociation') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Articulate') }}
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($indicators as $indicator)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 dark:text-white">
                                    {{ $indicator->description }}
                                </th>
                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($indicator->types as $type)
                                            <li class="flex items-center gap-2">
                                                {{ $type->name }}
                                                {{--  
                                                @if ($indicator->planning->is_approved == false)
                                                    <a wire:click='modalDeleteType({{ $indicator->id }}, {{ $type->id }})'
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                                @endif
                                                --}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-4 px-6">
                                    {{ $indicator->formula }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $indicator->year }} - {{ $indicator->base_line }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $indicator->ending }} - {{ $indicator->worth }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $indicator->measure }}
                                </td>

                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($indicator->dissociations as $dissociation)
                                            <li class="flex items-center gap-2">
                                                {{ $dissociation->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($indicator->pointers as $pointer)
                                            <li class="flex items-center gap-2">
                                                {{ $pointer->description }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="py-4 px-6">
                                    <ul>
                                        {{--  
                                        @if ($indicator->planning->is_approved == false)
                                            <li>
                                                <a wire:click='modalAddType({{ $indicator->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Type') }}</a>
                                            </li>
                                        @endif
                                        --}}
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endslot
        @slot('paginate')
            {{ $indicators->links('vendor.livewire.custom') }}
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
</div>
