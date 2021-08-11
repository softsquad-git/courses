<div id="app">
    <nine_-exercise-component type="{{request()->input('type')}}" save_url="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></nine_-exercise-component>
</div>
