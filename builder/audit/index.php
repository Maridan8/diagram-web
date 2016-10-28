<?
##INCLUDES
	require_once('../lib/config.php');

#CONTROLE SESSAO
	fnInicia_Sessao('audit');

#INPUTS
	$PESQUISA     = addslashes($_REQUEST['pesquisa']);
	$DAT_INICIO   = addslashes($_REQUEST['dat_inicio']);
	$DAT_FIM 	= addslashes($_REQUEST['dat_fim']);
	$DAT_COMPLETA = addslashes($_REQUEST['dat_completa']);

	$menos30dias = time( ) - 86400 * 30;

	if ($DAT_INICIO == '') 	$DAT_INICIO = date('Y-m-d',$menos30dias);
	if ($DAT_FIM == '') 		$DAT_FIM = date('Y-m-d');
	if ($DAT_COMPLETA == '')	$DAT_COMPLETA = date('d/m/Y',$menos30dias).' - '.date('d/m/Y');

#INICIO LOGICA
	$DB = fnDBConn();
	$SQL = "SELECT ADMINISTRADOR.NOME,ADMINISTRADOR.LOGIN,AUDITORIA.IP, AUDITORIA.ACAO_DESC,DATE_FORMAT(AUDITORIA.DIN,'%d/%m/%Y<br>%h:%i:%s') DIN FROM AUDITORIA, ADMINISTRADOR
			WHERE ADMINISTRADOR.ID = AUDITORIA.ID_USER
			  AND (AUDITORIA.ACAO_DESC LIKE '%$PESQUISA%' OR
				  ADMINISTRADOR.NOME LIKE '%$PESQUISA%' OR
				  ADMINISTRADOR.LOGIN LIKE '%$PESQUISA%')
			  AND AUDITORIA.DIN_REF BETWEEN '$DAT_INICIO' AND '$DAT_FIM'
			ORDER BY AUDITORIA.ID DESC";
	$RET = fnDB_DO_SELECT_WHILE($DB,$SQL);
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 3.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?=$TITULO?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/typeahead/typeahead.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="../dashboard/">
			<img src="../../assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<? include('../_top.php'); ?>
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<? include('../_menu.php'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Auditoria <small></small>
					</h3>
					<!--button type="button" class="btn red" style="right: 15px; position: absolute; margin-top: -40px" onClick="parent.location='novo.php'">Novo Cliente</button-->
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->



<!-- ------------------ -->
<div class="portlet box red">
						<div class="portlet-title_sem_titulo">
						</div>
						<div class="portlet-body form">
							<form role="form">
							<input type="hidden" name="dat_inicio" id="dat_inicio" value="" />
							<input type="hidden" name="dat_fim" id="dat_fim" value="" />
							<input type="hidden" name="dat_completa" id="dat_completa" value="" />
								<div class="form-body">
								<div class="row form-group">
													<div class="col-md-8">
														<label>Pesquisa</label>
														<input type="text" name="pesquisa" class="form-control" placeholder="Digite o termo de pesquisa..." value="<?=$PESQUISA?>">
													</div>



												</div>


								<div class="row form-group">


													<div class="col-md-4">
														<label>Período da Pesquisa</label>
														<div id="reportrange" class="form-control">
															<i class="fa fa-calendar"></i>
															&nbsp; <span>June 1, 2014 - June 30, 2014</span>
															<b class="fa fa-angle-down"></b>
														</div>
													</div>





												</div>

								</div>
								<div class="form-actions2">
																	<button type="submit" class="btn red">Pesquisar</button>
								</div>
							</form>
						</div>
					</div>
<!-- ------------------ -->


					<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box red">
						<div class="portlet-title_sem_titulo">
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th width="20%">
									 Usuário
								</th>
								<th>
									 IP
								</th>
								<th class="numeric">
									 Ação
								</th>
								<th class="numeric">
									 Hora
								</th>
							</tr>
							</thead>
							<tbody>
							<?
							foreach($RET as $KEY => $ROW)
								{
								$ROW['NOME'] = str_ireplace($PESQUISA,'<FONT style="BACKGROUND-COLOR: yellow">'.$PESQUISA.'</FONT>',$ROW['NOME']);
								$ROW['LOGIN'] = str_ireplace($PESQUISA,'<FONT style="BACKGROUND-COLOR: yellow">'.$PESQUISA.'</FONT>',$ROW['LOGIN']);
								$ROW['ACAO_DESC'] = str_ireplace($PESQUISA,'<FONT style="BACKGROUND-COLOR: yellow">'.$PESQUISA.'</FONT>',$ROW['ACAO_DESC']);

								?>
								<tr>
									<td>
										 <?=$ROW['NOME']?><br><?=$ROW['LOGIN']?>
									</td>
									<td>
										 <?=$ROW['IP']?>
									</td>
									<td>
										 <?=$ROW['ACAO_DESC']?>
									</td>
									<td>
										 <?=$ROW['DIN']?>
									</td>
								</tr>
								<?
								}
							?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->

		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <?=date("Y"); ?> &copy; <?=$TITULO?>
	</div>
	<div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {
			// initiate layout and plugins
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init() // init quick sidebar
			ComponentsPickers.init();

			$('#reportrange span').html('<?=$DAT_COMPLETA?>');
			$('#dat_inicio').val('<?=$DAT_INICIO?>');
			$('#dat_fim').val('<?=$DAT_FIM?>');
			$('#dat_completa').val('<?=$DAT_COMPLETA?>');
		});

    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
