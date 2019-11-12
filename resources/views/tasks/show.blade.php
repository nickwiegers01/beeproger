@section('page_content')
    <title> {{ $task->title }} Bewerken-Bekijken | BeepRoger ToDo </title>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <!-- CARD TITLE -->
                        <h5>{{ $task->title }} Bewerken/Bekijken</h5>
                    </div>
                    <div class="card-body">
                        <!-- CARD BODY-->
                        <form method="POST" enctype="multipart/form-data" action="{{ route('task.update', ['tasks' => $task]) }}">
                            @csrf
                            <!-- Titel sectie van formulier -->
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Titel : </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="title" value="{{ $task->title }}" required>
                                </div>
                            </div>

                            <!-- Extra's sectie van formulier -->
                            <div class="form-group row">
                                <label for="extras" class="col-md-4 col-form-label text-md-right">Bijzonderheden : </label>
                                <div class="col-md-6">
                                    <textarea class="form-control" type="text" name="extras" placeholder="bijzonderheden">{{ $task->extras }}</textarea>
                                </div>
                            </div>

                            <!-- Foto upload sectie van formulier -->
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Foto :</label>
                                <div class="col-md-6">
                                    <img class="img-thumbnail" src="{{ asset('UPLOADS/'. $task->image) }}">
                                </div>
                            </div>

                            <div class="form-group row text-muted">
                                <label for="info" class="col-md-4 col-form-label text-md-right">Informatie :</label>
                                <div class="col-md-6">
                                    <p> Aangemaakt op : {{ $task->created_at }}</p>
                                    <p> User-ID : {{ $task->user_ID }}</p>

                                    <!-- HIDDEN INPUTS -->
                                    <input type="hidden" name="status" value="{{ $task->status }}">
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Taak updaten</button>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
