<div>
    <x-data-form>
        @slot('form')
            <form class="mt-2">
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-xl lg:text-2xl dark:text-gray-400">
                    {{ __('code') }}: {{ $planning->code }}
                </h1>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            {{ __('Indicator') }}
                        </label>
                        <textarea id="description" wire:model='description' rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""></textarea>
                        <x-jet-input-error for="description" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="formula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            {{ __('Formula') }}
                        </label>
                        <textarea id="formula" wire:model='formula' rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""></textarea>
                        <x-jet-input-error for="formula" />
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="year"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Year') }}
                            {{ __('Base line') }}</label>
                        <select id="year" wire:model="year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            <option value="2020">2020</option>
                        </select>
                        <x-jet-input-error for="year" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <label for="ending"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Goal') }}</label>
                        <select id="ending" wire:model="ending"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">{{ __('Select an option') }}</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <x-jet-input-error for="ending" />
                    </div>
                </div>

                <div class="grid md:grid-cols-4 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="base_line" id="base_line" wire:model='base_line'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="base_line"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Value') }}
                        </label>
                        <x-jet-input-error for="base_line" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="worth" id="worth" wire:model='worth'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="worth"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Value') }}
                        </label>
                        <x-jet-input-error for="worth" />
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="measure" id="measure" wire:model='measure'
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />

                        <label for="measure"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ __('Measure') }}
                        </label>
                        <x-jet-input-error for="measure" />
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
                                <span class="sr-only">Options</span>
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
                                                <a wire:click='modalDeleteType({{ $indicator->id }}, {{ $type->id }})'
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
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
                                                <a wire:click='modalDeleteDissociation({{ $indicator->id }}, {{ $dissociation->id }})'
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="py-4 px-6">
                                    <ul>
                                        <li>
                                            <a wire:click='edit({{ $indicator->id }})'
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Edit') }}</a>
                                        </li>

                                        <li>
                                            <a wire:click='modalDelete({{ $indicator->id }})'
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">{{ __('Delete') }}</a>
                                        </li>
                                    </ul>
                                </td>
                                <td class="py-4 px-6">
                                    <ul>
                                        <li>
                                            <a wire:click='modalAddType({{ $indicator->id }})'
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Type') }}</a>
                                        </li>

                                        <li>
                                            <a wire:click='modalAdd({{ $indicator->id }})'
                                                class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">{{ __('Dissociation') }}</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('page.frequency', $indicator) }}"
                                                class="font-medium text-purple-600 dark:text-purple-500 hover:underline cursor-pointer">{{ __('Frequency') }}</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('page.schedule', $indicator) }}"
                                                class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">{{ __('Schedule') }}</a>
                                        </li>          
                                        
                                        <li>
                                            <a href="{{ route('page.articulate', $indicator) }}"
                                                class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer">{{ __('Articulate') }}</a>
                                        </li>    
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

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete goal') }}
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

    <x-dialog-modal wire:model="addModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-green-500 mr-2" />
                {{ __('Add') }} {{ __('Dissociation') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-folder-plus class="h-20 w-20 text-green-500 mr-2" />
                <div class="relative z-0 mb-6 w-full group">
                    <label for="dissociation_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Dissociation') }}</label>
                    <select id="dissociation_id" wire:model="dissociation_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Select an option') }}</option>
                        @foreach ($dissociations as $dissociation)
                            <option value="{{ $dissociation->id }}">{{ $dissociation->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="dissociation_id" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('addModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='add' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="deleteDissociationModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete') }} {{ __('Dissociation') }}
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
            <x-jet-danger-button wire:click="$set('deleteDissociationModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='deleteDissociation' wire:loading.attr="disabled">
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
</div>
