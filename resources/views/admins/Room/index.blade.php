@extends('layouts.basead')
@section('title', 'Room Manager')
@section('manager', 'active')
@section('room','active')
@section('block','display: block;')
@section('content')
<div class="main-content">
    <div class="section__content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5"
                    style="
                    font-family: 'Baloo Tamma', cursive;
                    text-align: center;
                    width: 100%;
                    font-size: 70px;
                    letter-spacing: 5px;">Room Manager</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="search" id="search">
                                    <option selected="selected" disabled>Categories</option>
                                    @foreach($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>filters
                            </button>
                            </form>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="btn btn-success btn-radius" data-toggle="modal" data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>add room
                            </button>
                        </div>
                    </div>
                    {{-- List item --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead style="background-color: #333;color: #fff !important" >
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>category</th>
                                    <th>visibility</th>
                                    <th>status</th>
                                    <th>area</th>
                                    <th>description</th>
                                    <th>cover image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr class="tr-shadow">
                                    <input type="hidden" class="visibility" name="visibility" value="{{$item->visibility}}">
                                    <input type="hidden" class="category_id" value="{{$item->category_id}}">
                                    <input type="hidden" class="status" value="{{$item->status}}">
                                    <input type="hidden" class="" value="{{$item->id}}">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->categories->name}}</td>
                                    <td>{{( $item->visibility == 1)?"Display":"Hidden" }}</td>
                                    <td>@switch($item->status)
                                        @case(0)
                                            {{"Emty"}}
                                            @break
                                        @case(1)
                                            {{"Full"}}
                                            @break
                                        @case(2)
                                             {{"Ordered"}}
                                            @break
                                        @default
                                    @endswitch
                                    </td>
                                    <td>{{ $item->area }}</td>
                                    <td class="des_text">{{ $item->description}}</td>
                                    <td>
                                        <img  src="/upload/cover/{{ $item->image }}" style="width: 100px;" class="img-thumbnail">
                                    </td>
                                    <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin.room.show',$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="item edit_btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <form id="deleteForm" action="{{ route('admin.room.destroy',$item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="item delete_btn" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    {{-- Add Modal --}}
    <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addform" method="post" action="{{ route('admin.room.store') }}"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Room Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Room name" required>
                    </div>
                    <div class="form-group">
                        <label for="max_people">Room Category</label>
                         <select name="category_id" id="" class="form-control ">
                            @foreach($category as $value)
                                 <option value="Category Room" disabled selected></option>
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="form-group file-upload">
                        <label for="image" style="font-size: 16px;text-align: left;">Images</label>
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noFile">No file chosen...</div>
                            <input type="file" name="image" id="chooseFile">
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="status">Status</label>
                         <select name="status" id="" class="form-control ">
                            <option value="0">Empty</option>
                            <option value="1">Full</option>
                            <option value="2">Ordered</option>
                        </select>
                    </div>
                    <div class="form-group form-check toogle pl-0 mb-0">
                        <label for="visibility">Visibility
                        <label class="switch">
                            <input type="checkbox" name="visibility">
                            <div class="slider round"></div>
                        </label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <input name="area" type="number" class="form-control" placeholder="Area" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ADD</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
        </div>
    </div>
    {{-- Edit Modal --}}
     <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform" method="post" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryname">Room Name :</label>
                        <input name="name" id="name" type="text" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Room Category :</label>
                         <select name="category_id" id="category_id" class="form-control ">
                            @foreach($category as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="form-group file-upload">
                        <label for="image" style="font-size: 16px;text-align: left;">Images</label>
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noFile">No file chosen...</div>
                            <input type="file" name="image" id="chooseFile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status :</label>
                         <select name="status" id="status" class="form-control ">
                            <option value="0">Empty</option>
                            <option value="1">Full</option>
                            <option value="2">Ordered</option>
                        </select>
                    </div>
                    <div class="form-group form-check toogle pl-0 mb-0">
                        <label for="visibility">Visibility
                        <label class="switch">
                            <input type="checkbox" name="visibility" id="visibility">
                            <div class="slider round"></div>
                        </label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="categoryname">Area :</label>
                        <input name="area" id="area" type="number" class="form-control" placeholder="Area" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea name="description" id="description" class="form-control"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
        </div>
    </div>
@endsection
@section('scripts')
@if(Session::has('success'))
  <script>
     toastr.success("{{ session("success") }}")
 </script>
 @endif
 @if(Session::has('error'))
  <script>
     toastr.error("{{ session("error") }}")
 </script>
 @endif
 <script>
    $(document).ready(function()
    {
    $('.edit_btn').on('click',function(){
        $('#editModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();
        var data_id = $tr.children('input').map(function(){
            return $(this).val();
        }).get();
        $('#name').val(data[1]);
        (data_id[0] == 1) ? $("#visibility").prop("checked", true) : $("#visibility").prop("checked", false);
        $('#category_id').val(data_id[1]).attr("selected", "selected");
        $('#status').val(data_id[2]).attr("selected", "selected");
        $('#area').val(data[5]);
        $('textarea#description').val(data[6]);
        $('#editform').attr('action', '/admin/room/'+data_id[3]);
    });
    });
 </script>
 <script>
    $('#chooseFile').bind('change', function () {
      var filename = $("#chooseFile").val();
      if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass('active');
        $("#noFile").text("No file chosen...");
      }
      else {
        $(".file-upload").addClass('active');
        $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
      }
    });
 </script>
 @endsection
