@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.subscription.update', ['id' => $item->id]) : route('admin.subscription.create') }}">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-2 col-12">
                            <label for="period" class="form-label">Okres trwania</label>
                            <input type="text" class="form-control" id="period" aria-describedby="periodHelp" name="period" value="{{ $item->period ? $item->period : old('period') }}">
                            <div id="periodHelp" class="form-text">np. 12 miesięcy</div>
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="price" class="form-label">Cena</label>
                            <input type="number" id="price" class="form-control" step="0.01" name="price" value="{{ $item->price ? $item->getPrice() : old('price') }}">
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="price_promo" class="form-label">Cena promocyjna</label>
                            <input type="number" id="price_promo" class="form-control" step="0.01" name="price_promo" value="{{ $item->price_promo ? $item->getPricePromo() : old('price_promo') }}">
                        </div>
                        <div class="col-md-2 col-12">
                            <label for="on_period" class="form-label">Cena za msc</label>
                            <input type="number" id="on_period" class="form-control" step="0.01" name="on_period" value="{{ $item->on_period ? $item->getOnPeriod() : old('on_period') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded mr-2">
                            Zapisz
                        </button>
                        <a href="{{ route('admin.discount_codes') }}" class="btn btn-outline-danger btn-sm btn-rounded">
                            Anuluj
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
