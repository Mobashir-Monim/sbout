@extends('layouts.app')

@section('content')
    @foreach ($configs as $config)
        <div class="row">
            <div class="col-md-12">
                <div class="card" onclick="window.open('{{ route('config.edit', ['config' => $config->id]) }}', '_self')">
                    <div class="card-body">
                        <h5 class="border-bottom mb-0">{{ $config->display_name }}</h5>
                        <p class="text-muted text-right">{{ $config->name }}</p>
                        <p class="mb-0">{{ $config->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <button class="btn add-btn btn-dark d-flex" type="button" onclick="window.open('{{ route('config.create') }}', '_self')">
        <span class="material-icons-outlined" style="font-size: 2.2em">add</span>
    </button>
@endsection