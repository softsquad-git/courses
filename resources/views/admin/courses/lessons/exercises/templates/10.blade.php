<div id="app">
    dfdf
    <ten_-exercise-component type="10" item_id="{{$item->id}}" save_url="{{ $item->id ? route('admin.exercise.update', ['id' => $item->id]) : route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></ten_-exercise-component>
</div>
