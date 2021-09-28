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
                        <label for="speech_bubble" class="col-form-label">Treść dymka (górnego)</label>
                        <textarea id="speech_bubble" name="speech_bubble" class="editor">{{ $item->speech_bubble ? $item->speech_bubble : old('speech_bubble') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="is_premium" class="col-form-label">
                            <input type="checkbox" @if($item->is_premium) checked="checked" @endif id="is_premium" name="is_premium" value="1">
                            Lekcja tylko po wykupieniu kursu
                        </label>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2 col-12">
                            <label for="lesson_time" class="col-form-label">Czas lekcji</label>
                            <input type="text" class="form-control" name="lesson_time" value="{{ $item->lesson_time ? $item->lesson_time : old('lesson_time') }}">
                            @error('lesson_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="time_file_audio" class="col-form-label">Czas audio</label>
                            <input type="text" class="form-control" name="time_file_audio" value="{{ $item->time_file_audio ? $item->time_file_audio : old('time_file_audio') }}">
                            @error('time_file_audio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="position" class="col-form-label">Pozycja</label>
                            <input type="number" class="form-control" name="position" value="{{ $item->position ? $item->position : old('position') }}">
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="file_audio" class="col-form-label">Plik audio</label>
                            <input type="file" class="form-control" name="file_audio">
                            @error('file_audio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-12">
                            <label for="end_lesson_title" class="form-label">Nagłówek (Zakończenie lekcji)</label>
                            <input type="text" class="form-control" id="end_lesson_title" name="endLesson[title]" value="{{ $item->endLesson ? ($item->endLesson?->title ? $item->endLesson->title : '') : (old('endLesson.title')) }}">
                            @error('endLesson.title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="end_lesson_sub_title" class="form-label">Tytuł (Zakończenie lekcji)</label>
                            <input type="text" class="form-control" id="end_lesson_sub_title" name="endLesson[sub_title]" value="{{ $item->endLesson ? ($item->endLesson?->sub_title ? $item->endLesson->sub_title : '') : (old('endLesson.sub_title')) }}">
                            @error('endLesson.sub_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="end_lesson_desc" class="form-label">Podtytuł (Zakończenie lekcji)</label>
                            <input type="text" class="form-control" id="end_lesson_desc" name="endLesson[description]" value="{{ $item->endLesson ? ($item->endLesson?->description ? $item->endLesson->description : '') : (old('endLesson.description')) }}">
                            @error('endLesson.description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="end_lesson_image" class="form-label">Zdjęcie (Zakończenie lekcji)</label>
                            <input type="file" class="form-control" name="endLesson[image]">
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
