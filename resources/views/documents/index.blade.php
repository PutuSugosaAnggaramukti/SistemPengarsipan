<!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Sistem Informasi Pengarsipan
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
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
   <button class="flex items-center space-x-2 bg-sky-300 hover:bg-sky-400 text-sky-700 rounded-full px-4 py-2 shadow-md text-sm font-medium" data-bs-toggle="modal" data-bs-target="#logoutModal" type="button">
    <i class="fas fa-sign-out-alt">
    </i>
    <span>
     Logout
    </span>
   </button>
  </header>
  <main class="px-6">
   <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <button class="flex items-center space-x-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full px-5 py-2 text-sm font-medium shadow-md" data-bs-toggle="modal" data-bs-target="#myModal" type="button">
     <i class="fas fa-upload">
     </i>
     <span>
      Upload Berkas
     </span>
    </button>
    <!-- Modal Logout Daftar Berkas-->
<div class="modal" id="logoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <h1 class="font-bold text-black text-xl mb-10">Yakin ingin keluar?</h1>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Ya</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal Upload Berkas  -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <div class="pt-8 px-6 pb-6">
          <h1>Upload PDF</h1>

<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Title" required><br><br>
    <input type="file" name="pdf" accept="application/pdf" required><br><br>
    <button class="btn btn-sm btn-primary" type="submit">Upload</button>
</form>
         </div>
      </div>
    </div>
  </div>
</div>
    <form class="relative w-full max-w-xs">
     <input class="w-full rounded-full border border-gray-300 py-2 pl-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Search.." type="search"/>
     <button aria-label="Search" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700" type="submit">
      <i class="fas fa-search">
      </i>
     </button>
    </form>
   </div>
   
    <table class="table">
                            
                                <tr>
                                   
                                    <th class="text-center">Nama File</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           
                            <tbody>
                              @foreach($documents as $doc)
                                    <tr>
                                        
                                        <td class="text-center">{{$doc->title}}</td>
                                        <td class="text-center">
                                        <a href="" class="btn btn-sm btn-primary">Download</a>
                                        <a href="{{asset('storage/' . $doc->file_path)}}" target="_blank" class="btn btn-sm btn-secondary">Preview</a>
                                         <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
        </form>
                                        </td>
                                    </tr>
                               @endforeach
                                    
                            
                            </tbody>
                        </table>
                     
                        <br>
    <div class="flex flex-col flex-row-reverse"">
    <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
    </div><br>
  </main>
 </body>
</html>

</html>