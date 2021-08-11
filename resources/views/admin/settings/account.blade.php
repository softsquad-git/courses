@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.setting.account') }}" class="btn btn-sm btn-primary">Ustawienia konta</a>
                <a href="{{ route('admin.setting.application') }}" class="btn btn-sm btn-outline-primary">Ustawienia apliacji</a>

                <h4 class="mt-5">Dane podstawowe</h4>
                <form method="post" action="{{ route('admin.setting.change_basic_data') }}">
                    @csrf
                    @method('PATCH')
                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Imię</label>
                                    <input type="text" name="first_name" id="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Nazwisko</label>
                                    <input type="text" name="last_name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="col-form-label">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success mt-2">Zapisz</button>
                        </div>
                    </div>
                </form>

                <h4 class="mt-5">Hasło</h4>
                <form method="post" action="{{ route('admin.setting.change_password') }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="old_password" class="col-form-label">Obecne hasło</label>
                            <input type="password" class="form-control" name="old_password" id="old_password">
                        </div>
                        <div class="col-md-6">
                            <label for="new_password" class="col-form-label">Nowe hasło</label>
                            <input type="password" class="form-control" name="new_password" id="new_password">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success mt-2">Zapisz</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
