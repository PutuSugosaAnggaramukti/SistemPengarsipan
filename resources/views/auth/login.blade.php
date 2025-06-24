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
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-lg p-8 w-full max-w-md drop-shadow-md">
   <div class="flex justify-center mb-4">
    <img alt="" class="w-20 h-20" height="80" src="images/logo.png" width="80"/>
   </div>
   <h1 class="text-center font-bold text-xl mb-1">
    Sistem Informasi Pengarsipan
   </h1>
   <p class="text-center text-sm mb-8">
    Silahkan Login Untuk Melanjutkan
   </p>
   <form method="POST" action="{{ route('login') }}">
    @csrf
    <label class="block text-xs mb-1" for="username">Username</label>
    <input class="w-full border border-gray-300 rounded-md px-3 py-2 mb-6 text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-400" name="username"  id="username" placeholder="Username" type="text" required autofocus/>
    <label class="block text-xs mb-1" for="password">Password</label>
    <input class="w-full border border-gray-300 rounded-md px-3 py-2 mb-6 text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-400" name="password"  id="password" placeholder="Password" type="password" required/>
    <div class="flex justify-center mb-4">
     <button class="bg-sky-300 hover:bg-sky-400 text-blue-900 font-semibold rounded-lg px-8 py-2 flex items-center gap-2 shadow-md" style="box-shadow: 0 2px 6px rgba(0,0,0,0.15);" type="submit">
      <i class="fas fa-sign-in-alt">
      </i>
      <span>
       Login
      </span>
     </button>
    </div>
   </form>
   <div class="text-center">
    <a class="text-sm underline" href="#">
     Lupa Password?
    </a>
   </div>
  </div>
 </body>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $("#")
</script>
</html>
