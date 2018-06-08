@extends('layouts.backend')

@section('title','Rumah Sakit')

@section('css')
    <!-- datatables -->
    <link href="<?=base_url('assets/plugins/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    <style type="text/css">
        /* Style the Image Used to Trigger the Modal */
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption { 
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <?php 
        $privileges = explode(',', $priv['privileges']);
    ?>
    <div class="page-title">
        <div class="title_left">
            <h3>Rumah Sakit</h3>
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
                    <h2>Rumah Sakit</h2>
                    <?php if($privileges[0] == 1): ?>
                        <div class="navbar-right">
                            <a href="<?=base_url('rumah_sakit/add')?>">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Foto</th>
                                <th>Rumah Sakit</th>
                                <th>Alamat</th>
                                <th>Kontak Rumah Sakit</th>
                                <th>Jadwal</th>
                                <?php if($privileges[1] == 1 || $privileges[2] == 1): ?>
                                <th width="5%">Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($rumah_sakit as $key => $value):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td> 
                                    
                                    <ul>
                                        @if(!empty($value['foto']))
                                            @foreach($value['foto'] as $k => $v)
                                                <li><img src="<?=base_url('assets/images/rumah_sakit/'.$v['foto'].'')?>" style="width: 40px;height: 40px;" class="img img-rounded myImg"></li>
                                            @endforeach
                                        @else
                                            <li><img class="img img-rounded" src="<?=base_url('assets/images/no-image.png')?>" style="width: 40px;height: 40px;"></li>
                                        @endif
                                    </ul>

                                </td>
                                <td><?= $value['nama_rumah_sakit'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td>
                                    <ul>
                                        <li>No. Telp : <?= $value['no_telp'] ?></li>
                                        <li>No. Fax : <?= $value['no_fax'] ?></li>
                                        <li>Email : <?= $value['email'] ?></li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @if(!empty($value['jadwal']))
                                            @foreach($value['jadwal'] as $k => $v)
                                                <li>Hari : <?= $v['hari']?> <br>
                                                    Jam : <?= $v['jam_mulai'] ?> s.d. <?= $v['jam_selesai'] ?> <br>
                                                    Operational : <?= $v['operational'] ?></li>
                                            @endforeach
                                        @else
                                            <li>Belum ada jadwal</li>
                                        @endif
                                    </ul>
                                </td>
                                <?php if($privileges[1] == 1 || $privileges[2] == 1): ?>
                                    <td>
                                        <ul style="list-style: none;padding-left: 0px;padding-right: 0px; text-align: center;">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bars" style="font-size: large;"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="right: 0; left: auto;">
                                                    <?php if($privileges[1] == 1): ?>
                                                        <li>
                                                            <a href="<?=base_url('rumah_sakit/update/'.encode($value['id']))?>">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if($privileges[1] == 1 && $privileges[2] == 1): ?>
                                                        <li class="divider"></li>
                                                    <?php endif ?>
                                                    <?php if($privileges[2] == 1): ?>
                                                        <li>
                                                            <a href="#" class="btn-delete" data-id="<?=encode($value['id'])?>">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                <?php endif ?>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- The Close Button -->
      <span class="close">&times;</span>

      <!-- Modal Content (The Image) -->
      <img class="modal-content img01" id="img01">

      <!-- Modal Caption (Image Text) -->
      <div id="caption"></div>
    </div>
@endsection

@section('script')
    <!-- datatables -->
    <script src="<?=base_url('assets/plugins/datatables/js/jquery.dataTables.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables/js/dataTables.bootstrap.js')?>"></script>
    <!-- delete js -->
    <script src="<?=base_url('assets/js/delete.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[ 0, "asc" ]],
                "scrollX": true
            });

            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementsByClassName('myImg');
            console.log(img);
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
              modal.style.display = "none";
            }
        });
    </script>
@endsection