<form method="post" action="{{ route('admin.home.images.index') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-md-4">
            <label for="position" class="col-form-label">Pozycja</label>
            <select class="form-control" name="position" id="position">
                @foreach(\App\Models\Home\HomeImages::$positions as $position)
                    <option value="{{ $position }}">{{ __('admin.home.images.positions.'.$position) }}</option>
                @endforeach
            </select>
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label for="image" class="col-form-label">Zdjęcie</label>
            <input type="file" class="form-control" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-primary">Zapisz</button>
    </div>
</form>
