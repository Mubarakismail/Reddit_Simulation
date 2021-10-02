@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                @foreach ($posts as $post)
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle" src="{{ asset('img/user1-128x128.jpg') }}"
                                                    alt="User Image">
                                                <span class="username"><a
                                                        href="#">{{ $post->user->username }}</a></span>
                                                <span class="description">Shared publicly -
                                                    {{ $post->created_at }}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" title="Mark as read">
                                                    <i class="far fa-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <!-- post text -->
                                            @if (isset($post->post_body) && $post->post_body != '')
                                                <p>{{ $post->post_body }}</p>
                                            @endif

                                            <!-- Attachment -->

                                            @if (isset($post->post_image))
                                                <img class="img-fluid pad"
                                                    src="{{ asset('images/upload/$post->post_image') }}" alt="Photo">
                                            @elseif (isset($post->post_video))
                                                <video controls class="video-fluid">
                                                    <source src="{{ asset('videos/upload/$post->post_video') }}"
                                                        type="video">
                                                </video>
                                            @endif
                                            <!-- /.attachment-block -->

                                            <!-- Social sharing buttons -->

                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                            </button>
                                            <span>Vote</span>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                            </button>
                                            <button type="button" class="btn btn-default">
                                                <i class="fas fa-comment-dots"></i> {{ $post->comments->count() }}
                                                Comments
                                            </button>

                                            <button type="button" class="btn btn-default btn-sm"><i
                                                    class="fas fa-share"></i>
                                                Share</button>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="lv:{{ asset('
                            images/uploads/$user->profile_photo') }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->username }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">{{ $user->friends->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Posts</b> <a class="float-right">{{ $user->posts->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Communities</b> <a class="float-right">{{ $user->communities->count() }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            {{ $user->education }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{ $user->address }}</p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Bio</strong>

                        <p class="text-muted">{{ $user->bio }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('script')

@endsection
