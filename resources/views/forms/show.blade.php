@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4">{{ $title }}</h4>
    <div class="card mb-4">
        <div class="card-body">
            @foreach ($form as $input)
                <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-message">{{ $input['label'] }}</label>
                    <div class="col-sm-10">
                    @switch($input['type'])
                        @case('file')
                            <input type="file" name="{{ $input['name'] }}" class="form-control" accept="{{ $input['accept'] }}" />
                            @break
                        @case('textarea')
                            <textarea name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}">{{ isset($input['value']) ? $input['value'] : old($input['name']) }}</textarea>
                            @break
                        @case('password')
                        <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}" />
                            @break
                        @default
                        <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['placeholder'] }}" value="{{ isset($input['value']) ? $input['value'] : old($input['name']) }}" />
                    @endswitch
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <a href="{{ url()->previous() }}" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection