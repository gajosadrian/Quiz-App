@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Błąd</h3>
                        <p class="mb-0">{!! $errors->first() !!}</p>
                    </div>
                @endif
                <b-block title="Logowanie" shadow>
                    <template slot="content">
                        <form action="{{ route('user.tryLogin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Zaloguj</button>
                            </div>
                        </form>
                    </template>
                </b-block>
            </div>
        </div>
    </div>
@endsection
