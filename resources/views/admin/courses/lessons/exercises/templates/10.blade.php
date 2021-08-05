<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="txt">Słowo</label>
        <input type="text" class="form-control" name="exercise[txt]" id="txt" value="{{ old('txt') }}">
    </div>
    <div class="col-md-6">
        <label for="txt_trans" class="col-form-label">Słowo przetłumaczone</label>
        <input type="text" class="form-control" name="exercise[txt_trans]" id="txt_trans" value="{{ old('txt_trans') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="sentence">Zdanie</label>
        <input type="text" class="form-control" name="exercise[sentence]" id="sentence" value="{{ old('sentence') }}">
    </div>
    <div class="col-md-6">
        <label for="sentence_trans" class="col-form-label">Zdanie przetłumaczone</label>
        <input type="text" class="form-control" name="exercise[sentence_trans]" id="sentence_trans" value="{{ old('sentence_trans') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
        <input type="file" class="form-control" accept=".mp3" id="sound_file" name="exercise[sound_file]">
    </div>
</div>
