<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="name" id="name" wire:model='name'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="name"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Entity') }}
                        </label>
                        <x-jet-input-error for="name" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="acronym" id="acronym" wire:model='acronym'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="acronym"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Acronym') }}
                        </label>
                        <x-jet-input-error for="acronym" />
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="parent_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Father') }}</label>

                        <select id="parent_id" wire:model="parent_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="null">{{ __('Select an option') }}</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="parent_id" />
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
                                {{ __('Entity') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Acronym') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('Parent') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($entities as $entity)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $entity->name }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $entity->acronym }}
                                </td>
                                <td class="py-4 px-6">
                                    <ul>
                                        @foreach ($entity->entities as $entity)
                                            <li>{{ $entity->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a wire:click='edit({{ $entity->id }})'
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Edit') }}</a>
                                    <a wire:click='modalDelete({{ $entity->id }})'
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endslot
        @slot('paginate')
            {{ $entities->links('vendor.livewire.custom') }}
        @endslot
    </x-table-form>
</div>
