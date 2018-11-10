@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ URL::previous() }}" class="btn btn-primary btn-noborder">Wróć</a>
    </h2>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>E-mail</th>
                        <th>Kod dostępowy</th>
                        <th>Poprawne odp.</th>
                        <th>Czas wykonania</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uczestnicy as $uczestnik)
                        <tr>
                            <td>{{ $uczestnik->email }}</td>
                            <td>{{ $uczestnik->nazwa }}</td>
                            <td>{{ sizeof($uczestnik->correctQuestionIds) }}</td>
                            <td>{{ $uczestnik->czas }} s</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
