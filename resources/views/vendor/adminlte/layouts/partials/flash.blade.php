   <div class="container">
        @if (Session::has('errors'))
        	<div class="row">
				<div class="col-md-10 col-md-offset-1">
				    <div class="alert alert-warning alert-dismissible" role="alert">
				    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<ul>
				            <strong>!!! Atencion, Mensaje Importante !!!</strong>
						    @foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
					        @endforeach
					    </ul>
				    </div>
				</div>
			</div>
		@endif
        @if (Session::has('status'))
        	<div class="row">
				<div class="col-md-10 col-md-offset-1">
				    <div class="alert alert-success alert-dismissible alert-ok" role="alert">
				    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<ul>
				            <strong>!!! Atencion, Mensaje Importante !!!</strong>
							<li>{{ Session::get('status') }}</li>
				        </ul>
				    </div>
				</div>
			</div>
		@endif		
    </div>