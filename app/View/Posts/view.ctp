<div class="main-container">
    <h1><?php echo $post['Post']['title']; ?></h1>
    	<?php echo $this->Html->image($post['Post']['img'],array('class'=>'post-img')); ?>

   <?php echo $this->Text->excerpt($post['Post']['text'], 'method', 1500, ''); ?>

    <div class="std-button" onclick="showDownload();">
        Seguir Leyendo ...
    </div>
    <br/>
    <div class="app-popup">
        <div class="app-popup-box main-container">
            <div class="close-bt" onclick="closePopup(this);"></div>
            <div class="left">
                <h2> Descarga <b><?php echo $this->Html->image('logo.png',array('class'=>'logo')); ?></b></h2>
                <p>
                    Para continuar leyendo este articulo instala runti y ademas podras darte cuenta de <b>eventos, compartirlos</b> y <b>correrlos</b> de una forma muy <b>sencillo</b>.
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
