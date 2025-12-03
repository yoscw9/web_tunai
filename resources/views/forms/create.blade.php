@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4">{{ $title }}</h4>
    <div class="card mb-4">
        <div class="card-body">

            @include('components.alert')
            
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data" x-data="{is_submit: false}" @submit="is_submit = !is_submit">
                @csrf
                @foreach ($form as $input)
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-center" for="basic-icon-default-message">{{ $input['label'] }}</label>
                        <div class="col-sm-10">
                        @switch($input['type'])
                            @case('select')
                                <select name="{{ $input['name'] }}" class="form-control">
                                    @foreach ($input['options'] as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            @break
                            @case('file')
                                <input type="file" name="{{ $input['name'] }}" class="form-control" accept="{{ $input['accept'] }}" />
                            @break
                            @case('textarea')
                                <textarea name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}">{{ old($input['name']) }}</textarea>
                            @break
                            @case('password')
                            <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}" />
                            @break
                            @default
                            <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}" value="{{ old($input['name']) }}" autocomplete="off" />
                        @endswitch
                        </div>
                    </div>
                @endforeach
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary" x-bind:disabled="is_submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection