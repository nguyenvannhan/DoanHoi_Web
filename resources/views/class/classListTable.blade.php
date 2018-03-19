<thead>
<tr class="headings text-center">
    <th class="column-title"> STT</th>
    <th class="column-title"> Tên Lớp Học</th>
    <th class="column-title"> Khóa Học</th>
    <th class="column-title"> Action</th>
</tr>
</thead>
<tbody>
@php
    $i=1
@endphp
@foreach($classList as $classOb)
    <tr>
        <td>
            {{ $i++ }}
        </td>
        <td>{{ $classOb->name }}</td>
        <td>{{ $classOb->Science->name }}</td>
        <td class="action-column">
            <a class="edit-class-button" data-id="{{ $classOb->id }}"><i class="fa fa-edit"
                                                                         title="Chỉnh sửa"></i></a>
            <a class="delete-class-button" data-id="{{ $classOb->id }}" href="javascript:;"><i
                        class="fa fa-trash" title="Xóa"></i></a>

        </td>
    </tr>
@endforeach
</tbody>
