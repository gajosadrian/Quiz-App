@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ URL::previous() }}" class="btn btn-primary btn-noborder">Wróć</a>
    </h2>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th style="width:20%">E-mail opiekuna:</th>
                        <td>{{ $uczestnik->email }}</td>
                    </tr>
                    <tr>
                        <th>Kod dostępowy:</th>
                        <td>{{ $uczestnik->nazwa }}</td>
                    </tr>
                    <tr>
                        <th>Uzyskane punkty:</th>
                        <td>{{ $correctQuestionsAmount }} / 45</td>
                    </tr>
                    <tr>
                        <th>Czas trwania quizu:</th>
                        <td>{{ gmdate('i', $uczestnik->czas) }} min {{ gmdate('s', $uczestnik->czas) }} s</td>
                    </tr>
                    <tr>
                        <th>Data rozpoczęcia quizu:</th>
                        <td>{{ $uczestnik->data_rozpoczecia_testu }}</td>
                    </tr>
                    <tr>
                        <th>Data zakończenia quizu:</th>
                        <td>{{ $uczestnik->data_zakonczenia_testu }}</td>
                    </tr>
                    <tr>
                        <th>Data ostatniego logowania:</th>
                        <td>{{ $uczestnik->data_ostatniego_logowania }}</td>
                    </tr>
                    <tr>
                        <th>Ostatnie IP:</th>
                        <td>{{ $uczestnik->last_ip }}</td>
                    </tr>
                    <tr>
                        <th>Aplikacja kliencka:</th>
                        <td>{{ $uczestnik->user_agent }}</td>
                    </tr>
                </tbody>
            </table>
            <p>
                Prawidłowa odpowiedź uczestnika zaznaczona na <span class="font-w700 text-success">zielono</span>.<br>
                Nieprawidłowa odpowiedź uczestnika zaznaczona na <span class="font-w700 text-danger">czerwono</span>.<br>
                Prawidłowa odpowiedź <u>podkreślona</u>.
            </p>
            <ol>
                @foreach ($uczestnik->odpowiedzi as $questionRawId => $responseId)
                    @php
                        $groupIndex = getGroupIndex($questionRawId);
                        $questionId = getQuestionId($questionRawId);
                        $question = $pytania[$groupIndex]['questions'][$questionId];
                    @endphp
                    <li class="font-w700">{!! $question['text'] !!}</li>
                    @if ($question['image'])
                        <img src="{{ $question['image'] }}" style="max-height:200px">
                    @endif
                    <ol class="push">
                        @foreach ($question['responses'] as $responseIndex => $response)
                            <li class="{{ ($responseIndex + 1 == $responseId and isset($response[1]) and $response[1]) ? 'font-w700 text-success' : '' }}{{ ($responseIndex + 1 == $responseId and !isset($response[1])) ? 'font-w700 text-danger' : '' }}" style="{{ (isset($response[1]) and $response[1]) ? 'text-decoration: underline' : '' }}">{{ $response[0] }}</li>
                        @endforeach
                    </ol>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
