<div class="main-container">
    <br/>
    <?php echo  $this->Html->image('events/logo.png', array('class'=>'post-img'));?>
    <br/>
    <br/>
    <div class="center big">
        <b><?php echo $user["User"]["nombre"] ." " .$user["User"]["apellido"]?></b> va a
    </div>
    <?php echo  $this->Html->image('events/correr-evento.png', array('class'=>'correr-evento'));?>

    <script>
        enAccion = false;
        function showSubMenu(seccion) {
            if (!enAccion) {
                enAccion = true;
                $('.event-menu-content').find('> div').slideUp(600);
                $('.event-menu-content').show().find('.' + seccion).slideDown(600);
                setTimeout(function () {
                    enAccion = false;
                }, 600);
            }
        }
    </script>

    <div class="race-info">
        <ul>
            <li onclick="showSubMenu('lugar')">
                <?php echo  $this->Html->image('events/lugar.png');?>
                Lugar
            </li>
            <li onclick="showSubMenu('hora')">
                <?php echo  $this->Html->image('events/hora.png');?>
                Hora
            </li>
            <li onclick="showSubMenu('costo')">
                <?php echo  $this->Html->image('events/costo.png');?>
                Costo
            </li>
        </ul>
    </div>
    <div class="event-menu-content"  style="display: none" >
        <div class="lugar"  style="display: none">
            <!-- ngRepeat: ruta in event.Trip -->
            <?php foreach($event['Trip'] as $trip){ ?>
            <div class="ruta">
                <div class="info">
                    <div class="lugar ng-binding">
                        <b>Salida:</b> <?php echo $trip['start']; ?> <br>
                        <b>Meta:</b> <?php echo $trip['end']; ?>
                    </div>
                </div>
                <div class="distancia ng-binding">
                    <?php echo $trip['distance']; ?> K
                </div>
            </div><!-- end ngRepeat: ruta in event.Trip -->
            <?php }?>
        </div>
        <div class="hora"  style="display: none">
            <!-- ngRepeat: ruta in event.Trip -->
            <?php foreach($event['Trip'] as $trip){ 
                ?>
            <div class="ruta">
                <div class="info">
                    <div class="hora ng-binding">
                        Hora Salida: <b><?php echo $trip['formatedTime']; ?> </b>
                    </div>
                </div>
                <div class="distancia ng-binding">
                    <?php echo $trip['distance']; ?> K
                </div>
            </div><!-- end ngRepeat: ruta in event.Trip -->
            <?php }?>

        </div>
        <div class="costo"  style="display: none">
            <!-- ngRepeat: ruta in event.Trip -->
            <?php foreach($event['Trip'] as $trip){ 
                ?>
            <div class="ruta">
                <div class="info ng-binding">
                    Costo: <?php echo $trip['costo']; ?>
                </div>
                <div class="distancia ng-binding">
                    <?php echo $trip['distance']; ?> K
                </div>
            </div>
            <?php }?>
        </div>
        <div class="social" initial-heigth="10" style="transform: translate3d(0px, -10px, 0px);">
            <ul>
                <!-- ngRepeat: element in event.Social -->
            </ul>
        </div>
    </div>
    <div></div>

    <div style="clear: both;"></div>

    <div class="std-button no-background" onclick="showDownload();">
        Mas informacion ...
    </div>
        <?php echo  $this->Html->image('events/img-botton.png', array('class'=>'post-img'));?>
    <br/>
    <div class="app-popup">
        <div class="app-popup-box main-container">
            <div class="close-bt" onclick="closePopup(this);"></div>
            <div class="left">
                <h2> Descarga <b><?php echo $this->Html->image('logo.png',array('class'=>'logo')); ?></b></h2>
                <p>
                    Para obtener mas informacion acerca de este evento instala runti y ademas podras darte cuenta de <b>eventos, compartirlos</b> y <b>correrlos</b> de una forma muy <b>sencillo</b>.
                    Compartir <b>fotos, mensajes, stickers o chatear</b> ahora también es parte de correr.
                </p>
                <br>
            	<?php echo $this->Html->image('view-layout-img/last-image.png',array('class'=>'message')); ?>


            </div>
            <div class="right">
                <div class="half">
                    <p >Disponible en:</p>
                    <a href="#">
            <?php echo $this->Html->image('view-layout-img/google.png'); ?>
                    </a>
                </div>
                <div class="half">
                    <p >Muy Pronto en:</p>
                    <a href="#">
            <?php echo $this->Html->image('view-layout-img/apple.png'); ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="mask"></div>

</div>
<script>
    function showDownload() {
        $('.app-popup').addClass('show');
        $('.mask').addClass('show');
    }
    function closePopup(element) {
        $(element).closest('.show').removeClass('show');
        $('.mask').removeClass('show');
    }
</script>
