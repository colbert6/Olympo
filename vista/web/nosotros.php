<section  class="row" style="border-radius: 5px;margin: 1%;">
               
    <div class="row">
        
        <div class="col-md-8 ">
            <h3 class="col-lg-offset-1">    
                <strong> BIENVENIDOS</strong>
            </h3>
                <hr>
            <div class="media-right media-left">
                    <p class="text-justify">
                    <?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?>
                    </p>
                    <img 
                    style="width: 635px; height: 90px;"
                    src="<?php echo $_webParams['ruta_img']; ?>10.jpg" alt=""> 
             </div>

        </div>
        
        <div class="col-md-4">
            <h4 class=""><strong>VISION</strong></h4>
                <p class="text-justify">
                    <?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?>
                </p>
                
            <hr>  
            
            <h4 class=""><strong>MISION</strong></h4>
                <p class="text-justify">
                    <?php if(isset ($this->datos[0]['MISION']))echo $this->datos[0]['MISION']?>
                </p>
         </div>
               
    </div><!--/.row-->

        