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
                <th class="text-center">Rating</th>
                <th class="text-center">Weighted  Rating</th>
            </tr>
        </thead>
        <tbody>
            @if(count($financial_metric_planning_applicable) > 0)
                <?php $total_weighted_rating_employee = 0; ?>
                @foreach($financial_metric_planning_applicable as $sbu => $financial)
                    <?php
                        $total_weighted_rating_finance = 0;
                    ?>
                    @foreach($financial as $key => $val)
                        <?php
                            $actual = '';
                            $rating = '';
                            $weighted_rating_finance = '';
                            $allocation = '';
                            $weighted_rating_employee = '';
                            if (isset($appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']])) {
                                $actual = $appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']]['actual'];
                                $rating = $appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']]['rating'];
                                $weighted_rating_finance = $appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']]['weighted_rating_finance'];
                                $allocation = $appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']]['allocation'];
                                $weighted_rating_employee = $appraisal_applicable_financial_fields[$val['planning_applicable_financial_finance_id']]['weighted_rating_employee'];
                                $total_weighted_rating_finance += currency_format($weighted_rating_finance);
                                $total_weighted_rating_employee += $weighted_rating_employee;
                            }
                        ?>
                        <tr>
                            <td>{{$sbu}}</td>
                            <td>{{$val['item']}}</td>
                            <td><input class="form-control" type="text" readonly name="" value="{{$val['weight']}}"></td>
                            <td><input class="form-control" type="text" readonly name="" value="{{$val['target']}}"></td>
                            <td><input class="form-control" type="text" readonly name="" value="{{($val['rating_comp'] == 1 ? 'Actual/Target' : 'Target/Actual')}}"></td>
                            <td><input class="form-control" type="text" readonly name="" value="{{$actual}}"></td>
                            <td><input class="form-control" type="text" readonly name="" value="{{$rating}}"></td>
                            <td><input class="form-control" type="text" readonly name="" value="{{$weighted_rating_finance}}"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="bold">{{$sbu}}</td>
                        <td>&nbsp;</td>
                        <td class="bold" align="right">100</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="bold total_weighted_rating_finance" align="right">{{number_format($total_weighted_rating_finance, 4, '.', ',')}}</td>
                    </tr>
                @endforeach
                <input class="form-control text-right self_weight_average" ratio-weight="{{ $section_info->weight }}" section-id="{{ $section_info->template_section_id }}" question="1" type="hidden" readonly name="" value="{{number_format(($total_weighted_rating_employee * $key_in_weight_ave / 100), 4, '.', ',')}}">
            @endif
        </tbody>
    </table>
</div>