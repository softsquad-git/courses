@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pages.static_pages.update', ['id' => $item->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Strona</label>
                        <input type="text" readonly class="form-control" value="{{ __('admin.static_pages.'.$item->name) }}">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="content">Treść</label>
                            <textarea id="content" name="content" class="editor">{{ $item->content ? $item->content : old('content') }}</textarea>
                            @error('content')
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
                        <a href="{{ route('admin.pages.static_pages.index') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
