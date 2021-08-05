<form method="post" action="{{ $item->id ? route('admin.home.words.index', ['id' => $item->id]) : route('admin.home.words.index') }}">
    @csrf
    <div class="form-group">
        <label for="name" class="col-form-label">Dodaj słowo</label>
        <input id="name" name="name" class="form-control" value="{{ $item->name ? $item->name : old('name') }}">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-primary">Zapisz</button>
    </div>
</form>
