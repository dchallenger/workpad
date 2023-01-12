<?php
    //debug($financial_metric_planning_finance);
?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="8" class="bold">FINANCIAL TARGETS</th>
            </tr>
            <tr>
                <th class="text-center">SBU</th>
                <th class="text-center">Item</th>
                <th class="text-center">%</th>
                <th class="text-center">Target</th>
                <th class="text-center">Rating Comp</th>
                <th class="text-center">Actual</th>
                <th class="text-center">Rating (%)</th>
                <th class="text-center">Allocation (%)</th>
                <th class="text-center">Weighted  Rating (%)</th>
            </tr>
        </thead>
        <tbody>
            @if(count($financial_metric_planning_applicable) > 0)
                <?php $total_weighted_rating_employee = 0; ?>
                @foreach($financial_metric_planning_applicable as $financial)
                    <?php
                        $total_weighted_rating_employee += $financial->weighted_rating;
                    ?>
                    <tr>
                        <td><input class="form-control text-right" type="hidden" name="field_appraisal_financial[{{ $appraisee_user_id }}][sbu_unit][]" value="{{$financial->sbu_unit}}">{{$financial->sbu_unit}}</td>
                        <td><input class="form-control text-right" type="hidden" name="field_appraisal_financial[{{ $appraisee_user_id }}][financial_metric_kpi][]" value="{{$financial->financial_metric_kpi}}">{{$financial->financial_metric_kpi}}</td>
                        <td><input class="form-control text-right" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][weight][]" value="{{$financial->weight}}"></td>
                        <td><input class="form-control text-right" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][target][]" value="{{$financial->value}}"></td>
                        <td>
                            <input class="form-control" type="hidden" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][rating_comp][]" value="{{$financial->rating_comp}}">
                            <input class="form-control" type="text" readonly name="" value="{{($financial->rating_comp == 1 ? 'Actual/Target' : 'Target/Actual')}}">
                        </td>
                        <td><input class="form-control text-right actual" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][actual][]" value="{{$financial->actual}}"></td>
                        <td><input class="form-control text-right" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][rating][]" value="{{$financial->rating}}"></td>
                        <td><input class="form-control text-right" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][allocation][]" value="{{$financial->allocation}}"></td>
                        <td><input class="form-control text-right" type="text" readonly name="field_appraisal_financial[{{ $appraisee_user_id }}][weighted_rating][]" value="{{$financial->weighted_rating}}"></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" class="bold">Total</td>
                    <td classs="bold"><input class="form-control text-right" type="text" readonly name="" value="{{number_format($total_weighted_rating_employee, 4, '.', ',')}}"></td>
                </tr>
                <tr>
                    <td colspan="8" class="bold">Weighted Rating</td>
                    <td classs="bold"><input class="form-control text-right self_weight_average" ratio-weight="{{ $section_info->weight }}" section-id="{{ $section_info->template_section_id }}" question="1" type="text" readonly name="" value="{{number_format(($total_weighted_rating_employee * $key_in_weight_ave / 100), 4, '.', ',')}}"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>