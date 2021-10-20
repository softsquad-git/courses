@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.course.level.update', ['id' => $item->id]) : route('admin.course.level.create') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}"
                                   placeholder="Nazwa">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="desc">Opis</label>
                            <input type="text" class="form-control" id="desc" name="description" value="{{ $item->description ? $item->description : old('description') }}"
                                   placeholder="Opis">
                            @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-12">
                            <label for="is_default"><input type="checkbox" name="is_default" id="is_default" value="0"> Domyślny poziom</label>
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="position">Pozycja</label>
                            <input type="number" class="form-control" name="position" value="{{ $item->position ? $item->position : old('position') }}">
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.languages') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
