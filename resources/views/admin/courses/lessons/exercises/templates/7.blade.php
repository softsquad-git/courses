<div id="app">
    <seven_-exercise-component type="{{request()->input('type')}}" item_id="{{$item->id}}" save_url="{{ $item->id ? route('admin.exercise.update', ['id' => $item->id]) : route('admin.exercise.create', ['lessonId' => $lessonId]) }}" lesson_id="{{$lessonId}}"></seven_-exercise-component>
</div>
