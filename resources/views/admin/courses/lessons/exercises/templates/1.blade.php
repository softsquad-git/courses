<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="txt">Tekst</label>
        <input type="text" class="form-control" name="exercise[txt]" id="txt" value="{{ old('txt') }}">
    </div>
    <div class="col-md-6">
        <label for="txt_trans" class="col-form-label">Tekst przetłumaczony</label>
        <input type="text" class="form-control" name="exercise[txt_trans]" id="txt_trans" value="{{ old('txt_trans') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6">
        <label class="col-form-label" for="image">Zdjęcie</label>
        <input type="file" class="form-control" id="image" name="exercise[image]">
    </div>
    <div class="col-md-6">
        <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
        <input type="file" class="form-control" accept=".mp3" id="sound_file" name="exercise[sound_file]">
    </div>
</div>
