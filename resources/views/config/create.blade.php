@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('config.store') }}" method="POST" id="config-create">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4 class="border-bottom">Create Config</h4>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Display Name</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="display_name" class="form-control" placeholder="Display Name">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Name</h5>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Description</h5>
                            </div>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="m-0">Variable</h5>
                            </div>
                            <div class="col-md-9">
                                <div id="variable-editor" style="height: 400px">{{ json_encode(["" => ["" => ""], "description" => ["" => ""]], JSON_PRETTY_PRINT) }}</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-dark" onclick="setVariable()">Save</button>
                            </div>
                        </div>

                        <input type="text" name="variable" id="variable" class="hidden">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.13/ace.js"></script>
    <script>
        let varEditor = ace.edit("variable-editor");
        varEditor.setTheme("ace/theme/dracula");
        varEditor.session.setMode('ace/mode/json');
        // editor.setValue(JSON.stringify(jsonDoc, null, '\t'));

        let setVariable = () => {
            document.getElementById('variable').value = JSON.stringify(JSON.parse(varEditor.getValue()));
            document.getElementById('config-create').submit();
        }
    </script>
@endsection