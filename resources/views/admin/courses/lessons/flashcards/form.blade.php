@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.course.lessons.flashcards.update', ['id' => $item->id]) : route('admin.course.lessons.flashcards.create', ['lessonId' => $lessonId]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $lessonId }}" name="lesson_id">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="txt" class="col-form-label">Tekst</label>
                            <input id="txt" class="form-control" name="txt" value="{{ $item->txt ? $item->txt : old('txt') }}">
                            @error('txt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="txt_trans" class="col-form-label">Tekst przetłumaczony</label>
                            <input id="txt_trans" class="form-control" name="txt_trans" value="{{ $item->txt_trans ? $item->txt_trans : old('txt_trans') }}">
                            @error('txt_trans')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="image" class="col-form-label">Zdjęcie</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sound_file" class="col-form-label">Plik dźwiękowy</label>
                            <input type="file" class="form-control" id="sound_file" name="sound_file" accept=".mp3">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.course.lessons.flashcards.index', ['lessonId' => $lessonId]) }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
