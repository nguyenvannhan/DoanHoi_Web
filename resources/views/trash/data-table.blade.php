 @if($type_id == 1)
<thead>
    <tr class="headings text-center">
        <th class="column-title"> MSSV </th>
        <th class="column-title"> Họ tên </th>
        <th class="column-title"> Lớp </th>
        <th class="column-title"> Khóa </th>
        <th class="column-title"> Action </th>
    </tr>
</thead>
<tbody>
    @foreach($studentList as $student)
    <tr>
        <td class="text-center">{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td class="text-center">{{ $student->ClassOb->name }}</td>
        <td class="text-center">{{ $student->Science->name }}</td>
        <td class="text-center">
            <a href="javascript:;" class="restore" style="border-radius: 0; border: 1px solid blue; padding: 5px 10px; color: blue;" data-id="{{ $student->id }}">Restore</a>
            <a href="javascript:;" class="permantly" style="border-radius: 0; border: 1px solid red; padding: 5px 10px; color: red;" data-id="{{ $student->id }}">Permantly Delete</a>
        </td>
    </tr>
    @endforeach
</tbody>
@elseif($type_id == 2)
<thead>
    <tr class="headings text-center">
        <th class="column-title"> Mã HĐ </th>
        <th class="column-title"> Tên Hoạt động </th>
        <th class="column-title"> Năm học </th>
        <th class="column-title"> Leader </th>
        <th class="column-title"> Cấp </th>
        <th class="column-title"> Lớp </th>
        <th class="column-title"> SL Đăng ký </th>
        <th class="column-title"> Action </th>
    </tr>
</thead>
<tbody>
    @foreach($activityLitst as $activity)
    <tr>
        <td class="text-center">{{ $activity->id }}</td>
        <td>{{ $activity->name }}</td>
        <td class="text-center">{{ $activity->SchoolYear->name }}</td>
        <td class="text-center">{{ $activity->Leader->name }}</td>
        <td class="text-center">
            @if($activity->activity_level == 0)
            <span class="label label-warning">Chi Đoàn</span> 
            @elseif($activity->activity_level == 1)
            <span class="label label-info">Cấp Khoa</span> 
            @else
            <span class="label label-primary">Cấp Trường</span> 
            @endif
        </td>
        <td class="text-center">{{ $activity->ClassOb != null ? $activity->ClassOb->name : '' }}</td>
        <td class="text-center">{{ $activity->Attender()->count() }}</td>
        <td class="text-center">
            <a href="javascript:;" class="restore" style="border-radius: 0; border: 1px solid blue; padding: 5px 10px; color: blue;" data-id="{{ $activity->id }}">Restore</a>
            <a href="javascript:;" class="permantly" style="border-radius: 0; border: 1px solid red; padding: 5px 10px; color: red;" data-id="{{ $activity->id }}">Permantly Delete</a>
        </td>
    </tr>
    @endforeach
</tbody>
@else
<thead>
        <tr class="headings text-center">
            <th class="column-title"> Mã Lớp </th>
            <th class="column-title"> Tên Lớp </th>
            <th class="column-title"> Khóa </th>
            <th class="column-title"> SL Sinh viên</th>
            <th class="column-title"> Action </th>
        </tr>
    </thead>
    <tbody>
        @foreach($classList as $classOb)
        <tr>
            <td class="text-center">{{ $classOb->id }}</td>
            <td class="text-center">{{ $classOb->name }}</td>
            <td class="text-center">{{ $classOb->Science->name }}</td>
            <td class="text-center">{{ count($classOb->Students()) }}</td>
            <td class="text-center">
                    <a href="javascript:;" class="restore" style="border-radius: 0; border: 1px solid blue; padding: 5px 10px; color: blue;" data-id="{{ $classOb->id }}">Restore</a>
                    <a href="javascript:;" class="permantly" style="border-radius: 0; border: 1px solid red; padding: 5px 10px; color: red;" data-id="{{ $classOb->id }}">Permantly Delete</a>
                </td>
        </tr>
        @endforeach
    </tbody>
@endif