<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="question">Pytanie</label>
        <input type="text" class="form-control" name="exercise[question]" id="question" value="{{ old('question') }}">
    </div>
    <div class="col-md-6">
        <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
        <input type="file" class="form-control" accept=".mp3" id="sound_file" name="exercise[sound_file]">
    </div>
</div>
@include('admin.courses.lessons.exercises.templates.answers')
