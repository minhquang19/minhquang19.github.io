@extends('layouts.basead')
@section('title', 'Blog Manager')
@section('manager', 'active')
@section('service','active')
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
                    letter-spacing: 5px;">Service Manager</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-right">
                                <button class="btn btn-success btn-radius" data-toggle="modal" data-target="#addModal">
                                    <i class="zmdi zmdi-plus"></i>add Service
                                </button>
                            </div>
                        </div>
                        {{-- List item --}}
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead style="background-color: #333;color: #fff !important">
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>content</th>
                                    <th>image</th>
                                    <th>icon</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr class="tr-shadow">
                                        <input type="hidden" value="{{$item->id}}">
                                        <input type="hidden" class="icon" name="title" value="{{$item->icon}}">
                                        <input type="hidden" class="description" value="{{$item->description}}">
                                        <input type="hidden" class="content" value="{{$item->content}}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td class="des_text">{{ $item->name }}</td>
                                        <td class="des_text">{{ $item->description }}</td>
                                        <td class="des_text">{{ $item->content}}</td>
                                        <td>
                                            <img src="/upload/service/{{ $item->image }}" style="max-width: 100px;"
                                                 class="img-thumbnail">
                                        </td>
                                        <td>
                                            <i class="{{$item->icon}}"></i>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item edit_btn" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <form id="deleteForm"
                                                      action="{{ route('admin.service.destroy',$item->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')"
                                                            class="item delete_btn" data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
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
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    {{-- Add Modal --}}
    <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addform" method="post" action="{{ route('admin.service.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="name" type="text" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Icon</label>
                            <input name="icon" type="text" class="form-control" placeholder="Icon" required>
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
                            <label for="content">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="note">Content</label>
                            <textarea name="content" id="content" rows="10" cols="40" class="form-control tinymce-editor"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Modal --}}
    <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="ename" name="name" type="text" class="form-control" placeholder="Title"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="title">Icon</label>
                            <input id="eicon" name="icon" type="text" class="form-control" placeholder="Icon"
                                   required>
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
                            <label for="content">DesCription</label>
                            <textarea placeholder="Enter DesCription" name="description" id="edescription" class="form-control"
                                      rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="note">Content</label>
                            <textarea placeholder="Enter Content" name="content" id="econtent" class="tinymce-editor form-control"
                                      rows="12"></textarea>
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

        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea.tinymce-editor',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'

            });
            $('.edit_btn').on('click', function () {
                $('#editModal').modal('show');
                $tr = $(this).closest('tr');
                $td = $(this).closest('td');
                var data = $tr.children('td').map(function () {
                    return $(this).text();
                }).get();
                var data1 = $td.children('i').map(function () {
                    return $(this).className;
                }).get();
                var data_id = $tr.children('input').map(function () {
                    return $(this).val();
                }).get();
                console.log(data1);
                $('#ename').val(data[1]);
                $('textarea#edescription').val(data[2]);
                tinymce.get('econtent').setContent(data[3]);
                // $('textarea#econtent').setContent(data[3]);
                $('#eicon').val( data_id[1]);

                $('#editform').attr('action', '/admin/service/'+ data_id[0]);
            });
        });
    </script>
    <script>
        $('#chooseFile').bind('change', function () {
            var filename = $("#chooseFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen...");
            } else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
            }
        });
    </script>
@endsection
