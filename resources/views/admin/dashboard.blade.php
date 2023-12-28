@extends('layouts.app')

@section('content')
    

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang di Dashboard Admin Telkom Indonesia</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Jumlah Data Survey</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h5>Total: {{ $surveyCount }}</h5>
                        </div>
                    </div>
                </div>
            
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Jumlah User</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h5>Total: {{ $userCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Arif 2023</div>
                <div>
                    
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection