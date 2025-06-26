<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet"/>
    <style>
        body {font-family: 'Inter', sans-serif;}
    </style>
    <script>
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
    <title>Sistem Pengarsipan</title>
</head>
<body class="bg-white text-black">
    <header class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-3">
            <img alt="" class="w-12 h-12" height="48" src="{{asset("")}}images/logo.png" width="48"/>
            <div class="leading-tight">
                <p class="font-semibold text-sm">Sistem Informasi</p>
                <p class="font-semibold text-sm">Pengarsipan</p>
            </div>
        </div>
       <a href="#" onclick="confirmLogout(event)"><button class="flex items-center space-x-2 bg-sky-300 hover:bg-sky-400 text-sky-700 rounded-full px-4 py-2 shadow-md text-sm font-medium" type="button">
    <i class="fas fa-sign-out-alt">
    </i>
    <span>
     Logout
    </span>
   </button></a>
    </header>

    <main class="mx-4">
        <div class="mb-20">
            <div class="text-sm text-gray-600">
               <div class="pb-3 flex flex-row items-center">
        <label for="">Search : </label>
        <input type="text" class="w-26 rounded-lg h-10 border-2 ml-2 p-3">
    </div>
    <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
        <a href="/files" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2019</b>
                </div>
            </div>
        </a>
        <a href="/files2020" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2020</b>
                </div>
            </div>
        </a>
        <a href="/files2021" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2021</b>
                </div>
            </div>
        </a>
        <a href="/files2022" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2022</b>
                </div>
            </div>
        </a>
        <a href="/files2023" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2023</b>
                </div>
            </div>
        </a>
        <a href="/files2024" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2024</b>
                </div>
            </div>
        </a>
        <a href="/files2025" class="rounded-lg">
            <div class="bg-[#0012cf] rounded-lg p-4 hover:bg-blue-500">
                <div class="flex flex-column items-center">
                    <i class="fa fa-book fa-2x text-[white]"></i>
                    <b class="text-white font-bold">2025</b>
                </div>
            </div>
        </a>
    </div>
            </div>
        </div>
   
    </main>
</body>
</html>