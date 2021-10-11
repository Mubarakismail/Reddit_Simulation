@extends('layouts.app')

@section('style')

@endsection

@section('content-header')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Box Comment -->
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="{{ asset('images/upload/' . $post->user->profile_photo) }}"
                                alt="User Image">
                            <span class="username"><a
                                    href="{{ route('Users.show', ['User' => $post->user->id]) }}">{{ $post->user->username }}</a></span>
                            <span class="description">Shared publicly - {{ $post->created_at->diffForHumans() }}</span>
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

                        @if (isset($post->post_photo))
                            <img class="img-fluid pad" src="{{ asset('images/upload/' . $post->post_photo) }}"
                                alt="Photo">
                        @elseif (isset($post->post_video))
                            <video controls class="video-fluid">
                                <source src="{{ asset('images/upload/' . $post->post_video) }}" type="video">
                            </video>
                        @endif
                        <!-- /.attachment-block -->

                        <!-- Social sharing buttons -->
                        <a href="{{ route('Posts.upVote', ['Post' => $post->id]) }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-alt-circle-up"></i>
                        </a>
                        <span>
                            @if ($post->votes->count() > 0)
                                {{ $post->votes->count() }}
                            @endif
                            Vote
                        </span>
                        <a href="{{ route('Posts.downVote', ['Post' => $post->id]) }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-alt-circle-down"></i>
                        </a>
                        <a href="{{ route('Posts.show', ['Post' => $post->id]) }}" class="btn btn-default">
                            <i class="fas fa-comment-dots"></i> {{ $post->comments->count() }} Comments
                        </a>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer card-comments">
                        @foreach ($comments as $comment)
                            <div class="card-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm"
                                    src="{{ asset('images/upload/' . $comment->user->profile_photo) }}" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        {{ $comment->user->username }}
                                        <span
                                            class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </span><!-- /.username -->
                                    {{ $comment->comment_body }}
                                </div>
                                <!-- /.comment-text -->
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <form action="{{ route('Comments.store') }}" method="POST">
                            @csrf
                            <img class="img-fluid img-circle img-sm"
                                src="{{ asset('images/upload/' . $post->user->profile_photo) }}" alt="Alt Text">
                            <div class="img-push">
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Press enter to post comment" name="comment_body">
                                <input type="hidden" class="form-control" value="{{ $post->id }}" name="post_id">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-4">
                <!-- Widget: Communities widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-success">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Related Communities</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav flex-column">
                            @foreach ($Communities as $Community)
                                <li class="nav-item">
                                    <a href="{{ route('Communities', ['Community' => $Community->id]) }}"
                                        class="nav-link">
                                        {{ $loop->index }}
                                        <span><i class="far fa-arrow-alt-circle-up"></i></span>
                                        {{ $Community->Community_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-footer text-center">
                            <a href="{{ route('Communities.index') }}"
                                class="btn rounded-pill btn-outline-primary btn-lg" role="button" aria-pressed="true">View
                                All</a>
                        </div>
                    </div>
                </div>

                <!-- Widget: Creation widget -->
                <div class="card card-widget widget-user-2">
                    <div class="card-footer text-center">
                        <a data-toggle="modal" data-target="#createCommunity" class="btn rounded-pill btn-primary btn-lg"
                            role="button" aria-pressed="true" style="margin-bottom: 10px">Create Community</a>
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
