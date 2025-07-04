<!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
  View Berkas
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
  
   <h1 class="text-center font-extrabold text-xl mb-6">
    View Berkas
   </h1>
   
   
  <main class="px-6">
    <div id="my-pdf"></div>
  <!-- Modal Logout View Berkas-->
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
  <iframe src="{{ asset('storage/' . $file->file_path) }}" width="100%" height="600px"></iframe>
<!-- Modal Print Berkas -->
<div class="modal" id="printModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Test</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Fitur ini belum tersedia.</p>
        <div class="w-full max-w-md flex justify-between px-20">
          <button class="btn btn-primary">OK</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus Berkas -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Hapus Berkas</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <p>Apakah Anda yakin ingin menghapus berkas ini?</p>
    <div class="w-full max-w-md flex justify-between px-20">
      <button class="btn btn-primary">Ya</button>
      <button class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
    </div>
      </div>
    </div>
  </div>
</div>
  </main>
 </body>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $("#")
</script>
</html>
