@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.exercise.create', ['id' => $item->id]) : route('admin.exercise.create', ['lessonId' => $lessonId]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $lessonId }}" name="lesson_id">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="type" class="col-form-label">Wybierz rodzaj ćwiczenia</label>
                            <select id="type" class="form-control" name="type" onchange="location = `?type=`+this.value">
                                @foreach(\App\Models\Courses\Exercises\Exercise::$types as $key => $type)
                                    <option value="{{ $type }}"{{ request()->input('type') == $type ? 'selected' : '' }}>{{ __('exercises.types.'.$type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                    </div>
                    @if(request()->input('type'))
                        @include('admin.courses.lessons.exercises.templates.'.request()->input('type'))
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.exercises', ['lessonId' => $lessonId]) }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
