@extends('layouts.app')

@section('links')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('course-category.create') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="border-bottom" contenteditable="true" id="category-name" onfocusout="setCourseCategoryName()" onkeyup="setCourseCategoryName()">Course Category Name</h4>
                        <input type="text" name="name" id="category-name-inp" class="hidden">

                        <div class="row">
                            <div class="col-md-12" id="settings-cont">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('course-category.scripts.create')
@endsection