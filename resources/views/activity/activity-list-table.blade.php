<thead>
<tr class="headings text-center">
    <th class="column-title"> Mã HĐ</th>
    <th class="column-title"> Tên Hoạt Động</th>
    <th class="column-title"> Thời Gian diễn ra</th>
    <th class="column-title"> Người Đứng Chính</th>
    <th class="column-title"> Cấp HĐ</th>
    <th class="column-title">Số lượng ĐK</th>
    <th class="column-title"> Action</th>
</tr>
</thead>
<tbody>
@php
    $currentDate = date('Y-m-d');
@endphp
@foreach($activityList as $activity)
<tr>
    <td class="center"> {{ $activity->id }} </td>
    <td> {{ $activity->name }} </td>
    <td class="center {{ ($currentDate > $activity->start_date) ? 'green' : 'blue'}}"> {{ $activity->start_date == $activity->end_date ? date('d/m/Y', strtotime($activity->start_date)) : date('d/m/Y', strtotime($activity->start_date)) . ' - ' . date('d/m/Y', strtotime($activity->end_date)) }}</td>
    <td> {{ $activity->Leader->id . ' - ' . $activity->Leader->name }} </td>
    <td class="center">
        @if($activity->activity_level == 0)
            <span class="label label-warning">Chi Đoàn</span>
        @elseif($activity->activity_level == 1)
            <span class="label label-info">Cấp Khoa</span>
        @else
            <span class="label label-primary">Cấp Trường</span>
        @endif
    </td>
    <td class="center">{{ $activity->Attenders()->count() }}</td>
    <td class="action-column center">
        <a class="detail-activity" data-id = "{{ $activity->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
        @if($user->level != 2)
        <a href="{{ route('get_edit_activity_route', ['id' => $activity->id]) }}"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
        <a href="#" class="delete-activity" data-id="{{ $activity->id }}"><i class="fa fa-trash" title="Xóa"></i></a>
        @endif
    </td>
</tr>
@endforeach
</tbody>
