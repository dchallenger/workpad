<div class="form-group">
	<?php
		switch ($key->key_code) {
			case 'phone':
				$key->key_label = 'Office Phone';
				break;
			case 'mobile':
				$key->key_label = 'Office Mobile';
				break;
			case 'email':
				$key->key_label = 'Office Email';
				break;
			case 'personal_phone':
				$key->key_label = 'Personal Phone';
				break;
			case 'personal_mobile':
				$key->key_label = 'Personal Mobile';
				break;
			case 'personal_email':
				$key->key_label = 'Personal Email';
				break;					
		}
	?>	
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-7">
    	<input type="text" class="form-control" name="key[<?php echo $key->key_class_id?>][<?php echo $key->key_id?>]" placeholder="Enter <?php echo $key->key_label?>" value="<?php echo $value?>">
    </div>
</div>