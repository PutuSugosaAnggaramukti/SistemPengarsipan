<!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   2020
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
  font-family: Arial, sans-serif;
  padding: 20px;
}

.form-container {
  max-width: 400px;
  margin: auto;
}

label {
  display: block;
  margin-bottom: 6px;
  font-weight: bold;
}

input[type="text"], input[type="file"] {
  width: 100%;
  padding: 8px 12px;
  margin-bottom: 15px;
  border: 2px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
  transition: border-color 0.3s;
}

input[type="text"]:focus, input[type="file"]:focus {
  border-color: #3498db;
  outline: none;
}

button {
  background-color: #3498db;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #2980b9;
}

.note {
  margin-bottom: 20px;
  color: #555;
}
  </style>
  <script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
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
document.addEventListener("DOMContentLoaded", function() {
  const yearInput = document.getElementById("year");
  yearInput.value = 2020;
});
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
    <form action="{{ route('files.restoreAll2020') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            Restore
        </button>
    </form>
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
         <div class="note">Maksimal file 200MB</div>

<form action="{{ route('files.store2020') }}" method="POST" enctype="multipart/form-data">

@csrf
  <label for="year">Year:</label>
   <input type="text" id="year" name="year" min="2000" max="{{ date('Y') }}" placeholder="Enter year" value="2020" readonly style="background-color:#eee;">

  <label for="pdf">Choose PDF files:</label>
  <input type="file" name="files[]" multiple accept="application/pdf">

  <button class="btn btn-sm btn-primary" type="submit">Upload</button>
</form>
</div>
      </div>
    </div>
  </div>
</div>

    <form action="{{ route('files.index2020') }}" method="GET" class="mb-3 d-flex" role="search">
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
                                        <td class="text-center">{{$file->original_name}}</td>
                                        <td class="text-center">{{$file->year}}</td>
                                        <td class="text-center">{{$file->created_at->format('d-m-Y')}}</td>
                                        <td class="text-center">
                                        <a href="{{ route('files.download2020', $file) }}" class="btn btn-sm btn-primary">Download</a>
                                        <a href="{{ route('files.show2020', $file->id)}}" target="_blank" class="btn btn-sm btn-secondary">Preview</a>
                                         <form id="delete-form-{{ $file->id }}" action="{{route('files.destroy2020', $file->id)}}" method="POST" style="display:inline">
                               @csrf
                               @method('DELETE')
                                          <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $file->id }})">Delete</button>
                                        </form>
                                        </td>
                                        
                                    </tr>
                              @empty
                                <tr>
                                    <td colspan="4" class="text-center">No files found.</td>
                                </tr>
                              @endforelse
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