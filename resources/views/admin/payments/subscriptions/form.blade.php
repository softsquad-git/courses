@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ $item->id ? route('admin.subscription.update', ['id' => $item->id]) : route('admin.subscription.create') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ? $item->name : old('name') }}"
                                   placeholder="Nazwa">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="price">Cena</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $item->price ? $item->getPrice() : old('price') }}"
                                   placeholder="Cena">
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="price_promo">Cena promocyjna</label>
                            <input type="text" class="form-control" id="price_promo" name="price_promo" value="{{ $item->price_promo ? $item->getPricePromo() : old('price_promo') }}"
                                   placeholder="Cena promocyjna">
                            @error('price_promo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="unit">Jednostka (dni)</label>
                            <input type="number" value="{{ $item->unit ? $item->unit : old('unit') }}" name="unit" class="form-control">
                            @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="is_best_offer" class="col-form-label mt-4">
                                <input type="checkbox" name="is_best_offer" id="is_best_offer" @if($item->is_best_offer) checked="checked" @endif> Najlepsza oferta
                            </label>
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
