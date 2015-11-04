<?php
	require_once "catalogue.php";
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/PHPAssignment/src/"><span class="blue">B</span>uy <span class="blue">G</span>ames</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right" id ="boldText">
				<li>
					<a href="/PHPAssignment/src/"><strong><span class="blue">H</span>ome</strong></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong><span class="blue">G</span>enre<span class="caret"></span></strong></a>
					<ul class="dropdown-menu" role="menu">
						<?php foreach ($categories as $key => $value): ?>
							<li>
								<!-- /<?=$key?>/ -->
								<a href="#"><strong><?=$value->name?></strong></a>
							</li>
						<?php endforeach ?>
					</ul>
				</li>
				<li>
					<a href="cart.php"><strong><i class="fa fa-shopping-cart blue"></i></strong></a>
				</li>
			</ul>
		</div>
	</div>
</nav>