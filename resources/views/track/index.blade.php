@extends('master')

@section('title_site', "Thùng Rác | IT CYU HCMUTE")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">USER'S ACTIVITIES TRACK</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-bordered table-striped jambo_table datatable">
                    <thead>
                        <tr class="headings text-center">
                            <th class="column-title"> MSSV </th>
                            <th class="column-title"> Name </th>
                            <th class="column-title"> Action </th>
                            <th class="column-title"> Old Data </th>
                            <th class="column-title"> New Data </th>
                            <th class="column-title"> Time </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($items as $item)
                        @php
                        if($userName == 'Admin' && $item->student_name == 'admin') {
                            $style = "color: #0800ff;";
                            $name = 'Me';
                            $id = '';
                        } else {
                            $style = '';
                            $name = $item->student_name;
                            $id = $item->student_id;
                        }
                        @endphp
                        <tr style="{{ $style }}">
                            <td class="text-center">{{ $id }}</td>
                            <td>{{ $name }}</td>
                            <td>{{ $item->action }}</td>
                            <td>{!! $item->old_data !!}</td>
                            <td>{!! $item->new_data !!}</td>
                            <td class="text-center">{{ $item->time_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
