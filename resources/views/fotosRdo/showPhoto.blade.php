
<div class='btn-group'>
    <a data-toggle="modal" href="#fotoModal" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>        
</div>

<!-- Modal -->
<div class="modal fade" id="fotoModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
        </div>
        <div class="modal-body">
          <img width="100%" src="{{$UrlParaRelatorio}}" />
        </div>        
      </div>
      
    </div>
  </div>
