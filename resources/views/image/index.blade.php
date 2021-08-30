<x-app-layout>
    <x-slot name="tab_title">{{ $tab_title }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <div
            class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-700 px-4 max-w-7xl mx-auto py-3 shadow-md mt-3">
            <div class="flex">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full mb-12 px-4">
                        <div class="text-center bg-green-300 py-2 rounded mb-2 text-xl">
                            List TTE
                        </div>
                        <div
                            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-tr rounded-bl">
                            <div class="block w-full">
                                <!-- Projects table -->
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="text-left px-4">No</th>
                                            <th class="text-left px-2">NIP</th>
                                            <th class="text-left px-2">Nama</th>
                                            <th class="text-left px-2">Pangkat</th>
                                            <th class="text-left px-2">Posisi</th>
                                            <th class="text-left px-2">Jenis</th>
                                            <th class="text-left px-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($signs as $sign)
                                            <tr>
                                                <td class="border px-4 text-sm">{{ ++$i }}</td>
                                                <td class="border px-2 text-sm">
                                                    {{ substr_replace(substr_replace(substr_replace($sign->nip, ' ', 15, null), ' ', 14, null), ' ', 8, null) }}
                                                </td>
                                                <td class="border px-2 text-sm">{{ $sign->fullname }}</td>
                                                <td class="border px-2 text-sm">{{ $sign->classGroup->name }}</td>
                                                <td class="border px-2 text-sm">{{ $sign->position->name }}</td>
                                                <td class="border px-2 text-sm">{{ $sign->positionType }}</td>
                                                <td class="border px-2 text-sm flex">
                                                    <button
                                                        onclick="location.href='{{ route('show.image', $sign->id) }}'"
                                                        class="bg-blue-500 px-2 py-2 mx-0.5 rounded hover:bg-blue-300 text-white hover:text-black text-sm">
                                                        Show
                                                    </button>
                                                    <button
                                                        onclick="location.href='{{ route('edit.image', [$sign->id]) }}'"
                                                        class="bg-yellow-500 px-2 py-2 mx-0.5 rounded hover:bg-yellow-300 text-white hover:text-black text-sm">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('destroy.image', [$sign->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 px-2 py-2 mx-0.5 rounded hover:bg-red-300 text-white hover:text-black text-sm">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="flex py-3 m-3">{{ $signs->links() }}</div>
                            </div>
                        </div>
                        <button onclick="location.href='{{ route('create.image') }}'"
                            class="bg-blue-700 px-4 py-2 rounded hover:bg-blue-500 text-white hover:text-black">Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
