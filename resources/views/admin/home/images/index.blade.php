@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.home.images.form')
                    </div>
                    @if(count($data) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Zdjęcie</th>
                                <th scope="col">Pozycja</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><img src="{{ $item->getImage() }}" width="150px" alt="{{ $item->getImage() }}"></td>
                                    <td>{{ __('admin.home.images.positions.'.$item->position) }}</td>
                                    <td class="text-right">
                                        <form class="remove-form" style="display: inline-block" method="POST" action="{{ route('admin.home.images.remove', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-rounded">
                                                <i class="icon icon-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="container-fluid">
                            <div class="alert-danger alert text-center">
                                {{ __('admin.notifications.no_data') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
