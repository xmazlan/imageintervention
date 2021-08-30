<x-app-layout>
    <x-slot name="tab_title">{!! $tab_title !!}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-700 px-4 py-3 shadow-md my-3">
            <div class="flex">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                    <div class="mb-12 px-4">
                        <div class="text-center bg-green-300 px-2 py-2 rounded mb-1 grid grid-cols-3">
                            @if ($previous)
                                <button onclick="location.href='{{ URL::to('dashboard/image/' . $previous) }}'"
                                    class="bg-red-500 hover:bg-red-400 rounded text-white hover:text-black">Previous</a>
                                @else
                                    <button onclick="location.href='{{ route('index.image') }}'"
                                        class="bg-blue-700 hover:bg-blue-500 rounded text-white hover:text-black">Back
                                        to list
                                    </button>
                            @endif
                            <button class="text-lg">Data</button>
                            @if ($next)
                                <button onclick="location.href='{{ URL::to('dashboard/image/' . $next) }}'"
                                    class="bg-red-500 hover:bg-red-400 rounded text-white hover:text-black">Next</button>
                            @else
                                <button onclick="location.href='{{ route('index.image') }}'"
                                    class="bg-blue-700 hover:bg-blue-500 rounded text-white hover:text-black">Back
                                    to list
                                </button>
                            @endif
                        </div>
                        <div class="relative min-w-0 break-words bg-gray-200 mb-6 shadow-lg rounded">
                            <table class="ml-5">
                                <tbody>
                                    <tr>
                                        <td>NIP</td>
                                        <td class="px-3">&mdash;</td>
                                        <td>{{ $sign->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td class="px-3">&mdash;</td>
                                        <td>{{ $sign->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat</td>
                                        <td class="px-3">&mdash;</td>
                                        <td>{{ $sign->classGroup->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Posisi</td>
                                        <td class="px-3">&mdash;</td>
                                        <td>{{ $sign->position->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Garis</td>
                                        <td class="px-3">&mdash;</td>
                                        <td class="flex">
                                            <form action="{{ route('underline.image', [$sign->id, 'add']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-500 px-2 mx-0.5 rounded hover:bg-blue-300 text-white hover:text-black text-sm">
                                                    Tambah
                                                </button>
                                            </form>
                                            <form action="{{ route('underline.image', [$sign->id, 'subs']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 px-2 mx-0.5 rounded hover:bg-red-300 text-white hover:text-black text-sm">
                                                    Kurangi
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button onclick="location.href='{{ route('index.image') }}'"
                            class="bg-blue-700 px-4 py-2 rounded mt-5 hover:bg-blue-500 text-white hover:text-black">Back
                            to list
                        </button>
                    </div>
                    <div class="mb-12 px-4">
                        <div class="text-center bg-green-300 px-2 py-2 rounded mb-1">
                            Hasil
                        </div>
                        <div class="relative min-w-0 break-words bg-gray-200 mb-6 shadow-lg rounded">
                            <div class="block overflow-x-auto">
                                <!-- Projects table -->
                                <div class="items-center bg-transparent border-collapse px-4 py-3">
                                    <a href="{{ $filename }}" download><img src="{{ $filename }}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
