@extends('layouts.manage')

@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">
                    <i class="fa fa-users"></i> Manage Users
                </h3>
                <div class="card-tools">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                        Add New <i class="fa fa-user-plus fa-fw"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-bodered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if (!Auth::user()->avatar == null)
                                        <img src="{{ Auth::user()->getMedia('avatars')->first()->getUrl('thumb') }}" alt="..." class="img-fluid" style="height: 30px; width: 30px;">
                                    @else
                                        <img src="{{ asset('images/avatar.png') }}" alt="..." class="img-fluid" style="height: 30px; width: 30px;">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td></td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>



                                        {{--<form id="delete-form-{{ $user->id }}" method="post" action="{{ route('users.destroy',$user->id) }}" style="display: none">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a href="" id="deleteUser" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>--}}

                                </td>
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('Are you sure?');",
                                        'route' => ['users.destroy', $user->id])) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('admin.includes.modals.add-user')
        @include('admin.includes.modals.edit-user')
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function deleteUser(id){

        }
    </script>
@endsection
