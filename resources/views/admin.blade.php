@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ route('logout') }}" class="btn btn-sm btn-primary float-right">
            <i class="fa fa-check mr-5"></i> Wyloguj
        </a>
        Zalogowany jako <span class="text-primary font-w700">{{ Auth::user()->name }}</span>
    </h2>

    <div class="row">
        <div class="col-12">
            <b-block title="Dashboard" full>
                <template slot="content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </template>
            </b-block>
        </div>
    </div>
</div>
@endsection
