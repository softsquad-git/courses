@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.partials.header', ['title' => $title])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="{{ route('admin.discount_code.create') }}"
                               class="btn btn-sm btn-outline-success float-right btn-rounded"><i
                                    class="icon icon-plus"></i></a>
                        </h5>
                    </div>
                    @if(count($data) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kod</th>
                                <th scope="col">Ważny od</th>
                                <th scope="col">Ważny do</th>
                                <th scope="col">Procentowa obniżka</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->percent_minus }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.discount_code.update', ['id' => $item->id]) }}" class="btn btn-outline-warning btn-sm mr-2 btn-rounded">
                                            <i class="icon icon-pencil"></i>
                                        </a>
                                        <form class="remove-form" style="display: inline-block" method="POST" action="{{ route('admin.discount_code.remove', ['id' => $item->id]) }}">
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
