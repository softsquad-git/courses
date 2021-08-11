<div id="app">
    <eight_-exercise-component type="{{request()->input('type')}}" save_url="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></eight_-exercise-component>
</div>
