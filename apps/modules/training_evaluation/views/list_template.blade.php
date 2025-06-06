<tr class="record">
    <td>
        <div>
            <input type="checkbox" class="record-checker checkboxes" value="<?php echo $record_id; ?>" />
        </div>
    </td>
    <td>{{ $training_course}} </td>
    <td>{{ $training_subject}}</td>
    <td>{{ general_date($start_date) }} </td>
    <td>{{ general_date($end_date)}}</td>
    <td>{{ general_time($sessiontime_from) }} @if(general_time($sessiontime_from) != '') - @endif {{ general_time($sessiontime_to) }}</td>
    <td>{{ $instructor}}</td>
    <td>
         <a class="btn btn-xs text-muted feedback_participants" href="#" id="feedback_participants" calendar_id="<?php echo $record_id; ?>"><i class="fa fa-info"></i> Evaluate</a>
    </td>
</tr>

<script type="text/javascript">
$(document).ready(function(){
    $(".feedback_participants").on('click', function() {
        var calendar_id = $(this).attr('calendar_id');
        document.location = 'training_feedback_participants/feedback_list/'+calendar_id;
    });
});
</script>