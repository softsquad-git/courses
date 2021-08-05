@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.home.information.update', ['id' => $item->id]) : route('admin.home.information.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $item->title ? $item->title : old('title') }}"
                                   placeholder="Tytuł">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="icon">Ikona</label>
                            <input type="file" class="form-control" id="icon" name="icon" placeholder="Ikona">
                            @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-form-label">Treść</label>
                        <textarea class="form-control" name="content" id="content">{{ $item->content ? $item->content : old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.home.information.index') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
