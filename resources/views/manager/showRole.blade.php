<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manager') }}
        </h2>
        <p>Role: <span class="font-bold">{{$role->name}}</span></p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="block overflow-hidden bg-white shadow-sm sm:rounded-lg">


                <ul class="justify-center block w-full font-medium text-gray-900 bg-white border border-gray-200 rounded-lg text-fsm">
                    @foreach ($permissions as $permission)
                    <li class="flex justify-between w-full px-4 py-2 border-b border-gray-200 rounded-t-lg">
                        @php
                            if($permission->hasRole($role->name))
                            {
                                $toogle_permission = true;
                            }else{
                                $toogle_permission = 0;
                            }
                        @endphp
                        <span>{{ $permission->name }} - {{ $toogle_permission }}</span>
                        <role-toggle-permission
                            v-bind:permission-id="{{ $permission->id }}"
                            v-bind:role="{{ $role->id }}"
                            v-bind:has-permission="{{ $toogle_permission }}"
                        />
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>

