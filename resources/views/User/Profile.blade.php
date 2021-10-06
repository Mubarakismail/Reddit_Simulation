@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings"
                                    data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#privacy"
                                    data-toggle="tab">Privacy</a></li>
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
                                                    src="{{ asset('images/upload/' . $post->post_image) }}" alt="Photo">
                                            @elseif (isset($post->post_video))
                                                <video controls class="video-fluid">
                                                    <source src="{{ asset('images/upload/' . $post->post_video) }}"
                                                        type="video">
                                                </video>
                                            @endif
                                            <!-- /.attachment-block -->

                                            <!-- Social sharing buttons -->

                                            <a href="{{ route('Posts.upVote', ['Post' => $post->id]) }}"
                                                class="btn btn-sm btn-default">
                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                            </a>
                                            <span>
                                                @if ($post->rating > 0)
                                                    {{ $post->rating }}
                                                @endif
                                                Vote
                                            </span>
                                            <a href="{{ route('Posts.downVote', ['Post' => $post->id]) }}"
                                                class="btn btn-sm btn-default">
                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                            </a>
                                            <a href="{{ route('Posts.show', ['Post' => $post->id]) }}"
                                                class="btn btn-default">
                                                <i class="fas fa-comment-dots"></i> {{ $post->comments->count() }}
                                                Comments
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                @endforeach
                            </div>

                            <div class="tab-pane" id="settings">
                                <form action="{{ route('Users.update', ['User' => Auth::user()->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-6 col-form-label">Username</label>
                                        <label for="inputEmail" class="col-sm-6 col-form-label">Email</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" name="username" class="form-control" placeholder="Userame"
                                                value="{{ isset($user) ? $user->username : '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                                                name="email" value="{{ isset($user) ? $user->email : '' }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-6 col-form-label">First Name</label>
                                        <label for="inputName" class="col-sm-6 col-form-label">Last Name</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="First Name"
                                                value="{{ isset($user) ? $user->first_name : '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="Last Name"
                                                value="{{ isset($user) ? $user->last_name : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-6 col-form-label">Phone Number</label>
                                        <label class="col-sm-6 col-md-6 col-form-label">Gender</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Phone Number" name="phone_number"
                                                class="form-control"
                                                value="{{ isset($user) ? $user->phone_number : '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="exampleFormControlSelect1" name="gender">
                                                <option selected value="Not Known">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-6 col-form-label">Birthday</label>
                                        <label class="col-sm-6 col-md-6 col-form-label">Address</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="datetime-local" name="birth_date" class="form-control"
                                                value="{{ isset($user) ? $user->birth_date : '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Address" name="address" class="form-control"
                                                value="{{ isset($user) ? $user->address : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-6 col-form-label">Password</label>
                                        <label class="col-sm-6 col-md-6 col-form-label">Education</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="password" placeholder="Password" name="password"
                                                class="form-control" value="{{ isset($user) ? $user->password : '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Education" name="education"
                                                class="form-control"
                                                value="{{ isset($user) ? $user->education : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bio</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" placeholder="Bio"
                                                name="bio">{{ isset($user) ? $user->bio : '' }} </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Profile Photo:</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="profile_photo"
                                                placeholder="Photo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-success" style="margin-right: 20px">Update
                                            Info</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="privacy">
                                <form action="{{ route('Users.destroy', ['User' => Auth::user()->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" rel="tooltip" title="" class="btn btn-danger">
                                        Delete Account
                                    </button>
                                </form>
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
                                src="{{ asset('images/upload/' . $user->profile_photo) }}" alt="User profile picture">
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
