@extends('layouts.app')
@section('style')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-overlay"
                        style="background: url({{ asset('img/5235.jpg') }}) no-repeat center;">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('img/teamwork.png') }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h2 class="widget-user-username">{{ $Community->commmunity_name }}</h2>
                        @if (Auth::check())
                            <a href="{{ route('Communities.join', ['community' => $Community->id]) }}"
                                class="btn btn-primary rounded-pill btn-lg">Join Community</a>
                        @endif
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle" src="{{ asset('img/user1-128x128.jpg') }}" alt="User Image">
                                <span class="username"><a href="">{{ $post->user->username }}</a></span>
                                <span class="description">Shared publicly -
                                    {{ $post->created_at->diffForHumans() }}</span>
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
                                    <source src="{{ asset('videos/upload/' . $post->post_video) }}" type="video">
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
                            <a href="{{ route('Posts.downVote', ['Post' => $post->id]) }}"
                                class="btn btn-sm btn-default">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                            </a>
                            <a href="{{ route('Posts.show', ['Post' => $post->id]) }}" class="btn btn-default">
                                <i class="fas fa-comment-dots"></i> {{ $post->comments->count() }} Comments
                            </a>
                        </div>
                    </div>
                    <!-- /.card -->
                @endforeach
            </div>

            <div class="col-md-4">
                <!-- Widget: Communities widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-primary">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">About Community</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="description-block">
                            <p class="description-text" style="margin: 5%">{{ $Community->description }}</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $Community->numberOfMembers }}</h5>
                                    <span class="description-text">Memebers</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $Community->community_privacy }}</h5>
                                    <span class="description-text">Privacy</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <br>
                        <div class="description-block">
                            <p class="description-header"><span><i class="fas fa-stopwatch"></i></span> Created At
                                {{ $Community->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('Posts.create') }}" class="btn rounded-pill btn-outline-primary btn-lg"
                                role="button" aria-pressed="true">Create Post</a>
                        </div>
                    </div>
                </div>

                <!-- Widget: Creation widget -->
                <div class="card card-widget widget-user-2">
                    <div class="card-footer text-center">
                        <button data-toggle="modal" data-target="#createCommunity"
                            class="btn rounded-pill btn-primary btn-lg" role="button" aria-pressed="true"
                            style="margin-bottom: 10px">Create Community</button>
                        <a href="{{ route('Posts.create') }}" class="btn rounded-pill btn-outline-primary btn-lg"
                            role="button" aria-pressed="true">Create Post</a>
                    </div>
                </div>
                <!-- /.widget-Creation -->

                <!-- Widget: Posts widget -->
                <div class="card card-widget">
                    <div class="card-header">
                        Community Tags
                    </div>
                    <div class="card-footer p-0">
                        @foreach ($tags as $tag)
                            <span style="margin: 5px">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
