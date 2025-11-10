@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.DeleteAccount')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('client.partials.accountnav')
            </div>
            <div class="col-md-9">
                <div class="bg-white shadow-sm border p-4" style="height: 580px;">
                    <h4><i class="fas fa-gear me-2"></i>Privacy Settings</h4><hr>
                    <div class="mt-3 px-3 d-flex justify-content-between align-items-center">
                        <p class="m-0">Delete this account?</p>
                        <button type="button" class="btn btn-danger" 
                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Delete Account
                        </button>
                     </div><hr>
                </div>
            </div>  
        </div>
    </div>
@endsection