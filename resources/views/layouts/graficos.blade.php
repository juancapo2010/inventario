@section('graficos')
	<h1 class="text-center">Gráficas de Empresas</h1>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div id="grafica1" style="min-width: 310px; height: 300px;"></div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div id="grafica2" style="min-width: 310px; height: 300px;"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div id="grafica3" style="min-width: 310px; height: 300px;"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div id="grafica4" style="min-width: 310px; height: 300px;"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div id="grafica5" style="min-width: 310px; height: 300px;"></div>
			</div>
		</div>

		<h3 class="text-center">Cantidad de Solicitudes por Empresa <a href="{{ route('home') }}" class="label label-primary">Ver detalle</a></h3>

		<div class="panel-group" role="tablist">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse1" onclick="mostrarOcultar(this)">Empresa A - Empresa B - Empresa C</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in" aria-expanded="true">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica6" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica7" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica8" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse2" onclick="mostrarOcultar(this)">Empresa D - Empresa E - Empresa F</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica9" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica10" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica11" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse3" onclick="mostrarOcultar(this)">Empresa G - Empresa H - Empresa I</h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica12" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica13" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica14" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse4" onclick="mostrarOcultar(this)">Empresa J - Empresa K - Empresa L</h4>
				</div>
				<div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica15" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica16" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica17" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse5" onclick="mostrarOcultar(this)">Empresa M - Empresa N - Empresa Ñ</h4>
				</div>
				<div id="collapse5" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica18" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica19" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica20" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse6" onclick="mostrarOcultar(this)">Empresa O - Empresa P - Empresa Q</h4>
				</div>
				<div id="collapse6" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica21" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica22" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica23" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse7" onclick="mostrarOcultar(this)">Empresa R - Empresa S - Empresa T</h4>
				</div>
				<div id="collapse7" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica24" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica25" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="grafica26" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" data-target="#collapse8" onclick="mostrarOcultar(this)">Empresa U</h4>
				</div>
				<div id="collapse8" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div id="grafica27" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="graficaXX" style="min-width: 310px; height: 300px;"></div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div id="graficaXXX" style="min-width: 310px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection