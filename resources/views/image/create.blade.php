<x-app-layout>
    <x-slot name="tab_title">{{ $tab_title }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat TTE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('store.image') }}">
                        @csrf

                        <div class="grid grid-cols-2 gap-5">
                            <div class="w-full">
                                <input onblur="this.value=removeSpaces(this.value);" type="text" name="nip"
                                    class="bg-gray-100 rounded text-sm mb-2 w-full mx-4" placeholder="NIP"
                                    value="{{ old('nip') }}" autocomplete="off">

                                <input type="text" name="fullname" class="bg-gray-100 rounded text-sm mb-2 w-full mx-4"
                                    placeholder="Nama Lengkap" value="{{ old('fullname') }}" autocomplete="off">

                                <div class="mx-4">
                                    <input type="submit" value="Kirim"
                                        class="bg-blue-500 hover:bg-blue-700 px-4 rounded py-2 cursor-pointer text-white text-sm">
                                    <input type="reset" value="Reset"
                                        class="bg-yellow-500 hover:bg-yellow-700 px-4 rounded py-2 cursor-pointer text-white text-sm">
                                    <input type="button" value="Cancel"
                                        onclick="location.href='{{ route('index.image') }}'"
                                        class="bg-red-500 hover:bg-red-700 px-4 rounded py-2 cursor-pointer text-white text-sm">
                                    @if ($errors->any())
                                        <div class="text-red-500 text-sm mt-4">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="w-full">
                                <select name="classGroup" class="rounded text-sm mb-2 w-full mx-4 sm:overflow-y-auto">
                                    <option value="">Pilih Pangkat</option>
                                    @foreach ($classGroups as $classGroup)
                                        <option value="{{ $classGroup->id }}">{{ $classGroup->name }}</option>
                                    @endforeach
                                </select>

                                <select name="position" class="rounded text-sm mb-2 w-full mx-4 sm:overflow-y-auto">
                                    <option value="">Pilih Posisi</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>

                                <select name="posName" class="rounded text-sm mb-2 w-full mx-4 sm:overflow-y-auto">
                                    <option value="">Pilih Nama Posisi</option>
                                    @foreach ($posNames as $posName)
                                        <option value="{{ $posName }}">{{ $posName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function removeSpaces(string) {
                return string.split(' ').join('');
            }

        </script>
    @endpush
</x-app-layout>
