<x-app-layout>
    <div class="container mx-auto pt-10 lg:pl-64">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Daftar Peminjaman Buku</h1>

        <!-- Form Filter Status -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.borrowedBooks') }}">
                <div class="flex justify-center space-x-6">
                    <button type="submit" name="status" value="dipinjam" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 {{ $status == 'dipinjam' ? 'bg-blue-600' : '' }}">
                        Buku yang Dipinjam
                    </button>
                    <button type="submit" name="status" value="dikembalikan" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 {{ $status == 'dikembalikan' ? 'bg-blue-600' : '' }}">
                        Buku yang Dikembalikan
                    </button>
                </div>
            </form>
        </div>

        @if($borrowedBooks->isEmpty())
            <p class="text-gray-700 text-center">Tidak ada buku dengan status '{{ $status }}'.</p>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul Buku</th>
                            <th scope="col" class="px-6 py-3">Peminjam</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pinjam</th>
                            <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowedBooks as $borrow)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $borrow->book->judul_buku }}
                                </td>
                                <td class="px-6 py-4">{{ $borrow->user->name }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrow->tanggal_pinjam)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrow->tanggal_kembali)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-lg {{ $borrow->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($borrow->status === 'dipinjam')
                                        <!-- Form Perpanjangan Peminjaman dan Pengembalian -->
                                        <div class="flex space-x-3 justify-center">
                                            <!-- Form Perpanjangan Peminjaman -->
                                            <form action="{{ route('admin.extendLoan', $borrow->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <div class="flex items-center space-x-2">
                                                    <input type="date" name="tanggal_kembali" required
                                                        class="block w-36 text-sm text-gray-900 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                                    <button type="submit" onclick="return confirm('Yakin Ingin Perpanjang?')"
                                                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                        Perpanjang
                                                    </button>
                                                </div>
                                            </form>
                                            
                                            <!-- Form Pengembalian Buku -->
                                            <form action="{{ route('admin.returnBookForAdmin', $borrow->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="return confirm('Yakin Ingin Dikembalikan')"class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500 italic">Buku Sudah Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                     <!-- Pagination -->
                     <div class="mt-4">
                        {{ $borrowedBooks->appends(['status' => $status])->links('pagination::tailwind') }}
                    </div>
            </div>
        @endif
    </div>
</x-app-layout>
