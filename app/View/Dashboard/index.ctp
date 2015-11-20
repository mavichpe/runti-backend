
<div id="select-dashboard">
    <div class="top-dashboard">Seleccione una opción</div>
    <div class="option-box" style="width: 50px;">
    </div>
    <ul>
        <li>
            <?php echo $this->Html->link('Eventos',array('controller'=>'events')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Lugares de Inscripcion',array('controller'=>'places')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Elementos de Kits',array('controller'=>'kitelements')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Organizadores',array('controller'=>'organizers')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Patrocinadores',array('controller'=>'sponsors')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Articulos',array('controller'=>'posts')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Albunes',array('controller'=>'albums')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Imagenes',array('controller'=>'images')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Usuarios',array('controller'=>'users')) ?>
        </li>
    </ul>

</div>