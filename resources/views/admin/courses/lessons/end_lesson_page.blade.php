@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST"
                      action="{{ $item->id ? route('admin.course.lesson.end_lesson', ['lessonId' => $lessonId]) : route('admin.course.lesson.end_lesson', ['lessonId' => $lessonId]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ $lessonId }}">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="header" class="form-label">Nagłówek</label>
                            <input type="text" class="form-control" id="header" name="title" value="{{ $item->title ? $item->title : old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="title" class="form-label">Tytuł</label>
                            <input type="text" id="title" class="form-control" name="sub_title" value="{{ $item->sub_title ? $item->sub_title : old('sub_title') }}">
                            @error('sub_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="sub_title" class="form-label">Podtytuł</label>
                            <input type="text" id="sub_title" class="form-control" name="description" value="{{ $item->description ? $item->description : old('description') }}">
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-12">
                            <label for="image" class="form-label">Zdjęcie</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                                    Zapisz
                                </button>
                                <a href="{{ route('admin.course.lessons') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                                    Anuluj
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
