<thead>
<tr>
    <?php
        if($data['other_remarks'] == 1){
    ?>
        <th class="text-center success">&nbsp;</th>
        <th class="text-center success"><?php echo $data['header_text'] ?></th>
        <th class="text-center success">HR Remarks</th>
    <?php       
        }else{
    ?>
        <th class="text-center success">&nbsp;</th>
        <th class="text-center success"><?php echo $data['header_text'] ?></th>
        <th class="text-center success">Remarks</th>
    <?php       
        }
    ?>
</tr>
</thead>