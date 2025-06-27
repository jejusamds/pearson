<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header"><?=$cfg['application']['skin'][$lang][$country]['page_header']?></h1>
	<!-- end page-header -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				<div class="panel-body panel-form">
					<form class="form-horizontal form-bordered" action="<?=$cfg['href']?>/application/process/" id="form" method="post" data-form-lang="en" enctype="multipart/form-data">
						<input type="hidden" name="form_lang" value="en" />
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Country of Business Registration</label>
							<div class="col-md-6 col-sm-6">
								<select class="form-control" id="select-required" name="select_country" data-select-country="true">
									<option value="" disabled>- Please choose</option>
									<? foreach($cfg['application']['country'][$lang] as $key => $value){ ?>
									<option value="<?=$key?>" <?=(($country == $key) ? "selected" : "")?>><?=$value?></option>
									<? } ?>
								</select>
							</div>
						</div>

						<? if(isset($cfg['application']['skin'][$lang][$country]['corporate_form'])){ ?>
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Business Type</label>
							<div class="col-md-6 col-sm-6">
								<? $k = 0; ?>
								<? foreach($cfg['application']['skin'][$lang][$country]['corporate_form'] as $corporate_form_key => $corporate_form_value){ ?>
									<div class="radio">
										<label>
											<input type="radio" name="corporate_form" value="<?=$corporate_form_value['value']?>" <?=(($k === 0) ? 'checked' : '')?> data-branch-hidden="<?=$corporate_form_value['data_value']?>">
											<?=$corporate_form_value['text']?>
										</label>
									</div>
									<? $k++;?>
								<? } ?>
								<? unset($k); ?>
							</div>
						</div>
						<? } ?>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Company Name</label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control text-uppercase" type="text" name="company_name" placeholder="" required />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Business Activity</label>
							<div class="col-md-6 col-sm-6">
								<? if($cfg['application']['skin'][$lang][$country]['activities_type'] == "type01"){ ?>
									<select class="multiple-select2 form-control" name="activities[]" multiple="multiple" data-placeholder="Type your company’s business activity.">
										<? foreach($cfg['application']['activities'][$lang][$country] as $key => $value){ ?>
											<option value="<?=$key?>"><?=$value?></option>
										<? } ?>
									</select>
								<? } elseif($cfg['application']['skin'][$lang][$country]['activities_type'] == "type02"){ ?>
									<textarea class="form-control" name="activities" rows="5" placeholder="자유롭게 기입"></textarea>
								<? } ?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Registered Address</label>
							<div class="col-md-6 col-sm-6">
								<label class="radio-inline">
									<input type="radio" name="acting_address" value="self" data-hidden-el-toggle="acting_address" >
									I have my own office address in Korea
								</label>
								<label class="radio-inline">
									<input type="radio" name="acting_address" value="agency" data-hidden-el-toggle="acting_address" checked>
									Use Pearson’s address service
								</label>
								<input class="form-control m-t-10 hide" type="text" name="acting_address_text" data-hidden-el-toggle-target="acting_address" placeholder="" />
							</div>
						</div>

						<div class="form-group capital-amount-tooltip" data-branch-hidden-target="true">
							<label class="control-label col-md-4 col-sm-4">Paid-up Capital</label>
							<div class="col-md-6 col-sm-6">
								<div class="input-group" data-tooltip-capital-amount="true">
									<? if($cfg['application']['skin'][$lang][$country]['capital_amount_symbol']){ ?>
									<span class="input-group-addon">$</span>
									<? } ?>
									<input type="text" class="form-control" name="capital_amount" data-only-number="true" data-number-format="true">
									<span class="input-group-addon"><?=$cfg['application']['skin'][$lang][$country]['capital_amount_unit']?></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Main Contact</label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" type="text" name="major_phone[]" placeholder="Name" />
								<input class="form-control m-t-10" type="text" name="major_phone[]" placeholder="Phone Number" data-country-phone="major_phone_country" data-country-preferred-countries='["kr", "sg", "hk", "us", "gb", "ae", "bq" ]' />
								<input class="form-control m-t-10" type="text" name="major_phone[]" placeholder="Email" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4">Representative <span class="requried">*</span></label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" type="text" name="ceo_name[]" placeholder="Name" required />
								<input class="form-control m-t-10" type="text" name="ceo_phone[]" placeholder="Phone Number" data-country-phone="ceo_phone_country[]" required />
								<input class="form-control m-t-10" type="text" name="ceo_email[]" placeholder="Email" required />

								<label class="control-label m-t-5 text-muted">Copy of Passport :</label>
								<div class="input-group m-t-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="ceo_passport_fileseq[]">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="ceo_passport_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

								<label class="control-label m-t-5 text-muted">Proof of Residential Address :</label>
								<div class="input-group m-t-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="ceo_residentcard_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="ceo_residentcard_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 col-sm-4 control-label">Add representative</label>
							<div class="col-md-6 col-sm-6 ui-sortable-table">
								<?
									$prefix = "ceo";
									if(!is_array($rs["product_".$prefix])){ $rs["product_".$prefix] = array(""); }
								?>
								<div data-el-container="<?=$prefix?>"></div>
								<button class="btn btn-info btn-sm" type="button" data-el-add="<?=$prefix?>">Add <i class="fa fa-plus"></i></button>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4"><span data-branch-change-text="true">Parent Company</span> <span class="requried">*</span></label>
							<div class="col-md-6 col-sm-6" data-shareholder-toggle-container="true">
								<label class="radio-inline hide" data-branch-hidden-target="true">
									<input type="radio" id="branchOtherRadio" name="shareholder_pb[0]" value="privacy" data-shareholder-toggle-switch="privacy" data-shareholder-multiname="shareholder_pb" checked="checked">
									Individual
								</label>
								<label class="radio-inline hide" data-branch-hidden-target="true">
									<input type="radio" id="branchDefaultRadio" name="shareholder_pb[0]" value="business" data-shareholder-toggle-switch="business" data-shareholder-multiname-siblings="shareholder_pb">
									Corporate
								</label>
								<p></p>
								<input class="form-control" type="text" name="shareholder_name[]" placeholder="Name" required />
								<input class="form-control m-t-10" type="text" name="shareholder_phone[]" placeholder="Phone Number" data-country-phone="shareholder_phone_country[]" required />
								<input class="form-control m-t-10" type="text" name="shareholder_email[]" placeholder="Email" required />
								<input class="form-control m-t-10 hide" type="number" name="shareholder_equity[]" placeholder="Shareholding %" data-sum-all="true" data-branch-hidden-target="true" />

								<label class="control-label m-t-5 text-muted hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">Copy of Passport :</label>
								<div class="input-group m-t-10 hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="shareholder_passport_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="shareholder_passport_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

								<label class="control-label m-t-5 text-muted hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">Proof of Residential Address :</label>
								<div class="input-group m-t-10 hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="shareholder_residentcard_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="shareholder_residentcard_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

								<label class="control-label m-t-5 text-muted" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Certificate of Business Registration :</label>
								<div class="input-group m-t-10" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="shareholder_businesslicense_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="shareholder_businesslicense_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

								<label class="control-label m-t-5 text-muted" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Registrar of Shareholders :</label>
								<div class="input-group m-t-10" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="shareholder_list_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="shareholder_list_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

								<label class="control-label m-t-5 text-muted" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Copy of Passport (Parent Company Representative) :</label>
								<div class="input-group m-t-10" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<input type="hidden" name="shareholder_representative_passport_fileseq[]" value="">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
												<span class="fileupload-new"><i class="fa fa-plus"></i></span>
												<input type="file" name="shareholder_representative_passport_uploadfile[]">
											</span>
											<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="form-group hide" data-branch-hidden-target="true">
							<label class="col-md-4 col-sm-4 control-label">Add Shareholder</label>
							<div class="col-md-6 col-sm-6 ui-sortable-table">
								<?
									$prefix = "addstock";
									if(!is_array($rs["product_".$prefix])){ $rs["product_".$prefix] = array(""); }
								?>
								<div data-el-container="<?=$prefix?>"></div>
								<button class="btn btn-info btn-sm" type="button" data-el-add="<?=$prefix?>">Add <i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 text-right">
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end #content -->

