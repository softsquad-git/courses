<div id="app">
    <eight_-exercise-component type="{{request()->input('type')}}" item_id="{{$item->id}}" save_url="{{ $item->id ? route('admin.exercise.update', ['id' => $item->id]) : route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></eight_-exercise-component>
</div>
