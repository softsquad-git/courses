@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.discount_code.update', ['id' => $item->id]) : route('admin.discount_code.create') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="from">Ważny od</label>
                            <input type="datetime-local" class="form-control" id="from" name="start_time" value="{{ $item->start_time ? $item->start_time : old('start_time') }}"
                                   placeholder="Ważny od">
                            @error('start_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_time">Ważny do</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $item->end_time ? $item->end_time : old('end_time') }}"
                                   placeholder="Ważny do">
                            @error('end_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="percent_minus">Procentowa oniżka ceny</label>
                            <input type="number" class="form-control" id="percent_minus" name="percent_minus" value="{{ $item->percent_minus ? $item->percent_minus : old('percent_minus') }}">
                            @error('percent_minus')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.discount_codes') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
