@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/table/ui/trumbowyg.table.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/trumbowyg@2.25.1/dist/ui/trumbowyg.min.css,npm/trumbowyg@2.25.1/dist/plugins/table/ui/trumbowyg.table.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4 class="border-bottom">Add Course</h4>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Course Name</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Course Name">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Registration Fee</h5>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="number" name="price" min="0" class="form-control" placeholder="Registration Fee">
                                    </div>
    
                                    <div class="col-4">
                                        <select name="currency" class="form-control">
                                            <option value="BDT">BDT</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Provider</h5>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" name="provider" class="form-control" placeholder="Department of Computer Science and Engineering">
                                    </div>
    
                                    <div class="col-4">
                                        <input type="text" name="provider_abbreviation" class="form-control" placeholder="CSE">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Offered to</h5>
                            </div>
                            <div class="col-md-9">
                                <select name="offered_to" class="form-control">
                                    <option value="0">BracU Students only</option>
                                    <option value="1">External Students only</option>
                                    <option value="2">BracU and external Students</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Short Description</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="short" class="form-control" placeholder="One Line Description">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Course Image</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="file" name="thumbnail" class="form-control" placeholder="One Line Description">
                            </div>
                        </div>
    
                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Course Description</h5>
                            </div>
                            <div class="col-md-9">
                                <div id="description" placeholder="Course Description"></div>
                            </div>
                        </div>
    
                        {{-- <div class="row mb-3">
                            <div class="col-md-12">
                                <h4 class="border-bottom">Additional Details</h4>
                            </div>
                        </div> --}}
    
                        {{-- <div class="row mb-3">
                            <div class="col-md-12" id="add-details">
    
                                <div class="row mb-3" id="ad-cont-0">
                                    <div class="col-md-3 my-auto">
                                        <h5 class="m-0" contenteditable="true" id="ad-a-0">Attribute Name</h5>
                                        <div class="btn-group btn-group-toggle my-2" data-toggle="buttons">
                                            <label class="btn btn-sm btn-secondary active">
                                                <input type="radio" name="ad-t-0" checked onchange="setContentType('ad-c-0', 'rich_text')"> <span class="material-icons-outlined" style="font-size: 1em">vertical_split</span>
                                            </label>
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" name="ad-t-0" onchange="setContentType('ad-c-0', 'plain_text')"> <span class="material-icons-outlined" style="font-size: 1em">text_snippet</span>
                                            </label>
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" name="ad-t-0" onchange="setContentType('ad-c-0', 'short_text')"> <span class="material-icons-outlined" style="font-size: 1em">short_text</span>
                                            </label>
                                        </div>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="deleteAddDetail('ad-cont-0')"><span class="material-icons-outlined" style="font-size: 1em">delete</span></button>
                                    </div>
    
                                    <div class="col-md-9" id="ad-c-0">
                                        <div class="c-ad-c"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
    
                        <div class="row">
                            <div class="col-md-12 text-right">
                                {{-- <button class="btn btn-secondary" type="button" onclick="addAddDetail()">Add Detail</button> --}}
                                <button class="btn btn-dark" type="submit">Create Course</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/trumbowyg.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/plugins/table/trumbowyg.table.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/colors/trumbowyg.colors.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/trumbowyg@2/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
    @include('course.scripts.create')
@endsection