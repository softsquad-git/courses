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
                            <a href="{{ route('admin.exercise.create', ['lessonId' => $lessonId]) }}"
                               class="btn btn-sm btn-outline-success float-right btn-rounded"><i
                                    class="icon icon-plus"></i></a>
                        </h5>
                    </div>
                    @if(count($data) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Rodzaj</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <th>{{ __('exercises.types.'.$item->type) }}</th>
                                    <td class="text-right">
                                        <a href="{{ route('admin.exercise.update', ['id' => $item->id]) }}" class="btn btn-outline-warning btn-sm mr-2 btn-rounded">
                                            <i class="icon icon-pencil"></i>
                                        </a>
                                        <form class="remove-form" style="display: inline-block" method="POST" action="{{ route('admin.exercise.remove', ['id' => $item->id]) }}">
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
                        <div class="card-footer">
                            @include('admin.partials.pagination', ['data' => $data])
                        </div>
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
