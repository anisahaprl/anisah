<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

</head>
<!--Dimana session masih belum diinput-->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<title>Dapur Nenek</title>
        <link href='../css/bootstrap.css' rel='stylesheet' type='text/css'>
        <center><div class='container>
        	<div class='row'>
        	<div class='panel-primary'>
        	<br>
        <span><h1 class='text-primary'>Ops!</h1></span><br>
        <h5>Anda tidak berhak untuk mengakses halaman ini.</h5>";
  echo "<h6>Silakan</h6><a class='btn btn-primary' href=index.php><b>LOGIN</b></a></center>
  </div>
  </div>
  </div>";
}
else{
?>

<body>

	<!--Nabar-->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="media.php?module=home">Panel Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>				
		</div>
	</nav><!-- /.container-fluid -->
		
	<!--Manu bar-->
	<div id="sidebar-collapse" class="col-sm-1 col-lg-2 sidebar">
		<div class="panel-heading panel-white">Menu</div>
		<div class="panel body">
		<ul class="nav ">
			<li><a href="media.php?module=home"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>Home</a></li>
			<li><a href="media.php?module=resep"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Resep</a></li>
			<li><a href="media.php?module=kategori"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Kategori</a></li>
			<li><a href="media.php?module=user"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>User</a></li>
			<li><a href="forms.html"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
			<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
			<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Data Json
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="media.php?module=data-json-resep">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Resep
						</a>
					</li>
					<li>
						<a class="" href="media.php?module=data-json-kategori">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Kategori
						</a>
					</li>
					<li>
						<a class="" href="media.php?module=data-json-kota">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Kota
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="media.php?module=admin"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Admin</a></li>
		</ul>
</div>
</div>
	<!--/.sidebar-->

	<!--Menu Content-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<div class="col-lg-12">
				<div class="panel ">
					<div class="panel-heading panel-white">Dashboard</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<?php include "content.php"; ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		</div><!--/.row-->
		

						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	


	<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    config.language = 'es';
	config.uiColor = '#eee';
	config.height = 300;
	config.toolbarCanCollapse = true;
    $(".textarea").ckeditor();
  });
  CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#000';
	config.height = 300;
	config.toolbarCanCollapse = true;
};
</script>
</body>

</html>
<?php
}