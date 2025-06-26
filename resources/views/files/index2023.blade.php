<!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Sistem Informasi Pengarsipan
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="images/logo.png" rel="icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
  <script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "File anda akan terhapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
function confirmLogout(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Logout?',
        text: "Yakin ingin keluar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
} 
</script> 
 </head>
 <body class="bg-white text-black">
  <header class="flex items-center justify-between px-6 py-4">
   <div class="flex items-center space-x-3">
    <img alt="" class="w-12 h-12" height="48" src="images/logo.png" width="48"/>
    <div class="leading-tight">
     <p class="font-semibold text-sm">
      Sistem Informasi
     </p>
     <p class="font-semibold text-sm">
      Pengarsipan
     </p>
    </div>
   </div>
  <form id="logout-form" action="" method="POST" style="display: none;">
    @csrf
</form>
<a href="#" onclick="confirmLogout(event)"><button class="flex items-center space-x-2 bg-sky-300 hover:bg-sky-400 text-sky-700 rounded-full px-4 py-2 shadow-md text-sm font-medium" type="button">
    <i class="fas fa-sign-out-alt">
    </i>
    <span>
     Logout
    </span>
   </button></a>
  </header>
  <main class="px-6">
   <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <section class="px-6 pb-6 flex flex-wrap gap-3">
    <button class="flex items-center space-x-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full px-5 py-2 text-sm font-medium shadow-md" data-bs-toggle="modal" data-bs-target="#myModal" type="button">
     <i class="fas fa-upload">
     </i>
     <span>
      Upload Berkas
     </span>
    </button>
    <a href="/dashboard"><button class="flex items-center space-x-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full px-5 py-2 text-sm font-medium shadow-md " type="button">
    Kembali
   </button></a>
    </section>
   
    <!-- Modal Upload Berkas  -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h1>Upload PDF</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <div class="pt-8 px-6 pb-6">
          <h1>Maksimal file 200MB</h1>

 <form action="{{ route('files.store2023') }}" method="POST" enctype="multipart/form-data">
                           
   @csrf
    <label>Year:</label>
    <input type="number" name="year" min="2000" max="{{ date('Y') }}" required>

    <label>PDF Documents:</label>
    <input type="file" name="files[]" multiple accept="application/pdf">
    {{-- <button type="submit">Upload</button> --}}
    {{-- <script>
        Swal.fire({
            icon: 'warning',
            title: 'File too large!',
            text: '{{ $errors->first('file') }}'
        });
    </script> --}}

                            

                            <button type="submit" class="btn btn-md btn-primary me-3">Upload</button>

                        </form> 
         </div>
      </div>
    </div>
  </div>
</div>

    <form action="{{ route('files.index2023') }}" method="GET" class="mb-3 d-flex" role="search">
    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search files...">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
   </div>
   
    <table class="table">
                                <tr>
                                    <th class="text-center">Nama File</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Tanggal Upload</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            <tbody>
                              @forelse ($files as $file)
                                    <tr>
                                        <td class="text-center">{{ $file->original_name }}</td>
                                        <td class="text-center">{{ $file->year }}</td>
                                        <td class="text-center">{{ $file->created_at }}</td>
                                        <td class="text-center">
                                        <a href="{{ route('files.download2023', $file->id) }}" class="btn btn-sm btn-primary">Download</a>
                                        <a href="{{ route('files.show2023', $file->id) }}" target="_blank" class="btn btn-sm btn-secondary">Preview</a>
                                         <form id="delete-form-{{ $file->id }}" action="{{route('files.destroy2023', $file->id)}}" method="POST" style="display:inline">
                               @csrf
                               @method('DELETE')
                                          <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $file->id }})">Delete</button>
                                        </form>
                                        </td>
                                        
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                         {{ $files->links() }}
                        <br>
    {{-- <div class="flex flex-col flex-row-reverse"">
    <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
    </div><br> --}}
  </main>
 </body>
</html>

</html>