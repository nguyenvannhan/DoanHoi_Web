<thead>
    <tr class="headings text-center">
        <th class="column-title"> MSSV </th>
        <th class="column-title"> Họ tên </th>
        <th class="column-title"> Giới tính </th>
        <th class="column-title"> Ngày tháng năm sinh </th>
        <th class="column-title"> Lớp </th>
        <th class="column-title"> Đoàn viên </th>
        <th class="column-title"> Tình trạng </th>
        <th class="column-title"> Action </th>
        <th class="bulk-actions" colspan="8">
            <a class="antoo" style="color:#fff; font-weight:500;"><span class="action-cnt"> </span></a>
        </th>
    </tr>
</thead>
<tbody>
@foreach($studentList as $student)
    <tr>
        <td class="center"> {{ $student->id }} </td>
        <td> {{ $student->name }} </td>
        <td class="center">
            @php

                if( $student->is_female ==0)
                    $gt='Nam';
                else
                    $gt='Nữ';
            @endphp
            {{ $gt }}
        </td>
        <td class="center"> {{ date('d/m/Y', strtotime($student->birthday)) }} </td>
        <td class="center"> {{ $student->ClassOb->name }} </td>
        <td class="center">
            <i class="fa {{ $student->is_cyu == 1 ? 'fa-check-square' : 'fa-square-o' }} green"></i>
        </td>
        <td class="center">
            <span class="label label-success">
            @php

                if( $student->status ==1) {
                    $t='Đang học';
                }
                else { if( $student->status ==2){
                            $t='Đã tốt nghiệp';
                        }
                        else { if( $student->status ==3){
                                    $t='Đang bảo lưu';
                                }
                                else{
                                    $t='Bị đuổi học';
                                }
                            }
                    }
            @endphp
            {{$t}}  </span>
        </td>
        <td class="action-column center">
            <a href="#profile" class="info_student" data-toggle="modal" data-id="{{ $student->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
            <a href="{{ route('get_edit_student_route',['id'=> $student->id]) }}" ><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
            <a class="delete-student" data-id="{{ $student->id }}" href="javascript:;"><i class="fa fa-trash" title="Xóa"></i></a>
        </td>
    </tr>
@endforeach
</tbody>
