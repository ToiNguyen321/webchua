<script type="text/javascript">
	(function($)
	{
		$(document).ready(function()
		{
			var main = $('#form');

		// Tabs
		main.contentTabs();
	});
	})(jQuery);
</script>

<?php $this->load->view('admin/chua/head', $this->data); ?>
<div class="line"></div>
<div class="wrapper">

	<!-- Form -->
	<?php if (!empty($chua)): ?>
		
	
	<form class="form" id="form" action="<?php echo admin_url('chua/edit/') . $chua->id ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin');?>/images/icons/dark/add.png" class="titleIcon">
					<h6>Cập nhật chùa</h6>
				</div>

				<ul class="tabs">
					<li><a href="#tab1">Thông tin chung</a></li>
					<li><a href="#tab3">Bài viết</a></li>
				</ul>

				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="ten" value="<?php echo $chua->ten; ?>" id="param_ten" _autocheck="true" type="text"></span>
								<span name="ten_autocheck" class="autocheck"></span>
								<div name="ten_error" class="clear error"><?php echo form_error('ten') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<label class="formLeft" for="param_sale">Tiêu đề:<span class="req"></span>*</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="tieu_de" id="param_tieu_de" rows="4" cols=""><?php echo $chua->tieu_de; ?></textarea></span>
								<span name="tieu_de_autocheck" class="autocheck"></span>
								<div name="tieu_de_error" class="clear error"><?php echo form_error('tieu_de'); ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_nguoi_chu_tri">Người chủ trì:<span class="req"></span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="nguoi_chu_tri" value="<?php echo $chua->nguoi_chu_tri; ?>" id="param_nguoi_chu_tri" _autocheck="true" type="text"></span>
								<span name="nguoi_chu_tri_autocheck" class="autocheck"></span>
								<div name="nguoi_chu_tri_error" class="clear error"><?php echo form_error('nguoi_chu_tri') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_nam_xay_dung">Năm xây dựng:<span class="req"></span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="nam_xay_dung" value="<?php echo $chua->nam_xay_dung; ?>" id="param_nam_xay_dung" _autocheck="true" type="date"></span>
								<span name="nam_xay_dung_autocheck" class="autocheck"></span>
								<div name="nam_xay_dung_error" class="clear error"><?php echo form_error('nam_xay_dung') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Hình ảnh:</label>
							<div class="formRight">
								<div class="left"><input type="file" value="<?php echo $chua->anh; ?>" id="param_anh" name="anh"></div>
								<img src="<?php echo base_url('upload/chua/'.$chua->anh); ?>" style="width: 100px; height: 70px; margin-left: 20px;">
								<div name="anh_error" class="clear error"><?php echo form_error('anh') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Ảnh kèm theo:</label>
							<div class="formRight">
								<div class="left"><input type="file" value="<?php echo $chua->list_anh; ?>" id="param_list_anh" name="list_anh[]" multiple=""></div>
								<?php $anh_kem_theo = json_decode($chua->list_anh); ?>
								<?php if (!empty($anh_kem_theo)): ?>
									<?php foreach ($anh_kem_theo as $anh): ?>
										<img src="<?php echo base_url('upload/chua/'.$anh); ?>" style="width: 100px; height: 70px; margin-left: 20px; display: inline-block;">
									<?php endforeach ?>
									
								<?php endif ?>
								<div name="list_anh_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow">
							<label class="formLeft" for="param_danh_muc">Danh mục:<span class="req">*</span></label>
							<div class="formRight">
								<select name="danh_muc" _autocheck="true" id="param_danh_muc" class="left">
									<!-- kiem tra danh muc co danh muc con hay khong -->
									<?php if ($danh_muc) { ?>
										<?php foreach ($danh_muc as $value): ?>
											<optgroup label="<?php echo $value->ten ?>">
												<?php foreach ($value->subs as $row): ?>
													<?php if($row->id == $chua->id_danh_muc){ ?>

														<option selected value="<?php echo $row->id ?>"><?php echo $row->ten ?></option>

													<?php }else{ ?>

														<option value="<?php echo $row->id ?>"><?php echo $row->ten ?></option>

													<?php }?>
												<?php endforeach ?>
											</optgroup>
										<?php endforeach ?>
									<?php } ?>

								</select>
								<span name="danh_muc_autocheck" class="autocheck"></span>
								<div name="danh_muc_error" class="clear error"><?php echo form_error('danh_muc') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						

						<div class="formRow">
							<label class="formLeft" for="param_id_tinh">Tỉnh/TP:<span class="req">*</span></label>
							<div class="formRight">
								<select name="id_tinh" _autocheck="true" id="param_id_tinh" class="left">
									<?php if (!empty($tinhs)): ?>

										<?php foreach ($tinhs as $tinh): ?>
											<?php if ($tinh->provinceid == $chua->id_tinh): ?>
												<option selected="true" value="<?php echo $tinh->provinceid; ?>"><?php echo $tinh->type . " " .$tinh->name; ?></option>
											<?php else: ?>
												<option value="<?php echo $tinh->provinceid; ?>"><?php echo $tinh->type . " " .$tinh->name; ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
										
									<?php endif ?>
								</select>
								<span name="id_tinh_autocheck" class="autocheck"></span>
								<div name="id_tinh_error" class="clear error"><?php echo form_error('id_tinh'); ?></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<label class="formLeft" for="param_id_quan">Quận/Huyện:<span class="req"></span></label>
							<div class="formRight">
								<select name="id_quan" _autocheck="true" id="param_id_quan" class="left">
									<?php if (!empty($quans)): ?>

										<?php foreach ($quans as $quan): ?>
											<?php if ($quan->districtid == $chua->id_quan): ?>
												<option selected="true" value="<?php echo $quan->districtid; ?>"><?php echo $quan->type . " " .$quan->name; ?></option>
											<?php else: ?>
												<option value="<?php echo $quan->districtid; ?>"><?php echo $quan->type . " " .$quan->name; ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
										
									<?php endif ?>
								</select>
								<span name="id_quan_autocheck" class="autocheck"></span>
								<div name="id_quan_error" class="clear error"><?php echo form_error('id_quan'); ?></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<label class="formLeft" for="param_id_phuong">Xã/Phường:<span class="req"></span></label>
							<div class="formRight">
								<select name="id_phuong" _autocheck="true" id="param_id_phuong" class="left">
									<?php if (!empty($phuongs)): ?>

										<?php foreach ($phuongs as $phuong): ?>
											<?php if ($phuong->wardid == $chua->id_phuong): ?>
												<option selected="true" value="<?php echo $phuong->wardid; ?>"><?php echo $phuong->type . " " .$phuong->name; ?></option>
											<?php else: ?>
												<option value="<?php echo $phuong->wardid; ?>"><?php echo $phuong->type . " " .$phuong->name; ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
										
									<?php endif ?>
								</select>
								<span name="id_phuong_autocheck" class="autocheck"></span>
								<div name="id_phuong_error" class="clear error"><?php echo form_error('tieu_de'); ?></div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow">
							<label class="formLeft" for="param_so_nha">Số:<span class="req"></span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="so_nha" value="<?php echo $chua->so_nha; ?>" id="param_so_nha" _autocheck="true" type="text"></span>
								<span name="so_nha_autocheck" class="autocheck"></span>
								<div name="so_nha_error" class="clear error"><?php echo form_error('so_nha') ?></div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="formRow">
							<label class="formLeft" for="param_su_kien">Ngày có sự kiện:<span class="req"></span></label>
							<div class="formRight">
								<select name="su_kien[]" _autocheck="true" id="param_su_kien" class="left" multiple="true" style="min-width: 100px; padding: 5px 6px;">
