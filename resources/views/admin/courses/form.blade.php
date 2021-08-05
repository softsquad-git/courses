@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.course.update', ['id' => $item->id]) : route('admin.course.create') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="name">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}"
                                   placeholder="Nazwa">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="level">Poziom trudności</label>
                            <select name="level_id" id="level" class="form-control">
                                <option value="" selected>Wybierz poziom trudności</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" {{ $item->level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="level">Poziom język</label>
                            <select name="language_id" id="level" class="form-control">
                                <option value="" selected>Wybierz język</option>
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->id }}" {{ $item->language_id == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            @error('language_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="active">Aktywny</label>
                            <select name="is_active" id="active" class="form-control">
                                <option value="1" {{ $item->is_active == 1 ? 'selected' : '' }}>Tak</option>
                                <option value="0" {{ $item->is_active == 0 ? 'selected' : '' }}>Nie</option>
                            </select>
                            @error('language_id')
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
                        <a href="{{ route('admin.courses') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
