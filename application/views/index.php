<!DOCTYPE html>
<html>
<head>
	<?php my_head(); ?>
</head>
<body>
	<div id="header" class="container-fluid">
		 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>
	</div>
	<div id="content" class="container">
		  
	</div>
	<div id="footer" class="container-fluid">
		
	</div>
	<!-- All script and js -->
	<?php my_foot(); ?>
</body>
</html>