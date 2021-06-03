<tr class="record">
    <td>{{ $training_feedback_participants_name}}</td>
    <td>{{ $training_feedback_total_score }}</td>
    <td>{{ $training_feedback_average_score}} </td> 
    <td>
        @if ($training_feedback_status_id < 3)
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        @endif
        @if ($training_feedback_status_id == 3)
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="{{ $detail_url }}"><i class="fa fa-info"></i> View</a>
            </div>
            <div class="btn-group hidden">
                <a class="btn btn-xs text-muted" href="javascript:void(0)" onclick="print_evaluation({{$record_id}})"><i class="fa fa-print"></i> {{ lang('common.print_only') }}</a>
            </div>            
        @endif        
        <!-- <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div> -->
    </td>
</tr>