@extends('layouts.client.main-account')

@section('title')
    Tổng quan về tài khoản
@endsection

@section('content')
    <h2>Tổng quan về Tài Khoản</h2>
    <h4>Hồ sơ</h4>
    <hr>
    <div class="table-account">
        <table width="100%">
            <tbody>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <p class="text-dark">{{Auth::user()->email}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Ngày sinh</label>
                </td>
                <td>
                    @if(Auth::user()->birthday == null)
                        <a href="{{route('user-edit-profile')}}" class="text-primary">Thêm ngày sinh</a>
                    @else
                        <p class="text-dark">{{date('d-m-Y', strtotime(Auth::user()->birthday))}}</p>
                    @endif

                </td>
            </tr>
            <tr>
                <td>
                    <label>Giới tính</label>
                </td>
                <td>
                    @if(Auth::user()->gender == 0)
                        <p class="text-dark">Nam</p>
                    @else
                        <p class="text-dark">Nữ</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <label>Họ và tên</label>
                </td>
                <td>
                    <p class="text-dark">{{Auth::user()->full_name}}</p>
                </td>
            </tr>
            </tbody>
        </table>
        <a href="{{route('user-edit-profile')}}" class="btn btn-dark btn-md">SỬA HỒ SƠ</a>
    </div>
@endsection
