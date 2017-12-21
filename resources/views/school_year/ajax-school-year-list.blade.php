<thead>
    <tr class="headings">
        <th class="column-title center"> STT </th>
        <th class="column-title center"> Năm học </th>
        <th class="column-title center"> Action </th>
    </tr>
</thead>
<tbody>
@php
    $i=1;
@endphp
@foreach ($school_year_list as $school_year)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $school_year->name }}</td>
        <td class="action-column">
            <a href="#"> Xem danh sách hoạt động năm học {{ $school_year->name }}</a>
        </td>
    </tr>
@endforeach
</tbody>
