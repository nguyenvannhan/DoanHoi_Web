<thead>
    <tr class="headings text-center">
        <th class="column-title"> MSSV </th>
        <th class="column-title"> Họ tên </th>
        <th class="column-title"> Giới tính </th>
        @if($type_id == 1)
        <th class="column-title"> Năm sinh </th>
        @endif
        <th class="column-title"> Khóa </th>
        @if($type_id == 1)
        <th class="column-title"> Lớp </th>
        <th class="column-title"> Đoàn viên </th>
        <th class="column-title"> Tình trạng </th>
        @else
        <th class="column-title"> Khoa </th>
        @endif
        <th class="column-title"> Action </th>
    </tr>
</thead>
<tbody>
    @foreach($studentList as $studentOb)
    <tr>
        <td class="center"> {{ $studentOb->id }} </td>
        <td> {{ $studentOb->name }} </td>
        <td class="center">
            @php

            if( $studentOb->is_female ==0) {
                $gt='Nam';
            } else {
                $gt='Nữ';
            }
            @endphp
            {{ $gt }}
        </td>
        @if($type_id == 1)
        <td class="center"> {{ date('d/m/Y', strtotime($studentOb->birthday)) }} </td>
        @endif
        <td class="center"> {{ $studentOb->Science->name }} </td>
        @if($type_id == 1)
        <td class="center"> {{ $studentOb->ClassOb->name }} </td>
        <td class="center">
            <i class="fa {{ $studentOb->is_cyu == 1 ? 'fa-check-square' : 'fa-square-o' }} green"></i>
        </td>
        <td class="center">
            @if($studentOb->status == 1)
            <span class="label label-primary">Đang học</span>
            @elseif($studentOb->status == 2)
            <span class="label label-success">Đã tốt nghiệp</span>
            @elseif($studentOb->status == 3)
            <span class="label label-warning">Đang bảo lưu</span>
            @else
            <span class="label label-danger">Bị đuổi học</span>
            @endif
        </td>
        @else
        <td class="center">{{ $studentOb->Faculty->name }}</td>
        @endif
        <td class="action-column center">
            <a href="#profile" class="info_student" data-toggle="modal" data-id="{{ $studentOb->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
            <a href="{{ route('get_edit_student_route',['id'=> $studentOb->id]) }}" ><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
            <a class="delete-student" data-id="{{ $studentOb->id }}" href="javascript:;"><i class="fa fa-trash" title="Xóa"></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
