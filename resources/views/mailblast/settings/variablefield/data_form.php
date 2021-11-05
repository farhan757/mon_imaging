<tr id="row<?php echo $no; ?>">
	<td><input type="text" name="nm_variable[]" class="form-control" /></td>
	<td>
		<select name="nm_field[]" id="nm_field" class="form-control">
			<?php foreach($field as $val) { ?>
			<option value="<?php echo $val; ?>" 
				<?php if(isset($data->nm_field)){ ?>
					<?php if($val == $data->nm_field) { ?>
						selected
					<?php } ?>
				<?php } ?>
				><?php echo $val; ?></option>
			<?php } ?>
		</select>
	</td>
	<td><a href="#" class="btn btn-danger hapus-baris" id="<?php echo $no; ?>"><i class="fa fa-trash"></i></a></td>
</tr>

<script type="text/javascript">
	jQuery('.datepicker').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true
	});

	$('.hapus-baris').on("click", function() {
		id = this.id;

		$('#row' + id).remove();
	});
</script>