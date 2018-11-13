@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ route('admin') }}" class="btn btn-primary btn-noborder">Wróć</a>
    </h2>

    <div class="row">
        <div class="col-12">
            <ol>
                @foreach ($pytania as $v)
                    @foreach ($v['questions'] as $question)
                        <li class="font-w700">{!! $question['text'] !!}</li>
                        @if ($question['image'])
                            <img src="{{ $question['image'] }}" style="max-height:200px">
                        @endif
                        <ol class="push">
                            @foreach ($question['responses'] as $response)
                                <li class="{{ (isset($response[1]) and $response[1]) ? 'font-w700 text-primary' : '' }}">{{ $response[0] }}</li>
                            @endforeach
                        </ol>
                    @endforeach
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
