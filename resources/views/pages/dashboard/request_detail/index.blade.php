<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Request Siswa') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false,

                    },
                    {
                        data: 'siswa.nama',
                        name: 'siswa.nama',
                    },

                    {
                        data: 'siswa.gender',
                        name: 'siswa.gender',
                        width: '5%',

                    },
                    {
                        data: 'siswa.phone_number',
                        name: 'siswa.phone_number',
                        width: '25%',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '5%',

                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.requesting.detail.create', $requesting->id) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Tambah Siswa
                </a>
            </div>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Siswa</th>
                                {{-- <th>Jurusan</th> --}}
                                <th>Gender</th>
                                <th>Nomor HP</th>
                                {{-- <th>Nomor HP</th> --}}
                                {{-- <th>L/P</th> --}}
                                {{-- <th>Status</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
