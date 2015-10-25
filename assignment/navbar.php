<?php
	include "catalogue.php";
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/assignment/">Buy Games</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right" id ="boldText">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle", data-toggle="dropdown" role="button" aria-expanded="false">Genre<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php foreach ($categories as $key => $value): ?>
							<li>
								<a href="/<?=$key?>/"><?=$value->name?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</li>
				<li>
					<a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
				</li>
			</ul>
		</div>
	</div>
</nav>