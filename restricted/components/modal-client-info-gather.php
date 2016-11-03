<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-client-info-gather"
        id="btn-gather-client-info" style="display: none;">
    gather info
</button>

<div id="modal-client-info-gather" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close-modal-gather-info" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por Favor Ingrese Su Información</h4>
            </div>

            <div class="modal-body">
                <form id="form-gather-client-info">

                    <div class="form-group">
                        <label for="id_empresa">Empresa:</label>
                        <input type="text" id="id_empresa" name="id_empresa" class="form-control"
                               placeholder="Ingrese el nombre de la empresa"/>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="text" id="correo" name="correo" class="form-control"
                               placeholder="Ingrese un correo de contacto"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-flat btn-info btn-block">
                            Iniciar Chat
                            &nbsp;<i class="fa fa-chack" aria-hidden="true"></i>
                        </button>
                    </div>                        

                </form>
            </div>            
        </div>

    </div>
</div>