<div class="col-md-3">
                
                    
                    <div class="row carousel-holder"  >
                                   
                      <div class="panel panel-default">  
                        <div class="panel-heading" > 
                            
                            <span class="glyphicon glyphicon-calendar "></span>
                            <?php if (isset($this->evento) && count($this->evento)){ ?>
                             <?php for($i = 0; $i < count($this->evento); $i++){
                              
                                $dia=explode("-",$this->evento[$i]['FECHA_INICIO']);
                                
                             ?>   
                              <?php } ?>  
                                <strong >EVENTOS &nbsp;<?php echo $dia[0]?></strong>
                            <?php } ?> 
                            
                        </div> 

                        <div class="panel-body" id="inner-content-div" >  
                            
                            <ul class="media-list">
                          <?php if (isset($this->evento) && count($this->evento)){ ?>
                            <?php for($i = 0; $i < count($this->evento); $i++){

                                $dia=explode("-",$this->evento[$i]['FECHA_INICIO']);
//print_r($dia);exit();
                                $mes=" ";
                                switch ($dia[1]) {
                                   case 01:
                                       $mes="ENE";
                                       break;
                                   case 02:
                                       $mes="FEB";
                                       break;
                                   case 03:
                                       $mes="MAR";
                                       break;
                                   case 04:
                                       $mes="ABR";
                                       break;
                                   case 05:
                                       $mes="MAY";
                                       break;
                                   case 06:
                                       $mes="JUN";
                                       break;
                                   case 07:
                                       $mes="JUL";
                                       break;
                                   case 08:
                                       $mes="AGO";
                                       break;
                                   case 09:
                                       $mes="SET";
                                       break;
                                   case 10:
                                       $mes="OCT";
                                       break;
                                   case 11:
                                       $mes="NOV";
                                       break;
                                   case 12:
                                       $mes="DIC";
                                       break;
                               }
                             ?>   
                                <li class="media" >
                                    <div class="pull-left" >
                                      <div type="button" class="media-object" >
                                        <div class="lista_eventos"><?php echo $dia[2]?></br><?php echo $mes?></div>
                                      </div>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading"><strong><u>Comp. Fitness</u></strong></h5>
                                      <small><strong>Lugar:</strong> <?php if(isset ($this->evento[$i]['LUGAR']))echo $this->evento[$i]['LUGAR']?></small> </br>
                                      <small><strong>Hora:</strong> 3:00 pm</small>
                                    </div>
                                </li>
                                
                            <?php } ?>  
                                
                    <?php } ?>      
                            </ul>
                        
                        </div>
                        
                       </div> 

                    </div>
                <div class="row" >
                   <div class="panel panel-default"> 
                   <div class="panel-heading" > 
                                <span class="glyphicon glyphicon-thumbs-up"></span>
                                <strong >Visitanos</strong>
                   </div>     
                   <div class="fb-page" data-href="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts"
                         data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                        data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore">
                           <blockquote cite="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts">
                               <a href="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts">Olympo Fitness</a>
                           </blockquote></div>
                   </div>
                    </div>   
                </div>

                <div class="row" style="margin-top: 5%">
                     <div >
                        <div class="panel panel-default">  
                            <div class="panel-heading" > 
                                
                                <span class="glyphicon glyphicon-map-marker"></span>
                                
                                    <strong >Ubiquenos</strong>
                            </div> 
                            <div >
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7928.577112153539!2d-
                                    76.3594834!3d-6.4850947!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ba0c07765eff75%3A
                                    0xdb6f16d92c725847!2sJiron+San+Martin+422%2C+Tarapoto%2C+Per%C3%BA!5e0!3m2!1ses!
                                    2s!4v1443068297596" width="100%" height="170px" frameborder="0" style="border:0"
                                    allowfullscreen></iframe>
                            
                          
                            </div>
                        
                        </div>
                      </div><!-- /.login-box-body -->
                </div>
                   
                </div>   