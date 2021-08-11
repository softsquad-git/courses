<div id="app">
    <two_-exercise-component type="{{request()->input('type')}}" save_url="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></two_-exercise-component>
</div>
