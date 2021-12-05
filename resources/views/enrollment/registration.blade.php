@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-h">
        <div class="col-md-8 my-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('enrollment.register', ['course' => $course->id]) }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4 class="border-bottom">Account Registration</h4>
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Name</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Full Name">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Email</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Phone</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="tel" name="phone" class="form-control" placeholder="+880XXXXXXXXXX">
                            </div>
                        </div>
    
                        <div class="row mb-5">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Enroll in</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="course_name" class="form-control mb-3" value="{{ $course->name }}" disabled>
    
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" name="" class="form-control" value="{{ $course->price }}" disabled>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="" class="form-control" value="{{ $course->currency }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-end">
                                <a href="{{ route('login') }}" class="btn btn-link">Already have an account?</a>
                                <button class="btn btn-dark">Register and proceed to pay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection