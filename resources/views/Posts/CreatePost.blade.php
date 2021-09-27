@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content-header')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Create Post</h1>
            </div>
            <br>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="3">Choose a Community</option>
                                @foreach ($Communities as $Community)
                                    <option value="{{ $Community->id }}">{{ $Community->title }}</option>
                                @endforeach
                            </select>
                            <span class="select2 select2-container select2-container--default select2-container--below"
                                dir="ltr" data-select2-id="2" style="width: 100%;">
                                <span class="selection">
                                    <span class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-lzxs-container">
                                        <span class="select2-selection__rendered" id="select2-lzxs-container" role="textbox"
                                            aria-readonly="true" title="Alabama">
                                            Alabama
                                        </span>
                                        <span class="select2-selection__arrow" role="presentation">
                                            <b role="presentation"></b>
                                        </span>
                                    </span>
                                </span>
                                <span class="dropdown-wrapper" aria-hidden="true">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <span><i class="fas fa-clipboard"></i></span>
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                    aria-selected="true">Post</a>
                            </li>
                            <li class="nav-item">
                                <span><i class="fas fa-image"></i></span>
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Image & Video</a>
                            </li>
                            <li class="nav-item">
                                <span><i class="fas fa-link"></i></span>
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                                    aria-selected="false">Link</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">
                                <form action="{{ route('Posts.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input class="form-control form-control-lg" type="text" placeholder="title"
                                                name="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="7" placeholder="Text (Optional)"
                                                name="body"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-outline-primary btn-lg">Post</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <form action="{{ route('Posts.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input class="form-control form-control-lg" type="text" placeholder="title"
                                                name="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <p>
                                                Drag and drop images or <button type="submit"
                                                    class="btn btn-block btn-outline-info fileinput-button dz-clickable">Upload</button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-outline-primary btn-lg">Post</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-four-messages-tab">
                                <form action="{{ route('Posts.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input class="form-control form-control-lg" type="text" placeholder="title"
                                                name="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input class="form-control form-control-lg" type="text" placeholder="URL"
                                            name="url">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-outline-primary btn-lg">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
@endsection
