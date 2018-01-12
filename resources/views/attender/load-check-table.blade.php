<thead>
    <tr class="headings text-center">
        <th>MSSV</th>
        <th>Họ tên</th>
        <th>Số lần check</th>
    </tr>
</thead>
<tbody>
    @foreach($checkList as $check)
    <tr id="row-{{ $check->student_id }}">
        <td class="text-center">{{ $check->student_id }}</td>
        <td>{{ $check->Student->name }}</td>
        <td class="text-center">{{ $check->number }}</td>
    </tr>
    @endforeach
</tbody>
