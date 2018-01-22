<thead>
    <tr class="headings text-center">
        <th>STT</th>
        <th>MSSV</th>
        <th>Họ tên</th>
        <th>Thời gian ĐK</th>
        <th>Điểm danh</th>
        <th>ĐRL</th>
        <th>CTXH</th>
        @if($user->level != 2)
        <th>Action</th>
        @endif
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
            @if($user->level != 2)
            @if($attender->check)
            <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-check-circle green"></i></a>
            @else
            <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-times-circle red"></i></a>
            @endif
            @else
            @if($attender->check)
            <i class="fa fa-check-circle green"></i>
            @else
            <i class="fa fa-times-circle red"></i>
            @endif
            @endif
        </td>
        <td class="center {{ $attender->minus_conduct_mark > 0 ? 'red' : '' }}">
            @if($user->level != 2)
            @if($attender->minus_conduct_mark == 0)
            <input type="text" class="form-control mark" data-mark="{{ $attender->conduct_mark }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ $attender->conduct_mark }}">
            @else
            <input type="text" class="form-control mark red" data-mark="{{ $attender->minus_conduct_mark > 0 ? '-'.$attender->minus_conduct_mark : '0' }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ $attender->minus_conduct_mark > 0 ? '-'.$attender->minus_conduct_mark : '0' }}">
            @endif
            @else
            @if($attender->minus_conduct_mark == 0)
            <span>{{ $attender->conduct_mark }}</span>
            @else
            <span>{{ '-'.$attender->minus_conduct_mark }}</span>
            @endif
            @endif
        </td>
        <td class="center {{ $attender->minus_social_mark > 0 ? 'red' : '' }}">
            @if($user->level != 2)
            @if($attender->minus_social_mark == 0)
            <input class="form-control mark" data-mark="{{ $attender->social_mark }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ $attender->social_mark }}">
            @else
            <input class="form-control mark red" data-mark="{{ $attender->minus_social_mark > 0 ? '-'.$attender->minus_social_mark : '0' }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ $attender->minus_social_mark > 0 ? '-'.$attender->minus_social_mark : '0' }}">
            @endif
            @else
            @if($attender->minus_conduct_mark == 0)
            <span>{{ $attender->social_mark }}</span>
            @else
            <span>{{ '-'.$attender->minus_social_mark }}</span>
            @endif
            @endif
        </td>
        @if($user->level != 2)
        <td class="center">
            <a class="update-attender update-attender-{{ $attender->id }} blue hidden" data-id="{{ $attender->id }}"><i class="fa fa-floppy-o"></i></a>
            <a class="delete-attender red" data-id="{{ $attender->id }}"><i class="fa fa-trash"></i></a>
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
