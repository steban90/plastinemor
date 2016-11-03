<div class="" id="chat-head" >

    <form id="form-send-file" style="display: none;">
        <input type="file" id="trigger-upload-window" name="plasti_file" required/>
        <input type="text" id="hidden-form-id-empresa" name="id_empresa"/>
    </form>

    <div class="" id="chat-body" >
        <div class="panel panel-primary" >

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8">
                        <h6 class="panel-title small small-title"></h6>
                    </div>
                    <div class="col-xs-2 ">
                        <i class="fa fa-upload " id="upload-btn" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-2 ">
                        <button type="button" class="close " >&times;</button>
                    </div>    
                </div>
            </div>
            <div class="panel-body">

                <div class="container-flex messages-container">

                    <div class="center-block auto-msg chat-msg">
                        <p class="small white">Escriba su mensaje, responderémos lo más pronto posible</p>                       
                    </div>                  

                </div>

                <div class="" >
                    <form id="messaging-form" class="no-pad">
                        <div class="col-xs-10 no-pad">
                            <input type="text" name="txt" class="form-control form-control-sm no-pad" placeholder="Su mensaje..." 
                                   autocomplete="false" required/>
                            <input type="hidden" name="id_empresa" value="" class="no-pad" id="msg_id_empresa" />
                        </div>
                        <div class="col-xs-2 no-pad">
                            <button type="submit" class="btn btn-flat btn-success ">
                                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                            </button>
                        </div> 
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