<div style="display: none;">
	<!-- 이사 추가 엘리먼트 -->
	<? $prefix = "ceo"; ?>
	<div class="m-b-10 sortable_items" data-el-clone="<?=$prefix?>" data-el-parent="<?=$prefix?>">
		<div class="input-group">
			<button type="button" class="btn btn-sm btn-gray m-r-5 sortable_handdle"><i class="fa fa-arrows"></i></button>
			<button type="button" class="btn btn-sm btn-danger" data-el-remove="<?=$prefix?>">Delete</button>
		</div>
		<input class="form-control m-t-10" type="text" name="ceo_name[]" placeholder="Name" />
		<input class="form-control m-t-10" type="text" name="ceo_phone[]" placeholder="Phone Number" data-country-phone="ceo_phone_country[]" />
		<input class="form-control m-t-10" type="text" name="ceo_email[]" placeholder="Email" />

		<label class="control-label m-t-5 text-muted">Copy of Passport :</label>
		<div class="input-group m-t-10">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="ceo_passport_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="ceo_passport_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<label class="control-label m-t-5 text-muted">Proof of Residential Address :</label>
		<div class="input-group m-t-10">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="ceo_residentcard_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="ceo_residentcard_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<p>&nbsp;</p>
	</div>
	<!-- 이사 추가 엘리먼트 -->
	<!-- 주주 추가 엘리먼트 -->
	<? $prefix = "addstock"; ?>
	<div class="sortable_items" data-el-clone="<?=$prefix?>" data-el-parent="<?=$prefix?>" data-shareholder-toggle-container="true">
		<div class="input-group">
			<button type="button" class="btn btn-sm btn-gray m-r-5 sortable_handdle"><i class="fa fa-arrows"></i></button>
			<button type="button" class="btn btn-sm btn-danger" data-el-remove="<?=$prefix?>">Delete</button>
		</div>

		<label class="radio-inline">
			<input type="radio" value="privacy" data-shareholder-toggle-switch="privacy" data-shareholder-multiname="shareholder_pb" data-shareholder-multiname-passed="true" checked="checked">
			Individual
		</label>
		<label class="radio-inline">
			<input type="radio" value="business" data-shareholder-toggle-switch="business" data-shareholder-multiname-siblings="shareholder_pb" data-shareholder-multiname-passed="true">
			Corporate
		</label>
		<p></p>
		<input class="form-control" type="text" name="shareholder_name[]" placeholder="Name" data-shareholder-toggle-target="placeholder" data-shareholder-toggle-target-value-privacy="Name" data-shareholder-toggle-target-value-business="Name" />
		<input class="form-control m-t-10" type="text" name="shareholder_phone[]" placeholder="Phone Number" data-country-phone="shareholder_phone_country[]" data-country-phone-passed="true" />
		<input class="form-control m-t-10" type="text" name="shareholder_email[]" placeholder="Email" />
		<input class="form-control m-t-10" type="number" name="shareholder_equity[]" placeholder="Shareholding %" data-sum-all="true" data-sum-all-passed="true" />

		<label class="control-label m-t-5 text-muted" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">Copy of Passport :</label>
		<div class="input-group m-t-10" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="shareholder_passport_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="shareholder_passport_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<label class="control-label m-t-5 text-muted" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">Proof of Residential Address :</label>
		<div class="input-group m-t-10" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="privacy">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="shareholder_residentcard_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="shareholder_residentcard_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<label class="control-label m-t-5 text-muted hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Certificate of Business Registration :</label>
		<div class="input-group m-t-10 hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="shareholder_businesslicense_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="shareholder_businesslicense_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<label class="control-label m-t-5 text-muted hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Registrar of Shareholders :</label>
		<div class="input-group m-t-10 hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="shareholder_list_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="shareholder_list_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<label class="control-label m-t-5 text-muted hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">Copy of Passport (Parent Company Representative) :</label>
		<div class="input-group m-t-10 hide" data-shareholder-toggle-target="showhide" data-shareholder-toggle-target-value="business">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<input type="hidden" name="shareholder_representative_passport_fileseq[]" value="">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview" style="color: #aaa;">Max 20MB</span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists"><i class="fa fa-exchange"></i></span>
						<span class="fileupload-new"><i class="fa fa-plus"></i></span>
						<input type="file" name="shareholder_representative_passport_uploadfile[]">
					</span>
					<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-minus"></i></a>
				</div>
			</div>
		</div>

		<p>&nbsp;</p>
	</div>
	<!-- 주주 추가 엘리먼트 -->
</div>