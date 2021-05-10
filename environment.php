<?php
define('QUADODO_IN_SYSTEM', true);
require_once './includes/header.php';
require_once './includes/redirectToLogin.php';
$qls->Security->check_auth_page('operator.php');
?>

<?php require 'includes/header_start.php'; ?>

<link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" />
<link href="assets/css/style-cabinet.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-object.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-templates.css" rel="stylesheet" type="text/css"/>

<!-- X-editable css -->
<link type="text/css" href="assets/plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

<!-- Jquery filer css -->
<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

<?php require 'includes/header_end.php'; ?>
<?php require_once './includes/modals.php'; ?>

<!-- Make server data available to client via hidden inputs -->
<?php include_once('includes/content-build-serverData.php'); ?>
<canvas id="canvasBuildSpace" style="z-index:1000;position:absolute; pointer-events:none;"></canvas>

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Build - Environment</h4>
    </div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="col-md-4">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-20">Locations and Cabinets</h4>
				<div class="card">
					<div class="card-header">Location Tree</div>
					<div class="card-block">
						<div class="card-blockquote">
							<div id="ajaxTree" class="navTree"></div>
						</div>
					</div>
				</div>
				<!--
				/////////////////////////////
				//Cabinet Details
				/////////////////////////////
				-->

				<div id="cabinetCardBox" class="card">
					<div class="card-header">Cabinet</div>
					<div class="card-block">
						<blockquote class="card-blockquote">
							<table>
								<tr>
									<td class="objectDetailAlignRight">
										<strong>RU Size:&nbsp&nbsp</strong>
									</td>
									<td>
										<a href="#" id="cabinetSizeInput" data-type="number" data-pk="" data-value=""></a>
									</td>
								</tr>
								<tr>
									<td class="objectDetailAlignRight">
										<strong>RU Orientation:&nbsp&nbsp</strong>
									</td>
									<td>
										<a href="#" id="cabinetRUOrientationInput" data-type="select" data-pk="" data-value=""></a>
									</td>
								</tr>
							</table>
							<!-- Cable path table -->
							<h4 class="header-title m-t-20">Cable Paths:</h4>

							<div class="p-20">
								<div class="table-responsive">
									<table class="table table-sm">
										<thead>
										<tr>
											<th>Cabinet</th>
											<th>Distance (m)</th>
											<th>Notes</th>
											<th></th>
										</tr>
										</thead>
										<tbody id="cablePathTableBody">
										</tbody>
									</table>
								</div>
								<button id="pathAdd" type="button" class="btn btn-sm btn-success waves-effect waves-light">+ Add Path</button>
							</div>
							<!-- Cable Adjacencies -->
							<h4 class="header-title m-t-20">Cabinet Adjacencies:</h4>

							<div class="p-20">
								<div class="table-responsive">
									<table class="table table-sm">
										<thead>
										<tr>
											<th>Side</th>
											<th>Cabinet</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td>Left</td>
												<td><a href="javascript:void(0)" id="adjCabinetSelectL" class="adjCabinetSelect" data-type="select" data-pk="" data-value=""></a></td>
											</tr>
											<tr>
												<td>Right</td>
												<td><a href="javascript:void(0)" id="adjCabinetSelectR" class="adjCabinetSelect" data-type="select" data-pk="" data-value=""></a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
		<div id="floorplanDetails" style="display:none;">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-20">Object Details</h4>
				
					<div class="card">
						<div class="card-header">Selected
							<span>
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-sm btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Actions <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
									<div class="dropdown-menu">
										<a class="clearTrunkPeer floorplanObj dropdown-item disabled" href="#" ><i class="fa fa-times"></i></span> Clear Path</a>
										<a class="objDelete floorplanObj dropdown-item disabled" href="#" data-toggle="modal" data-target="#modalConfirm"><i class="fa fa-times"></i></span> Delete</a>
									</div>
								</div>
							</span>
						</div>
						<div class="card-block">
							<blockquote class="card-blockquote">
								<table>
									<tr>
										<td class="objectDetailAlignRight">
											<strong>Name:&nbsp&nbsp</strong>
										</td>
										<td>
											<a href="#" id="inline-floorplanObjName" data-type="text"></a>
										</td>
									</tr>
									<tr>
										<td class="objectDetailAlignRight">
											<strong>Type:&nbsp&nbsp</strong>
										</td>
										<td>
											<span id="floorplanDetailType">-</span>
										</td>
									</tr>
									<tr>
										<td class="objectDetailAlignRight">
											<strong>Trunked:&nbsp&nbsp</strong>
										</td>
										<td>
											<span id="floorplanDetailTrunkedTo">-</span>
										</td>
									</tr>
								</table>
							</blockquote>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Object List</div>
						<div class="card-block">
							<blockquote class="card-blockquote">
								<div id="floorplanObjectTableContainer"></div>
							</blockquote>
						</div>
					</div>
				
			</div>
		</div><!-- end col -->
		</div>

		<div class="col-md-8">
			<div id="rowFloorplan" class="row" style="display: none;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="card-box" style="min-height:500px;">
						<h4 class="header-title m-t-0">Floorplan</h4>
						<div class="noSelect">
							<i id="btnZoomOut" class="fa fa-search-minus fa-2x cursorPointer"></i>
							<i id="btnZoomIn" class="fa fa-search-plus fa-2x cursorPointer"></i>
							<i id="btnZoomReset" class="fa fa-refresh fa-2x cursorPointer"></i>
							<i id="btnImageUpload" class="fa fa-image fa-2x cursorPointer"></i>
							<div class="pull-right">
								<i class="floorplanObject floorplanStockObj selectable fa fa-square-o fa-lg cursorGrab" data-type="walljack" data-objectID="0"></i><span> Walljack</span>
								<i class="floorplanObject floorplanStockObj selectable fa fa-wifi fa-2x cursorGrab" data-type="wap" data-objectID="0"></i><span> WAP</span>
								<i class="floorplanObject floorplanStockObj selectable fa fa-laptop fa-2x cursorGrab" data-type="device" data-objectID="0"></i><span> Device</span>
								<i class="floorplanObject floorplanStockObj selectable fa fa-video-camera fa-2x cursorGrab" data-type="camera" data-objectID="0"></i><span> Camera</span>
							</div>
							<img id="imgDummy" style="display:none;"></img>
							<div id="floorplanWindow">
								<div id="floorplanContainer" style="position:relative;background-repeat:no-repeat"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="rowCabinet" class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
					<div class="card-box" style="min-height:500px;">
						<h4 class="header-title m-t-0">Cabinet</h4>
						<div id="cabinetControls" class="form-inline m-t-0 m-b-15">
							<div class="radio radio-inline">
								<input class="sideSelectorCabinet" type="radio" name="sideSelectorCabinet" id="sideSelectorCabinetFront" value="0" checked>
								<label for="sideSelectorCabinetFront">Front</label>
							</div>
							<div class="radio radio-inline">
								<input class="sideSelectorCabinet" type="radio" name="sideSelectorCabinet" id="sideSelectorCabinetBack" value="1">
								<label for="sideSelectorCabinetBack">Back</label>
							</div>
						</div>
						<input id="currentCabinetFace" type="hidden" value="0">
						<div id="buildSpaceContent">Please select a cabinet from the Environment Tree.</div>
					</div>
				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
					<div class="card-box">
						<h4 class="header-title m-t-0">Object Details</h4>
						<div id="objectCardBox" class="card">
							<div class="card-header">Selected
								<span>
									<div class="btn-group pull-right">
										<button type="button" class="btn btn-sm btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Actions <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
										<div class="dropdown-menu">
											<a class="createCombinedTemplate rackObj dropdown-item disabled" href="#" ><i class="fa fa-object-group"></i></span> Combine Templates</a>
											<a class="clearTrunkPeer rackObj dropdown-item disabled" href="#" ><i class="fa fa-times"></i></span> Clear Trunk</a>
											<a class="objDelete rackObj dropdown-item disabled" href="#" data-toggle="modal" data-target="#modalConfirm"><i class="fa fa-times"></i></span> Delete</a>
										</div>
									</div>
								</span>
							</div>
							<div class="card-block">
								<blockquote class="card-blockquote">
									<input id="selectedObjectID" type="hidden">
									<input id="selectedObjectFace" type="hidden">
									<input id="selectedPartitionDepth" type="hidden">
									<div id="detailsContainer">
										<table>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Object Name:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailObjName" class="objDetail"><a href="#" id="inline-objName" data-type="text">-</a></span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Template Name:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailTemplateName" class="objDetail"><a href="#" id="inline-templateName" data-type="text">-</a></span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Category:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailCategory" class="objDetail"><a href="#" id="inline-category" data-type="select">-</a></span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight" valign="top">
													<strong>Trunked To:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailTrunkedTo" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Type:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailObjType" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Function:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailObjFunction" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>RU Size:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailRUSize" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Mount Config:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailMountConfig" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Port Range:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailPortRange" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Port Orientation:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailPortOrientation" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Port Type:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailPortType" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight">
													<strong>Media Type:&nbsp&nbsp</strong>
												</td>
												<td>
													<span id="detailMediaType" class="objDetail">-</span>
												</td>
											</tr>
											<tr>
												<td class="objectDetailAlignRight" valign="top">
													<strong>Image:&nbsp&nbsp</strong>
												</td>
												<td width="100%">
													<span id="detailTemplateImage" class="objDetail">-</span>
												</td>
											</tr>
										</table>
										
									</div>
								</blockquote>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								Available Templates
							</div>
							<div id="availableContainer" class="card-block">
								<h6>Name Filter:</h6>
								<select id="templateFilter" multiple data-role="tagsinput">
								</select>
								<div id="templateContainerLoad">
								<?php
									include_once('./includes/content-build-objects.php');
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require 'includes/footer_start.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>

<script src="assets/pages/jquery.cabinets.js"></script>

<!-- Tags Input -->
<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

<!-- XEditable Plugin -->
<script src="assets/plugins/moment/moment.js"></script>
<script type="text/javascript" src="assets/plugins/x-editable/js/bootstrap-editable.min.js"></script>

<!-- panZoom Plugin -->
<!--script src="assets/plugins/panzoom/jquery.panzoom.min.js"></script-->
<script src='assets/plugins/panzoom2/panzoom.js'></script>

<!-- Required datatable js -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	
<!-- Jquery filer js -->
<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
	
<?php require 'includes/footer_end.php' ?>
