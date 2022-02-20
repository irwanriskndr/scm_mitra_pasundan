<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Siswa') }}
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
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',

                    },
                    {
                        data: 'status',
                        name: 'status',

                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%',

                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.requests.create') }}"
                    class=" bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Request Siswa
                </a>
            </div>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Status</th>
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
