<?php
require_once("helpers/framework.php");
PFrameWork::init();
?>

<?php require_once("layout/bootstrap/common/head.php"); ?>

			<?php require_once("layout/bootstrap/common/navbar.php");?>

      <div class="container">
        <p class="lead">How many cost?</p>
				<h3>Precios - Desarrollo</h3>
				<p>Nuestros presupuestos de desarrollo se basan en horas. Cuando un cliente solicita un presupuesto realizamos un pre-análisis en base a los casos de uso, desglosando los requisitos en tareas y estableciendo un tiempo estimado para cada tarea. La suma de estos tiempos nos da el presupuesto para el cliente.</p>
				<div class="row-fluid">
					<div class="span4 well">
						<h4>Reducido</h4>
						<p>Es la tarifa más económica con la que trabajamos. Se aplica exclusivamente a proyectos de requerimientos bajos (portal web, aplicacion para móviles trivial, etc). Es establecida por nosotros y somos los que estamos capacitados para saber cuando tiene sentido.</p>
						<span class="img-rounded">30€/h</span>
					</div>
					<div class="span4 well">
						<h4>Normal</h4>
						<p>Es la tarifa que aplicamos normalmente. El desarrollo del trabajo es realizado a medida que podemos incorporarlo a nuestro timeline, junto a otros proyectos. Normalmente los tiempos de desarrollo suelen ser entre 30 y 90 días, dependiendo de la complejidad del proyecto.</p>
						<span class="img-rounded">36€/h</span>
					</div>
					<div class="span4 well">
						<h4>Urgente</h4>
						<p>Es la tarifa a aplicar cuando hay requerimientos importantes de tiempo. En este caso garantizamos un tiempo de respuesta menor de 12 horas (comenzaremos a trabajar en menos de ese tiempo en su producto, requisito o problema). Cabe señalar que no ofrecemos este servicio a cualquier cliente, para garantizar nuestra disponibilidad se debe establecer una cuota previa mensual.</p>
						<span class="img-rounded">50€/h</span>
					</div>
				</div>
			</div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
