@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-img-top course-thumbnail-12" style="background-image: url('{{ is_null($course->thumbnail) ? '/img/placeholder_book.jpg' : Storage::disk(config('app.storage'))->url("$course->thumbnail") }}')"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 order-md-1 order-sm-12 px-5 pt-5">
                            {!! $course->description !!}
                        </div>
                        <div class="col-md-3 pt-5 order-md-12 order-sm-1">
                            <a href="{{ !is_null(auth()->user()) ? route('enrollment.register', ['course' => $course->id]) :route('enrollment.registration', ['course' => $course->id]) }}" class="btn btn-dark btn-lg w-100 mb-3">Enroll Now</a>
                            <div class="d-flex my-4 align-items-center">
                                <span class="material-icons-round text-secondary mr-2">sell</span>
                                @if ($course->price != 0)
                                    {{ $course->price }} {{ $course->currency }}
                                @else
                                    Free
                                @endif
                            </div>
                            <div class="d-flex my-4 align-items-center line-cap-2">
                                <span class="material-icons-round text-secondary mr-2">apartment</span>
                                {{ $course->provider }} ({{ $course->provider_abbreviation }})
                            </div>
                            <div class="d-flex my-4 align-items-center">
                                <span class="material-icons-round text-secondary mr-2">groups</span>
                                @if ($course->offered_to == 0)
                                    BracU Students Only
                                @elseif ($course->offered_to == 1)
                                    External Participants Only
                                @else
                                    BracU and non-BracU Students
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection