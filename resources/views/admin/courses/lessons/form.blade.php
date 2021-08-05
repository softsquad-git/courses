@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.course.lesson.update', ['id' => $item->id]) : route('admin.course.lesson.create') }}" enctype="multipart/form-data">
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
                            <label for="course">Wybierz kurs</label>
                            <select name="course_id" id="course" class="form-control">
                                <option value="" selected>Wyierz kurs</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $item->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="image">Wybierz zdjęcie</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Opis</label>
                        <textarea id="description" name="description" class="editor">{{ $item->description ? $item->description : old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="is_premium" class="col-form-label">
                            <input type="checkbox" @if($item->is_premium) checked="checked" @endif id="is_premium" name="is_premium" value="1">
                            Lekcja tylko po wykupieniu kursu
                        </label>
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
