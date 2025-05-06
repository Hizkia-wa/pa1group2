<!DOCTYPE html> 
<html lang="id"> 
<head>     
    <meta charset="UTF-8">     
    <title>Admin - Gita Ulos</title>     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    {{-- Bootstrap CDN --}}     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">     
    {{-- Custom CSS --}}     
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">          
    <style>         
        /* Tambahkan ini untuk latar belakang putih */         
        body {             
            background-color: #ffffff; /* Latar belakang putih */             
            min-height: 100vh;             
            display: flex;             
            flex-direction: column;         
        }                  
        
        /* Style untuk footer dengan background hitam */         
        .footer {             
            background-color: #000000; /* Latar belakang hitam */            
            padding: 1rem 0;             
            margin-top: auto;             
            border-top: 1px solid #333333;
            color: #ffffff; 
            width:140%;
            margin-left: -100px;
        }                  
        
        .footer p {             
            margin-bottom: 0;         
        }                  
        
        /* Menyesuaikan padding konten utama */         
        .main-content {             
            flex: 1;         
        }     
    </style> 
</head> 
<body>     
    <div class="container-fluid d-flex flex-column min-vh-100">         
        <div class="row flex-grow-1">             
            {{-- Sidebar --}}             
            @include('components.sidebar')                          
            
            {{-- Konten utama --}}             
            <div class="col-md-9 py-4 main-content">                 
                @yield('content')             
            </div>         
        </div>                  
        
        {{-- Footer dengan background hitam --}}         
        <footer class="footer">             
            <div class="container-fluid">                 
                <div class="row">                     
                    <div class="col-md-12 text-center">                         
                        <p>&copy; {{ date('Y') }} Gita Ulos. Hak Cipta Dilindungi.</p>                     
                    </div>                 
                </div>             
            </div>         
        </footer>     
    </div>      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>