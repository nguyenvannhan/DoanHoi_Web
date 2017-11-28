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
    <tr id="attender-{{ $attender->id }}">
        <td class="center">{{ $stt++ }}</td>
        <td class="center">{{ $attender->Student->id }}</td>
        <td>{{ $attender->Student->name }}</td>
        <td class="center">{{ $attender->time_id }}</td>
        <td class="center">
            @if($attender->check)
            <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-check-circle green"></i></a>
            @else
            <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-times-circle red"></i></a>
            @endif
        </td>
        <td class="center {{ $attender->minus_conduct_mark > 0 ? 'red' : '' }}">
            @if($attender->minus_conduct_mark == 0)
            <input type="text" class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ $attender->conduct_mark }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ $attender->conduct_mark }}">
            @else
            <input type="text" class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ '-'.$attender->conduct_mark }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ '-'.$attender->conduct_mark }}">
            @endif
        </td>
        <td class="center {{ $attender->minus_social_mark > 0 ? 'red' : '' }}">
            @if($attender->minus_social_mark == 0)
            <input class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ $attender->social_mark }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ $attender->social_mark }}">
            @else
            <input class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ '-'.$attender->social_mark }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ '-'.$attender->minus_social_mark }}">
            @endif
        </td>
        <td class="center">
            <a class="update-attender blue hidden" data-id="{{ $attender->id }}"><i class="fa fa-floppy-o"></i></a>
            <a class="delete-attender red"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
