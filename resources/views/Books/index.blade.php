<x-app-layout>
<section class="bg-white dark:bg-gray-900 ms-20aaaa">
  <div class="py-8 px-4 mx-auto  max-w-7xl  lg:pl-64">
      <div class="flex items-center justify-between mb-4">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Buku</h2>
          <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
              Tambah Buku
          </a>
      </div>
      
      @if(session('success'))
          <div class="mb-4 p-4 text-green-800 bg-green-50 border border-green-200 rounded-lg dark:bg-gray-800 dark:text-green-400 dark:border-green-900">
              {{ session('success') }}
          </div>
      @endif
      
      <div class="overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">Judul Buku</th>
                      <th scope="col" class="px-6 py-3">Penulis</th>
                      <th scope="col" class="px-6 py-3">Kategori</th>
                      <th scope="col" class="px-6 py-3">Tahun Terbit</th>
                      <th scope="col" class="px-6 py-3">Jumlah Stok</th>
                      <th scope="col" class="px-6 py-3">Deskripsi</th>
                      <th scope="col" class="px-6 py-3">Status</th>
                      <th scope="col" class="px-6 py-3">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($books as $book)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                          <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $book->judul_buku }}</td>
                          <td class="px-6 py-4">{{ $book->penulis }}</td>
                          <td class="px-6 py-4">{{ $book->kategori }}</td>
                          <td class="px-6 py-4">{{ $book->tahun_terbit }}</td>
                          <td class="px-6 py-4">{{ $book->jumlah_stok }}</td>
                          <td class="px-6 py-4">{{ $book->deskripsi }}</td>
                          
                          <td class="px-6 py-4">
                              <span class="px-2 py-1 font-semibold leading-tight {{ $book->status ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                  {{ $book->status ? 'Tersedia' : 'Tidak Tersedia' }}
                              </span>
                          </td>
                          <td class="px-6 py-4 text-right space-x-2">
                              <a href="{{ route('books.edit', $book->id) }}" class="text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                              <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-600 hover:underline dark:text-red-500" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</section>
</x-app-layout>
