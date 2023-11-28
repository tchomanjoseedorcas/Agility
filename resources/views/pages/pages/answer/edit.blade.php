@extends('pages.template')

@section('content')
<div class="pagetitle">
    <h1>Modification de la Réponse</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('reponse.index') }}">Réponses</a></li>
            <li class="breadcrumb-item">Modification</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Formulaire de Modification de la Réponse</h5>
                    <form method="POST" action="{{ route('reponse.update', $reponse->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="questionId" class="col-sm-2 col-form-label">Questions :</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="questionId" id="questionId" required>
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
                                <input type="text" class="form-control" name="label" id="label" value="{{ $reponse->label }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Correcte :</label>
                            <div class="col-sm-10">
                                <input type="checkbox" class="form-check-input" name="isCorrect" value="1" {{ $reponse->isCorrect ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 d-flex justify-content-end">
                                <!-- Utilize d-flex and justify-content-end to align the button to the right -->
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
