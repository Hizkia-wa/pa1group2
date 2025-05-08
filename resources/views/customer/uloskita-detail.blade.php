@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5">
            <div class="ulos-card">
                <div class="ulos-image-container">
                    <img src="{{ asset('img/ulos/' . $ulosDetail['image']) }}" alt="{{ $ulosDetail['name'] }}" class="img-fluid ulos-image">
                </div>
                <div class="ulos-card-badge">
                    <i class="bi bi-award"></i> Kain Tradisional
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="ulos-info-container">
                <h1 class="ulos-title">{{ $ulosDetail['name'] }}</h1>
                
                <div class="ulos-tabs mt-4">
                    <ul class="nav nav-tabs" id="ulosTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" 
                                    data-bs-target="#description" type="button" role="tab" 
                                    aria-controls="description" aria-selected="true">
                                <i class="bi bi-info-circle me-2"></i> Deskripsi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="usage-tab" data-bs-toggle="tab" 
                                    data-bs-target="#usage" type="button" role="tab" 
                                    aria-controls="usage" aria-selected="false">
                                <i class="bi bi-bookmark-star me-2"></i> Kegunaan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="process-tab" data-bs-toggle="tab" 
                                    data-bs-target="#process" type="button" role="tab" 
                                    aria-controls="process" aria-selected="false">
                                <i class="bi bi-tools me-2"></i> Proses Pembuatan
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="ulosTabsContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="ulos-content-box">
                                {!! $ulosDetail['description'] !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                            <div class="ulos-content-box">
                                {!! $ulosDetail['kegunaan'] !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="process" role="tabpanel" aria-labelledby="process-tab">
                            <div class="ulos-content-box">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Enable tabs 
        var tabElements = document.querySelectorAll('#ulosTabs button')
        tabElements.forEach(function(tabElement) {
            tabElement.addEventListener('click', function(event) {
                event.preventDefault();
                var tab = new bootstrap.Tab(this);
                tab.show();
            })
        });
    });
</script>
@endsection

<style>
/* Improved Ulos Detail Page Styling */

/* Card for Ulos Image */
.ulos-card {
    position: relative;
    border-radius: 16px;
    background-color: #fff;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.ulos-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.ulos-image-container {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #f0f0f0;
}

.ulos-image {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.ulos-card-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    color: #495057;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: 30px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

/* Ulos Info Container */
.ulos-info-container {
    padding: 20px;
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.ulos-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #212529;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 15px;
}

.ulos-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #6c757d, #adb5bd);
    border-radius: 2px;
}

/* Tabs Styling */
.ulos-tabs .nav-tabs {
    border: none;
    margin-bottom: 15px;
}

.ulos-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 30px;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.ulos-tabs .nav-link:hover {
    background-color: #f8f9fa;
    color: #495057;
}

.ulos-tabs .nav-link.active {
    background-color: #f1f3f5;
    color: #212529;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.ulos-content-box {
    background-color: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
    line-height: 1.8;
    color: #495057;
    margin-top: 10px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .ulos-title {
        font-size: 2rem;
        margin-top: 10px;
    }
    
    .ulos-tabs .nav-link {
        padding: 10px 15px;
        font-size: 0.9rem;
    }
}

@media (max-width: 767.98px) {
    .ulos-card {
        margin-bottom: 20px;
    }
    
    .ulos-image-container {
        padding: 15px;
    }
    
    .ulos-title {
        font-size: 1.8rem;
    }
    
    .ulos-tabs .nav {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 5px;
    }
    
    .ulos-tabs .nav-link {
        white-space: nowrap;
        padding: 8px 12px;
        font-size: 0.85rem;
    }
    
    .ulos-content-box {
        padding: 20px;
    }
}

@media (max-width: 575.98px) {
    .ulos-tabs .nav {
        -webkit-overflow-scrolling: touch;
    }
    
    .ulos-tabs .nav::-webkit-scrollbar {
        display: none;
    }
    
    .ulos-card-badge {
        font-size: 0.75rem;
        padding: 6px 10px;
    }
}
</style>