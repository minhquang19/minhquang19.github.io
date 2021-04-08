@extends('layouts.basead')
@section('title', 'Category Manager')
@section('manager', 'active')
@section('category','active')
@section('block','display: block;')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5" style="font-family: 'Baloo Tamma', cursive;text-align: center;width: 100%;    font-size: 60px;letter-spacing: 5px;">CATEGORY MANAGER</h3>
                     <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button class="btn btn-success btn-radius"  data-toggle="modal" data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </div>
                    </div>
                    {{-- list Item --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead style="background-color: #333;color: #fff !important" >
                                <tr>
                                    <th>TT</th>
                                    <th>Name</th>
                                    <th>Max People</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($data as $key => $item)
                                <tr class="tr-shadow">
                                    <input type="hidden" class="delete_val" value="{{ $item->id }}" name="">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->max_people }}</td>
                                    <td class="des_text">{{ $item->description }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item view_btn" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="item edit_btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                                 <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <form class="myForm" action="{{ route('admin.category.destroy',$item->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Are you sure?')"  class="item delete_btn" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- list Item --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal View --}}
    <div class="modal fade bd-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi Tiết Loại Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="viewform" method="post" action="">
                <div class="modal-body">
                    <input type="hidden" id="Vid">
                    <div class="form-group">
                        <label for="categoryname">Category Name</label>
                        <input name="name" id="Vname" type="text" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="form-group">
                        <label for="max_people">Max People</label>
                        <input name="max_people" id="Vmax" type="text" class="form-control" placeholder="Maximun of People" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="Vdes" class="form-control"  rows="3"></textarea>
                    </div>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
        </div>
    </div>

    {{-- Modal Add --}}
    <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Loại Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addform" method="post" action="{{ route('admin.category.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryname">Category Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="form-group">
                        <label for="max_people">Max People</label>
                        <input name="max_people" type="number" class="form-control" placeholder="Maximun of People" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
        </div>
    </div>

    {{-- Modal Update --}}
    <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Loại Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="Eid">
                    <div class="form-group">
                        <label for="categoryname">Category Name</label>
                        <input name="name" id="Ename" type="text" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="form-group">
                        <label for="max_people">Max People</label>
                        <input name="max_people" id="Emax" type="text" class="form-control" placeholder="Maximun of People" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="Edes" class="form-control"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
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

            $('#Eid').val(data[0]);
            $('#Ename').val(data[1]);
            $('#Emax').val(data[2]);
            $('#Edes').val(data[3]);
            $('#editform').attr('action', '/admin/category/'+data[0]);
        });

        $('.view_btn').on('click',function(){
            $('#viewModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function(){
                return $(this).text();
            }).get();

            $('#Vid').val(data[0]);
            $('#Vname').val(data[1]);
            $('#Vmax').val(data[2]);
            $('#Vdes').val(data[3]);
        });
    });
</script>
@endsection
