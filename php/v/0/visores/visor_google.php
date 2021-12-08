<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex bg-dark">
        <h4 class="m-0 align-self-center text-white"><?php echo $_POST['titulo_documento']?></h4>
	    <button id="cerrar_visor" class="btn btn-sm btn-primary rounded ml-auto"><i class="fas fa-times fa-sm"></i> <span class="text">Cerrar</span></button>
    </div>	
	<iframe src="https://docs.google.com/viewer?url=https://bexpress.mx/git/bexpress_new/<?php echo $_POST['url_documento'];?>&embedded=true" style="width: 100%; height: 1150px" frameborder="0"></frame>
</div>