@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('user.logout') }}">Wyloguj</a>

            <b-block title="Dashboard" full>
                <template slot="content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </template>
            </b-block>
        </div>
    </div>
</div>
@endsection
