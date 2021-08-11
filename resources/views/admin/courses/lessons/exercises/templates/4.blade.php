<div id="app">
    <four_-exercise-component type="{{request()->input('type')}}" save_url="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></four_-exercise-component>
</div>
