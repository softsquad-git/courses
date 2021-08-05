@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.testimonial.update', ['id' => $item->id]) : route('admin.testimonial.create') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $item->author ? $item->author : old('author') }}"
                                   placeholder="Autor">
                            @error('author')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="content">Treść</label>
                            <textarea name="content" id="content" placeholder="Treść" class="form-control">{{ $item->content ? $item->content : old('content') }}</textarea>
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
                        <a href="{{ route('admin.testimonials') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
