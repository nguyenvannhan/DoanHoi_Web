<thead>
    <tr class="headings text-center">
        <th>STT</th>
        <th>MSSV</th>
        <th>Họ tên</th>
        <th>Thời gian ĐK</th>
        <th>Điểm danh</th>
        <th>ĐRL</th>
        <th>CTXH</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @php
    $stt = 1;
    @endphp
    @foreach($attenderList as $attender)
    <tr>
        <td class="center">{{ $stt++ }}</td>
        <td class="center">{{ $attender->Student->id }}</td>
        <td>{{ $attender->Student->name }}</td>
        <td class="center">{{ $attender->time_id }}</td>
        <td class="center">
            @if($attender->check)
            <i class="fa fa-check-circle green"></i>
            @else
            <i class="fa fa-times-circle red"></i>
            @endif
        </td>
        <td class="center {{ $attender->minus_conduct_mark > 0 ? 'red' : '' }}">
            @if($attender->minus_conduct_mark == 0)
            {{ $attender->conduct_mark }}
            @else
            {{ '-'.$attender->minus_conduct_mark }}
            @endif
        </td>
        <td class="center {{ $attender->minus_social_mark > 0 ? 'red' : '' }}">
            @if($attender->minus_social_mark == 0)
            {{ $attender->social_mark }}
            @else
            {{ '-'.$attender->minus_social_mark }}
            @endif
        </td>
        <td class="center">
            <a class="delete-attender red"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
