<div id="app">
    <three_-exercise-component type="{{request()->input('type')}}" save_url="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></three_-exercise-component>
</div>
