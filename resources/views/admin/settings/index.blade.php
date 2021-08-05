@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.setting.account') }}" class="btn btn-sm btn-outline-primary">Ustawienia konta</a>
                <a href="{{ route('admin.setting.application') }}" class="btn btn-sm btn-outline-primary">Ustawienia apliacji</a>
            </div>
        </div>
    </div>
@endsection
