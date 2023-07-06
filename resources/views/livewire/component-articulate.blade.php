<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <div class="grid md:grid-cols-4 md:gap-6">
                    <div class="col-span-1 md:col-span-4">
                        <label for="pointer_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Indicator') }}
                            ODS</label>

                        <select id="pointer_id" wire:model="pointer_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($pointers as $pointer)
                                <option value="{{ $pointer->id }}">{{ $pointer->code }} - {{ $pointer->description }}
                                </option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="pointer_id" />
                    </div>                   

                    <div class="col-span-1 md:col-span-4">
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

                            <input type="text" id="searchIndicator" wire:model="searchIndicator"
                                class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder=" ">

                            @if ($searchIndicator != null)
                                <a wire:click='resetSearchIndicator'
                                    class="text-white absolute right-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                                    X
                                </a>
                            @endif
                        </div>
                    </div>

                    @if ($searchIndicator != null)
                        <div class="col-span-1 md:col-span-4">
                            <ul
                                class="w-full max-h-64 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($pointers as $pointer)
                                    <li wire:click='selectPointer({{ $pointer->id }})'
                                        class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 cursor-pointer">
                                        {{ $pointer->code }} - {{ $pointer->description }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>                        
                    @endif

                    <div class="col-span-1 md:col-span-4 grid grid-cols-1 sm:grid-cols-12 gap-2">
                        <a wire:click='store' wire:loading.attr="disabled" wire:target="store"
                            class="col-span-1 sm:col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer disabled:opacity-25 transition">
                            {{ __('Create') }}
                        </a>

                        <a wire:click='clear' wire:loading.attr="disabled"
                            class="col-span-1 sm:col-span-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                            {{ __('Cancel') }}
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
                                {{ __('Indicator') }} ODS
                            </th>

                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($relations as $relation)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 dark:text-white">
                                    {{ $relation->description }}
                                </th>

                                <td class="py-4 px-6 text-right">
                                    <a wire:click='modalDelete({{ $relation->id }}, {{ $indicator->id }})'
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endslot
        @slot('paginate')
            {{ $relations->links('vendor.livewire.custom') }}
        @endslot
    </x-table-form>

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete') }}
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
</div>
