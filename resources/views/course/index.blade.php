@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md"></div>
        <div class="col-md-8">
            <form action="{{ route('course.index') }}" method="GET">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select class="custom-select" name="type">
                            {!! $list !!}
                        </select>
                    </div>
                    <input type="text" class="form-control border-top border-left border-right" name="name" placeholder="Course" value="{{ is_null(request()->name) ? "" : request()->name }}">
                    <div class="input-group-append">
                        <button class="btn btn-dark">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($courses as $course)
            <div class="col-md-4 mb-3 hoverable-card-container">
                <div class="card" onclick="window.open('{{ route('course.show', ['course' => $course->id]) }}', '_self')">
                    <div class="card-img-top course-thumbnail-3" style="background-image: url('{{ is_null($course->thumbnail) ? '/img/placeholder_book.jpg' : Storage::disk(config('app.storage'))->url("$course->thumbnail") }}')"></div>
                    <div class="card-body pb-2 course-card d-flex flex-column">
                        <h5>{{ $course->name }}</h5>
                        <p class="course-card-short">
                            {!! $course->short !!}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-end">
                            <div>
                                <span class="d-flex align-items-center">
                                    <span class="material-icons-round text-secondary mr-2">apartment</span>
                                    <span>{{ $course->provider_abbreviation }}</span>
                                </span>
                                <span class="d-flex align-items-center">
                                    <span class="material-icons-round text-secondary mr-2">sell</span>
                                    @if ($course->price != 0)
                                        {{ $course->price }} {{ $course->currency }}
                                    @else
                                        Free
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('course.show', ['course' => $course->id]) }}" class="material-icon-link material-icons-round">visibility</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-md-12 text-center mb-5">
            {{ $courses->links() }}
        </div>
    </div>
@endsection