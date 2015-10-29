<?php if (isset($this->datos) && count($this->datos)) { ?>
    <div class="navbar-inner text-center">
    
    <table id="table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>NRO. DOC.</th>
                    <th>PROVEEDOR</th>
                    <th>FECHA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
                    <tr>
                        <td><?php echo ($i+1) ?></td>
                        <td><?php echo $this->datos[$i]['NRODOC'] ?></td>
                        <td><?php echo $this->datos[$i]['PPROVEEDOR'] ?></td>
                        <td><?php echo $this->datos[$i]['FECHACOMPRA'] ?></td>
                        <td>
                            <a href="#myModal" role="button" data-toggle="modal" onclick="ver('<?php echo $this->datos[$i]['ID_COMPRA'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                            <?php if($this->datos[$i]['ESTADOPAGO'] == 0) {  ?>
                            <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL ?>compra/eliminar/<?php echo $this->datos[$i]['ID_COMPRA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <div id="controls">
        <div id="perpage">
            <select onchange="sorter.size(this.value)">
                <option value="5">5</option>
                <option value="10" selected="selected">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>Entradas por Página</span>
        </div>
        <div id="navigation">
            <img src="<?php echo BASE_URL ?>lib/img/first.gif" width="16" height="16" alt="Primera Página" onclick="sorter.move(-1,true)" />
            <img src="<?php echo BASE_URL ?>lib/img/previous.gif" width="16" height="16" alt="Página Anterior" onclick="sorter.move(-1)" />
            <img src="<?php echo BASE_URL ?>lib/img/next.gif" width="16" height="16" alt="Página Siguiente" onclick="sorter.move(1)" />
            <img src="<?php echo BASE_URL ?>lib/img/last.gif" width="16" height="16" alt="Última Página" onclick="sorter.move(1,true)" />
        </div>
        <div id="text">Página <span id="currentpage"></span> de <span id="pagelimit"></span></div>
    </div>

<?php } else { ?>
    <div class="navbar-inner text-center">
        <br/>
        <p>No hay compra</p>
        <a href="<?php echo BASE_URL ?>compra/nuevo" class="btn btn-primary">Nuevo</a>
    <?php } ?>
<!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel"></h3>
        </div>
        <div class="modal-body text-justify">
            <div id="bodymodal">
                <div class="text-center">
                    <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
        </div>
        </div>
        </div>
    </div>
