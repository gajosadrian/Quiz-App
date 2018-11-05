@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <b-block title="Informacja" theme="czerwonetlo" noround full>
                    <template slot="content">
                        {{ ini_get('session.gc_maxlifetime') }}<br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </template>
                </b-block>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Błąd</h3>
                        <p class="mb-0">{!! $errors->first() !!}</p>
                    </div>
                @endif
                <b-block title="Logowanie" theme="obramowka" noround>
                    <template slot="content">
                        <form action="{{ route('user.tryLogin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-noborder">Zaloguj</button>
                            </div>
                        </form>
                    </template>
                </b-block>
            </div>
        </div>
    </div>
@endsection
