@extends('layouts.app')

@section('content')

    <style>
        .big-checkbox {width: 30px; height: 30px;}
    </style>
    <div class="p-3">
        <div class="row ">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Enter new artist data</h4>
                                <form action="{{ route('artist.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-inline">
                                            <input type="text" name="first_name" placeholder="First Name *" class="form-control m-1">
                                            <input type="text" name="middle_name" placeholder="Middle Name (Optional)" class="form-control m-1">
                                            <input type="text" name="last_name" placeholder="Last Name *" class="form-control m-1">
                                            <input type="text" name="nic" placeholder="NIC *" class="form-control m-1">
                                            <input type="text" name="membership_number" placeholder="Membership Number *" class="form-control m-1">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-inline">
                                            <input type="text" name="dob" placeholder="Date of Birth" class="form-control m-1">
                                            <input type="text" name="phone" placeholder="Contact No. (Optional)" class="form-control m-1">
                                            <input type="text" name="email" placeholder="Email (Optional)" class="form-control m-1">
                                            <input type="text" name="address" placeholder="Address (Optional)" class="form-control m-1">
                                            <input type="text" name="comments" placeholder="Comments (Optional)" class="form-control m-1">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label form-control-lg"><input value="1" type="checkbox" name="isSinger" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Singer</label>
                                            <label class="form-check-label form-control-lg"><input value="1" type="checkbox" name="isLyricist" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Lyricist</label>
                                            <label class="form-check-label form-control-lg"><input value="1" type="checkbox" name="isMusician" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Musician</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success">
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif




                            <hr>

                            <div class="row">
                                <div class="col">
                                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>#</th>
                                            <th>Nic</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Membership Number</th>
                                            <th>Dob</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Roles</th>
                                            <th>Comments</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($artists as $artist)
                                            <tr>
                                                <td>
                                                    <button data-toggle="modal" data-target="#edit-modal" class="edit_btn btn btn-sm btn-outline-warning" data-id="{{ $artist->id }}" type="button">
                                                        Edit
                                                    </button>
                                                    <button data-toggle="modal" data-target="#delete-modal" class="delete_btn btn btn-sm btn-outline-danger" data-id="{{ $artist->id }}" type="button">
                                                        Delete
                                                    </button>
                                                </td>
                                                <td>{{ $artist->id }}</td>
                                                <td>{{ $artist->nic }}</td>
                                                <td>{{ $artist->first_name }}</td>
                                                <td>{{ $artist->middle_name }}</td>
                                                <td>{{ $artist->last_name }}</td>
                                                <td>{{ $artist->membership_number }}</td>
                                                <td>{{ $artist->dob }}</td>
                                                <td>{{ $artist->email }}</td>
                                                <td>{{ $artist->phone }}</td>
                                                <td>{{ $artist->address }}</td>
                                                <td>{{ $artist->roles() }}</td>
                                                <td>{{ $artist->comments }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Action</th>
                                            <th>#</th>
                                            <th>Nic</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Membership Number</th>
                                            <th>Dob</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Roles</th>
                                            <th>Comments</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close close_edit" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="edit_form">
                        @csrf
                        @method("PUT")

                        <div class="form-group">
                            <div class="form-inline">
                                <input type="text" id="first_name" name="first_name" placeholder="First Name *" class="form-control m-1">
                                <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name (Optional)" class="form-control m-1">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name *" class="form-control m-1">
                                <input type="text" id="nic" name="nic" placeholder="NIC *" class="form-control m-1">
                                <input type="text" id="membership_number" name="membership_number" placeholder="Membership Number *" class="form-control m-1">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-inline">
                                <input type="text" id="dob" name="dob" placeholder="Date of Birth" class="form-control m-1">
                                <input type="text" id="phone" name="phone" placeholder="Contact No. (Optional)" class="form-control m-1">
                                <input type="text" id="email" name="email" placeholder="Email (Optional)" class="form-control m-1">
                                <input type="text" id="address" name="address" placeholder="Address (Optional)" class="form-control m-1">
                                <input type="text" id="comments" name="comments" placeholder="Comments (Optional)" class="form-control m-1">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check-inline">
                                <label class="form-check-label form-control-lg"><input value="1" type="checkbox" id="isSinger" name="isSinger" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Singer</label>
                                <label class="form-check-label form-control-lg"><input value="1" type="checkbox" id="isLyricist" name="isLyricist" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Lyricist</label>
                                <label class="form-check-label form-control-lg"><input value="1" type="checkbox" id="isMusician" name="isMusician" class="form-check-input ml-5 pl-5 form-control-lg big-checkbox"> - Musician</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_edit" data-dismiss="modal">Close</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Artist Record</h5>
                    <button type="button" class="close_delete close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this artist?
                    <form action="" method="post" id="delete_form">
                        @csrf
                        @method("DELETE")

                        <input type="submit" class="btn btn-danger" value="Yes">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close_delete btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <script>
        var artists_str = '{!! $artists !!}';
        var artists = JSON.parse('{!! $artists !!}');
        // var len = artists.length;

        $(document).ready(function () {

            $('.form-check-input').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();

            $(".edit_btn").click(function (e) {
                e.preventDefault();
                var artist_id = $(this).attr("data-id");
                $.each(artists, function (id, artist) {
                    if (artist_id == artist.id){
                        $.each(artist, function (field, value) {
                            $("#"+field).attr("value", value);

                            if (field == "isSinger" || field == "isLyricist" || field == "isMusician") {
                                if (value == 1){
                                    $("#"+field).prop("checked", true)
                                }
                                else {
                                    $("#"+field).prop("checked", false)
                                }
                            }

                        });
                        $("#edit_form").attr("action", "/artist/"+artist_id);

                        $("#edit-modal").show();
                        return false;
                    }

                });
            });

            $(".close_edit").click(function (e) {
                e.preventDefault();
                $("#edit-modal").hide();
            });

            $(".delete_btn").click(function (e) {
                e.preventDefault();
                var artist_id = $(this).attr("data-id");
                $("#delete_form").attr("action", "/artist/"+artist_id);
                $("#delete-modal").show();
            });

            $(".close_delete").click(function (e) {
                e.preventDefault();
                $("#delete-modal").hide();
            });

        });






    </script>

@endsection
