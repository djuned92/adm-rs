@extends('layouts.backend')

@section('title','Rumah Sakit - Gentelella')

@section('css')
    <!-- select2 -->
    <link href="<?=base_url('assets/plugins/select2/dist/css/select2.min.css')?>" rel="stylesheet">
@endsection

@section('content')
<div class="page-title">
        <div class="title_left">
            <h3><?=($this->uri->segment(2) == 'add') ? 'Add ' : 'Edit '?>Rumah Sakit</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?=($this->uri->segment(2) == 'add') ? 'Add ' : 'Edit '?>Rumah Sakit</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" id="myForm">
                        
                        <?php if($this->uri->segment(2) == 'update'): ?>
                        <input type="hidden" name="id" value="<?=$this->uri->segment(3)?>">
                        <?php endif ?>
                        <h4>Profile Rumah Sakit</h4>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Rumah Sakit <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select style="width: 100%;" class="form-control" name="jenis_rumah_sakit_id" id="jenis_rumah_sakit_id" required>
                                	<option value="">-- Jenis Rumah Sakit --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Rumah Sakit <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="nama_rumah_sakit" class="form-control" placeholder="Rumah Sakit ..." 
                                value="<?=isset($rumah_sakit['nama_rumah_sakit'])?$rumah_sakit['nama_rumah_sakit']:set_value('nama_rumah_sakit');?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Alamat <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
								<textarea class="form-control" name="alamat" rows="3" placeholder='Alamat ...' 
								required><?=isset($rumah_sakit['alamat'])?$rumah_sakit['alamat']:set_value('alamat');?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">No Telp <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="no_telp" class="form-control" placeholder="No Telp ..." 
                                value="<?=isset($rumah_sakit['no_telp'])?$rumah_sakit['no_telp']:set_value('no_telp');?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">No Fax </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="no_fax" class="form-control" placeholder="No Fax ..." 
                                value="<?=isset($rumah_sakit['no_fax'])?$rumah_sakit['no_fax']:set_value('no_fax');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Email </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" name="email" class="form-control" placeholder="Email ..." 
                                value="<?=isset($rumah_sakit['email'])?$rumah_sakit['email']:set_value('email');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Foto <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" class="form-control" name="userfile[]" multiple required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Lokasi <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="us2-lokasi" required>
                                <input type="hidden" name="lat" class="form-control" id="us2-latitude">
                                <input type="hidden" name="lng" class="form-control" id="us2-longitude">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-9 col-sm-9 col-xs-12" id="us2" style="width: 753px; height: 260px; margin-left: 182px;"></div>
                        </div>

                        <hr>
                        
                        <h4>Jadwal Rumah Sakit</h4>
                       <!-- 
                        <?php 
                        	for($i = 0; $i < 7; $i++):
	                        $hari = ($i == 0) ? 'Senin': (($i == 1) ? 'Selasa': 
	                        		(($i == 2) ? 'Rabu': (($i == 3) ? 'Kamis': 
                        			(($i == 4) ? 'Jumat': (($i == 5) ? 'Sabtu':'Minggu'
                        		)))));
                        ?>
	                        <div class="form-group">
	                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jadwal <span class="required">*</span></label>
	                            <div class="col-md-2 col-sm-2 col-xs-12">
	                                <input type="text" name="hari[]" class="form-control" value="<?=$hari?>" readonly>
	                            </div>
	                            
	                            <div class="col-md-2 col-sm-2 col-xs-12">
	                                <input type="text" name="jam_mulai[]" class="form-control" placeholder="Jam Mulai ..." required>
	                            </div>
	                            <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align:center;">s.d.</label>
	                            <div class="col-md-2 col-sm-2 col-xs-12">
	                                <input type="text" name="jam_selesai[]" class="form-control" placeholder="Jam Selesai ..." required>
	                            </div>
	                            
	                            <div class="col-md-2 col-sm-2 col-xs-12">
	                                <select style="width: 100%;" class="form-control" name="operational[]" required>
	                                	<option value="">-- Operational --</option>
	                                	<option value="12 Jam">12 Jam</option>
	                                	<option value="24 Jam">24 Jam</option>
	                                	<option value="Libur">Libur</option>
	                                </select>
	                            </div>
	                        </div>
                    	<?php endfor ?>
                         -->

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                                <a href="<?=base_url('rumah_sakit')?>">
                                    <button type="button" class="btn btn-primary">Back</button>
                                </a>
                                <button type="submit" class="btn btn-success" id="save">Save</button>
                            </div>
                        </div>

                    </form>      
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- select2 -->
<script src="<?=base_url('assets/plugins/select2/dist/js/select2.min.js')?>"></script>
<!-- add update js -->
<script src="<?=base_url('assets/js/add-update.js')?>"></script>
<!-- api key = AIzaSyAo8UTUzhBDNKl9qyLyZiqLDbukJavKCRg -->
<script src='http://maps.google.com/maps/api/js?key=AIzaSyAo8UTUzhBDNKl9qyLyZiqLDbukJavKCRg&libraries=places'></script>
<script src="<?=base_url('assets/plugins/location-picker/location-picker.js')?>"></script>
<script>
	$(document).ready(function() {
        $('#jenis_rumah_sakit_id').select2({
            width: 'resolve',
            data: <?php echo $jenis_rumah_sakit; ?>
        });

        <?php if($this->uri->segment(2) == 'update'): ?>
            <?php $jenis_rumah_sakit_id = isset($rumah_sakit['jenis_rumah_sakit_id']) ? $rumah_sakit['jenis_rumah_sakit_id'] : ''; ?>
            $('#jenis_rumah_sakit_id').val(<?=$jenis_rumah_sakit_id?>).trigger('change');
        <?php endif ?>
    });

    $('#us2').locationpicker({
        location: {
            // -6.21462, 106.84513. jakarta
            latitude: <?=isset($rumah_sakit['lat']) ? $rumah_sakit['lat']:-6.21462?>,
            longitude: <?=isset($rumah_sakit['lng']) ? $rumah_sakit['lng']:106.84513?>
        },
        autocompleteOptions: {
          componentRestrictions: {country: 'id'}
        },
        radius: 10,
        zoom: 15,
        inputBinding: {
            latitudeInput: $('#us2-latitude'),
            longitudeInput: $('#us2-longitude'),
            locationNameInput: $('#us2-lokasi')
        },
        enableAutocomplete: true,
    });
</script>
@endsection