@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="/user-management/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="../assets/img/blank-profile-picture.svg" class="avatar avatar-sm rounded-circle me-2">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($user->is_active == '1')
                                        <span class="badge badge-sm bg-gradient-success">ACTIVE</span>
                                        @elseif ($user->is_active == '0')
                                        <span class="badge badge-sm bg-gradient-danger">INACTIVE</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                    </td>
                                    <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="me-3">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                        </div>
                                        <div class="me-3">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                    <i class="fas fa-trash text-secondary"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <form action="{{ route('user.status', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if ($user->is_active == 1)
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Change status">
                                                    <i class="fas fa-toggle-on text-secondary"></i>
                                                </button>
                                                @elseif ($user->is_active == 0)
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Change status">
                                                    <i class="fas fa-toggle-off text-secondary"></i>
                                                </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-center">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
