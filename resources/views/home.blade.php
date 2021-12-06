@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="border-bottom mb-0">Dashboard</h4>
                        </div>
                    </div>

                    <form action="" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Name</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Email</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Phone</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" placeholder="+880XXXXXXXXXX" disabled>
                            </div>
                        </div>
                        {{-- <div class="row mb-5">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-dark">Update Information</button>
                            </div>
                        </div> --}}
                    </form>

                    {{-- <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="border-bottom mb-0">Change Password</h4>
                        </div>
                    </div>

                    <form action="" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Current Password</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="old_password" class="form-control" placeholder="Current Password">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">New Password</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="New Password">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Confrim Password</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password_confirmed" class="form-control" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-dark">Update Password</button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
