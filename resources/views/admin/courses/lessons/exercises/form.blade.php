@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <input type="hidden" value="{{ $lessonId }}" name="lesson_id">
                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="type" class="col-form-label">Wybierz rodzaj ćwiczenia</label>
                        <select id="type" class="form-control" name="type"
                                onchange="location = `?type=`+this.value" {{ $item->type ? 'disabled' : '' }}>
                            @foreach(\App\Models\Courses\Exercises\Exercise::$types as $key => $type)
                                <option
                                    value="{{ $type }}"{{ $item->type ? ($item->type == $type ? 'selected' : '') : (request()->input('type') == $type ? 'selected' : '' ) }}>{{ __('exercises.types.'.$type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                </div>
                @if($item->type)
                    @include('admin.courses.lessons.exercises.templates.'.$item->type)
                @else
                    @if(request()->input('type'))
                        @include('admin.courses.lessons.exercises.templates.'.request()->input('type'))
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
