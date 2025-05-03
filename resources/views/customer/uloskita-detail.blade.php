@extends('layouts.customer')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-5">
            <div class="ulos-frame-container">
                <div class="ulos-image-wrapper">
                    <div class="ulos-frame">
                        <img src="{{ asset('img/ulos/' . $ulosDetail['image']) }}" alt="{{ $ulosDetail['name'] }}" class="img-fluid ulos-main-image">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="ulos-content">
                <h1 class="ulos-title">{{ $ulosDetail['name'] }}</h1>
                
                <div class="accordion ulos-accordion mt-4" id="ulosAccordion">
                    <!-- Deskripsi -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDescription">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseDescription" aria-expanded="true" 
                                    aria-controls="collapseDescription">
                                <i class="bi bi-info-circle me-2"></i> Deskripsi
                            </button>
                        </h2>
                        <div id="collapseDescription" class="accordion-collapse collapse show" 
                             aria-labelledby="headingDescription" data-bs-parent="#ulosAccordion">
                            <div class="accordion-body">
                                {!! $ulosDetail['description'] !!}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kegunaan -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingUsage">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseUsage" aria-expanded="false" 
                                    aria-controls="collapseUsage">
                                <i class="bi bi-bookmark-star me-2"></i> Kegunaan
                            </button>
                        </h2>
                        <div id="collapseUsage" class="accordion-collapse collapse" 
                             aria-labelledby="headingUsage" data-bs-parent="#ulosAccordion">
                            <div class="accordion-body">
                                {!! $ulosDetail['kegunaan'] !!}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Proses Pembuatan -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingProcess">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseProcess" aria-expanded="false" 
                                    aria-controls="collapseProcess">
                                <i class="bi bi-tools me-2"></i> Proses Pembuatan
                            </button>
                        </h2>
                        <div id="collapseProcess" class="accordion-collapse collapse" 
                             aria-labelledby="headingProcess" data-bs-parent="#ulosAccordion">
                            <div class="accordion-body">
                                {!! $ulosDetail['pembuatan'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Enable all tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection

<style>
/* Ulos Detail Page Styling */

/* Image Frame Styling - Decorative version */
.ulos-frame-container {
    margin-bottom: 30px;
    padding: 15px;
    background-color: #f8f5ff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.ulos-image-wrapper {
    position: relative;
    padding: 15px;
    
    border-radius: 8px;
}

.ulos-frame {
    position: relative;
    padding: 12px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.2);
}

.ulos-frame::before {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    
    z-index: -1;
    border-radius: 8px;
}

.ulos-frame::after {
    content: '';
    position: absolute;
    top: -8px;
    left: -8px;
    right: -8px;
    bottom: -8px;
   
       
       
    );
    border-radius: 10px;
    z-index: -2;
    opacity: 0.3;
}

.ulos-main-image {
    display: block;
    width: 100%;
    border-radius: 2px;
    transition: transform 0.3s ease;
}

.ulos-frame:hover .ulos-main-image {
    transform: scale(1.02);
}

.ulos-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    border-left: 5px solid white;
    padding-left: 15px;
}

/* Content container */
.ulos-content {
    padding: 10px;
}

/* Accordion styling */
.ulos-accordion {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
}

.accordion-item {
    border: none;
    border-bottom: 1px solid #f0f0f0;
}

.accordion-item:last-child {
    border-bottom: none;
}

.accordion-button {
    padding: 18px 20px;
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
    background-color: #fff;
}

.accordion-button:not(.collapsed) {
    color: #fff;
    background: linear-gradient(135deg, #8062D6 0%, #6A5BE2 100%);
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(106, 91, 226, 0.1);
}

/* Change the accordion arrow color */
.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%236A5BE2'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-body {
    padding: 20px;
    line-height: 1.7;
    color: #555;
    background-color: #fafafa;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .ulos-title {
        font-size: 1.8rem;
        margin-top: 20px;
    }
}

@media (max-width: 767.98px) {
    .ulos-frame-container {
        padding: 10px;
    }
    
    .ulos-image-wrapper {
        padding: 10px;
    }
    
    .ulos-frame {
        padding: 8px;
    }
    
    .accordion-button {
        padding: 15px;
        font-size: 1rem;
    }
    
    .accordion-body {
        padding: 15px;
    }
}
</style>