<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Siswa') }}
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
                        width: '5%'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        width: '15%'
                    },
                    {
                        data: 'jurusan.nama',
                        name: 'jurusan.nama',
                        width: '15%'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%'
                    },
                ],
            });
        </script>

        {{-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div>
                            <x-jet-application-logo class="block h-12 w-auto" />
                        </div>

                        <div class="mt-8 text-sm">
                            Welcome to your Jetstream application!
                        </div>

                        <div class="mt-6 text-gray-500">
                            Laravel Jetstream provides a beautiful, robust starting point for your next Laravel
                            application. Laravel is designed
                            to help you build your application using a development environment that is simple, powerful,
                            and enjoyable. We believe
                            you should love expressing your creativity through programming, so we have spent time
                            carefully crafting the Laravel
                            ecosystem to be a breath of fresh air. We hope you love it.
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
            <div class="mb-10">
                <a href="{{ route('dashboard.siswa.create') }}"
                    class=" bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Tambah Siswa
                </a>
            </div>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Nomor HP</th>
                                <th>L/P</th>
                                <th>Status</th>
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
