@extends('layouts.app')

@section('content')

    <div class="modal" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content shadow" id="modalDeleteContent">

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Автомобілі</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cars.create') }}" title="Додати авто"> <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>

        </tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->name }}</td>
                <td>
                    <textarea readonly >
                        {{ $car->description }}
                    </textarea>
                </td>
                <td>
                    @foreach ($car->CarImages as $img)

                        <img src="{{ Storage::url('files/profile-60ca343ea6556.jpg', 'Contents') }}" width="100px" alt="">
                    @endforeach
                </td>
                <td>
                    <button  onclick='loadDeleteModal({{$car->id}})' data-toggle='modal' data-target='#modalDelete' class='btn btn-danger' >Delete  <i class='fas fa-trash-alt'></i></button>
                </td>
            </tr>
        @endforeach
    </table>

    <script>

        function deleteCar(id){
            console.log('delete car '+id)
            $.ajax({
                url: '/api/cars/delete/'+id,
                type: 'DELETE',
                success: function(result) {
                    console.log(result)
                }
            });
        }

        function loadDeleteModal(id)
        {
            $(`#modalDeleteContent`).empty();
            $(`#modalDeleteContent`).append(`<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete car ${id}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form onsubmit="deleteCar(${id})" ethod="post">
                <input type='hidden' name='id' value='${id}'>
                <button type="submit" name="delete_submit" class="btn btn-danger">Delete</button>
            </form>
        </div>`);
        }
    </script>

@endsection
