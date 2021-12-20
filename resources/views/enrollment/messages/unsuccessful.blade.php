@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-h">
        <div class="col-md-8 my-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-5 mb-4">
                        <div class="col-md-12 text-center">
                            <h4 class="mb-2">Could not complete enrollment in <strong>{{ $course->name }}</strong></h4>
                            <h5 class="mb-3">{{ $message }}</h5>
                            <span class="material-icons-round d-none d-md-inline-block" style="font-size: 8rem">sentiment_very_dissatisfied</span>
                            <span class="material-icons-round d-none d-md-inline-block" style="font-size: 8rem">sentiment_very_dissatisfied</span>
                            <span class="material-icons-round d-none d-md-inline-block" style="font-size: 8rem">sentiment_very_dissatisfied</span>

                            <span class="material-icons-round d-md-none" style="font-size: 4rem">sentiment_very_dissatisfied</span>
                            <span class="material-icons-round d-md-none" style="font-size: 4rem">sentiment_very_dissatisfied</span>
                            <span class="material-icons-round d-md-none" style="font-size: 4rem">sentiment_very_dissatisfied</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection