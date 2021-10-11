@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Communities ordered by number of members</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <tbody>
                                @foreach ($Communities as $community)
                                    <tr>
                                        <td>
                                            <h3 style="color: black">{{ $loop->index + 1 }}.</h3>
                                        </td>
                                        <td><a href="{{ route('Communities.show', ['Community' => $community->id]) }}">
                                                <h3 style="color: black">{{ $community->community_name }}</h3>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="float-right">
                                                <a class="btn btn-info btn-lg"
                                                    href="{{ route('Communities.join', ['community' => $community->id]) }}"><span><i
                                                            class="fa fa-plus"></i></span> Join Community</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $Communities->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
