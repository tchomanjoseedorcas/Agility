@extends('pages.template')

@section('content')
<div class="pagetitle">
    <h1>Détails de la Réponse</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('reponse.index') }}">Réponses</a></li>
            <li class="breadcrumb-item">Détails</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails de la Réponse</h5>
                        <div class="row mb-3">
                            <label for="questionId" class="col-sm-2 col-form-label">Questions :</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="questionId" id="questionId" disabled>
                                    @foreach ($quizQuestions as $quiz)
                                        <option value="{{ $quiz->id }}" {{ $quiz->id === $reponse->questionId ? 'selected' : '' }}>
                                            {{ $quiz->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="label" class="col-sm-2 col-form-label">Label :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="label" id="label" value="{{ $reponse->label }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Correcte :</label>
                            <div class="col-sm-10">
                                <input type="checkbox" class="form-check-input" name="isCorrect" value="1" {{ $reponse->isCorrect ? 'checked' : '' }} disabled>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