<!-- 									<option value="">Lựa chọn sự kiện kèm theo</option> -->
									<?php if (!empty($su_kien)): ?>
										<?php $su_kien_chua = json_decode($chua->su_kien); ?>
										<?php foreach ($su_kien as $row): ?>
											<?php if (in_array($row->id, $su_kien_chua)): ?>
												<option selected="true" value="<?php echo $row->id ?>"><?php echo $row->ngay_dien_ra  . ' - '.$row->ten; ?></option>
											<?php else: ?>
												<option value="<?php echo $row->id ?>"><?php echo $row->ngay_dien_ra  . ' - '.$row->ten; ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
									<?php endif ?>
									
								</select>
								<div name="su_kien_error" class="clear error"><?php echo form_error('su_kien') ?></div>
							</div>
							<div class="clear"></div>
						</div>				         
						<div class="formRow hide"></div>
					</div>

					<div id="tab3" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft">Mô tả:<span class="req">*</span></label>
							<div class="formRight">
								<textarea name="mo_ta"  id="param_mo_ta" class="editor"><?php echo $chua->mo_ta; ?></textarea>
								<div name="mo_ta_error" class="clear error"><?php echo form_error('mo_ta') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>


				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Cập nhật" class="redB">
					<input type="reset" value="Hủy bỏ" class="basic">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
	<?php endif ?>
</div>