<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manager') }}
        </h2>
        <p>Role & Permissions</p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex justify-between gap-2 px-5 py-5 mb-4">
                    <div class="block p-2 border shadow-xl">
                        <form action="{{ route('manager.store.role') }}" method="post">
                            @csrf
                            <div>
                                <x-input-label for="role" :value="__('New Role')" />
                                <x-text-input id="role" class="block w-full mt-1" type="text" name="role" :value="old('role')" autofocus />
                                <x-input-error :messages="$errors->storeRole->get('role')" class="mt-2" />
                                <button type="submit" class="items-center block px-4 py-2 mt-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">ENREGISTRER</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="block p-2 border shadow-xl">
                        <form action="{{ route('manager.store.permission') }}" method="post">
                            @csrf
                            <div>
                                <x-input-label for="permission" :value="__('New Permission')" />
                                <x-text-input id="permission" class="block w-full mt-1" type="text" name="permission" :value="old('permission')" autofocus />
                                <x-input-error :messages="$errors->storePermission->get('permission')" class="mt-2" />
                                <div>
                                    <button type="submit" class="float-right px-4 py-2 mt-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">ENREGISTRER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="relative mx-3 mt-4 overflow-x-auto shadow-xl">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-xs text-white uppercase bg-gray-500">
                            <tr>
                                <th scope="col" class="p-2">
                                    Permissions
                                </th>
                                @foreach ($roles as $role)
                                <th scope="col" class="p-2">
                                    <a href="{{route('manager.show.role', $role)}}">
                                        {{ $role->name }}
                                    </a>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($permissions as $permission)
                            <tr class="bg-white border-b">
                                <th scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $permission->name }}
                                </th>
                                @foreach ($roles as $role)
                                <td class="p-2">
                                    @php
                            if($permission->hasRole($role->name))
                            {
                                $toogle_permission = true;
                            }else{
                                $toogle_permission = 0;
                            }
                        @endphp
                                    <toggle-permission
                                        :permission-id="{{ $permission->id }}"
                                        :role="{{ $role->id }}"
                                        :has-permission="{{ $toogle_permission }}"
                                        :user-can-toggle="{{ Auth::user()->hasanyrole('Super Admin|Admin')?1:0 }}"
                                    />
                                    @if ($permission->hasRole($role->name))
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                                        <path fill="#63E6BE" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                                        <path fill="#ff0000" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                    </svg>
                                    @endif
                                </td>
                                @endforeach

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

