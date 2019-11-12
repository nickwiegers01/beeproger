@section('page_content')
    <title>To-Do : {{ Auth::user()->name }}</title>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="card-title">
                            Alle taken van {{ Auth::user()->name }}

                            <!-- CONTROL BUTTONS -->
                            <div class="float-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary text-white" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="message"></div>

                        <!-- TABLE SECTION -->
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Aangemaakt op</th>
                                    <th>Status</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody id="task_list">

                                <!-- TABEL WORDT GEVULD DOOR JAVASCRIPT -->

                            </tbody>
                        </table>
                        <!-- EINDE TABLE SECTIE-->

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL SECTION -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Taak Toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <!-- FORMULIER VOOR TOEVOEGEN VAN EEN TAAK -->
                    <form method="POST" enctype="multipart/form-data" action="{{ route('task.store') }}">

                        @csrf
                        <div class="modal-body">
                            <!-- Titel sectie van formulier -->
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Titel : </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="title" placeholder="Vul hier de titel in" required>
                                </div>
                            </div>

                            <!-- Extra's sectie van formulier -->
                            <div class="form-group row">
                                <label for="extras" class="col-md-4 col-form-label text-md-right">Bijzonderheden : </label>
                                <div class="col-md-6">
                                    <textarea class="form-control" type="text" name="extras" placeholder="bijzonderheden"></textarea>
                                </div>
                            </div>

                            <!-- Foto upload sectie van formulier -->
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Foto :</label>
                                <div class="col-md-6">
                                    <input type="file" accept="image" name="image">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Taak toevoegen</button>
                        </div>

                    </form>
                    <!-- EINDE MODAL FORMULIER -->

            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            getTasks();
        };
        async function getTasks() {
            let output = document.querySelector('#task_list');

            await fetch("{{ url('/getTasks') }}")
                .then(response => response.json())
                .then(data => {
                    data.forEach( function (item) {
                        let id = item.id;
                        let bg_color = (item.status === 0 ? 'bg-danger' : 'bg-success');
                        let icon = (item.status === 0 ? 'fa fa-times text-white' : 'fa fa-check text-white' );
                        let complete = "{{ url('/update') }}/" + id;
                        let update = "{{ url('/show') }}/" + id;

                        let template = `
                               <tr>
                                        <td>${item.title}</td>
                                        <td>${item.created_at}</td>
                                        <td class="${bg_color}"><i class="${icon}"></i></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="${update}" class="btn btn-primary text-white" title="Update Taak"><i class="fa fa-edit"></i></a>
                                                <button onclick="deleteTask(${item})" class="btn btn-primary text-white" title="Verwijder Taak"><i class="fa fa-trash"></i></button>
                                                <a href="${complete}" class="btn btn-primary text-white" title="Voltooi Taak"><i class="fa fa-check"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                        `;
                        output.innerHTML += template;
                    })
                })
        }
        function deleteTask(item) {
            if (confirm("Weet u het zeker ?") == true){
                let url = "{{ url('/destroy') }}/" + item.id;
                location.href = url;
            }
        }
    </script>
@endsection
