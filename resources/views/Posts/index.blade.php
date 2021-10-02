@extends('layouts.app')

@section('style')

@endsection

@section('content-header')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle" src="{{ asset('img/user1-128x128.jpg') }}" alt="User Image">
                                <span class="username"><a href="#">{{ $post->user->username }}</a></span>
                                <span class="description">Shared publicly - {{ $post->created_at }}</span>
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
                                <img class="img-fluid pad" src="{{ asset('images/upload/$post->post_image') }}"
                                    alt="Photo">
                            @elseif (isset($post->post_video))
                                <video controls class="video-fluid">
                                    <source src="{{ asset('videos/upload/$post->post_video') }}" type="video">
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
                                <i class="fas fa-comment-dots"></i> {{ $post->comments->count() }} Comments
                            </button>

                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i>
                                Share</button>
                        </div>

                        {{-- <!-- /.card-body -->
                        <div class="card-footer card-comments">
                            <div class="card-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        Maria Gonzales
                                        <span class="text-muted float-right">8:03 PM Today</span>
                                    </span><!-- /.username -->
                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.
                                </div>
                                <!-- /.comment-text -->
                            </div>
                            <!-- /.card-comment -->
                            <div class="card-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm" src="../dist/img/user5-128x128.jpg" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        Nora Havisham
                                        <span class="text-muted float-right">8:03 PM Today</span>
                                    </span><!-- /.username -->
                                    The point of using Lorem Ipsum is that it hrs a morer-less
                                    normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English.
                                </div>
                                <!-- /.comment-text -->
                            </div>
                            <!-- /.card-comment -->
                        </div>
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <form action="#" method="post">
                                <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="Press enter to post comment">
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer --> --}}
                    </div>
                    <!-- /.card -->
                @endforeach
            </div>

            <div class="col-md-4">
                <!-- Widget: Communities widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-success">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Top Communities</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav flex-column">
                            @foreach ($Communities as $Community)
                                <li class="nav-item">
                                    {{ $loop->index }}
                                    <a href="#" class="nav-link">
                                        <span><i class="far fa-arrow-alt-circle-up"></i></span>
                                        {{ $Community->Community_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-footer text-center">
                            <a href="{{ route('Communities.index') }}" class="btn rounded-pill btn-outline-primary btn-lg"
                                role="button" aria-pressed="true">View All</a>
                        </div>
                    </div>
                </div>

                <!-- Widget: Creation widget -->
                <div class="card card-widget widget-user-2">
                    <div class="card-footer text-center">
                        <a data-toggle="modal" data-target="createCommunity" class="btn rounded-pill btn-primary btn-lg"
                            role="button" aria-pressed="true">Create Community</a>
                        <a href="{{ route('Posts.create') }}" class="btn rounded-pill btn-outline-primary btn-lg"
                            role="button" aria-pressed="true">Create Post</a>
                    </div>
                </div>
                <!-- /.widget-Creation -->

                <!-- Widget: Posts widget -->
                <div class="card card-widget">
                    <div class="card-header">
                        Recent Posts
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            @foreach ($NewestPosts as $post)
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-danger"><i class="fas fa-link"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $post->post_title }}</span>
                                                <span class="info-box-number">{{ $post->comments->count() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
