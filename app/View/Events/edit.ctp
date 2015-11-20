<div class="events form">
<?php 
$eventId = $this->request->data['Event']['id'];
$currentPage = base64_encode('/events/edit/'.$eventId);
echo $this->Form->create('Event',array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Agregar Event'); ?></legend>
	<?php
                echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('fecha');
		echo $this->Form->input('organizer_id');
         	echo $this->Form->input('facelink',array('label'=>'Enlace Evento en facebook'));
		echo $this->Form->input('fecha_inscripcion');
		echo $this->Form->input('kit-delivery');
		echo $this->Form->input('description');
	?>
        <legend>Rutas</legend>
        <div class="externalFields">
                <?php
                echo $this->Form->input('Trip.start',array('name'=>'custom','label'=>'Salida','required'=>false));
                echo $this->Form->input('Trip.end',array('name'=>'custom','label'=>'Meta','required'=>false));
		echo $this->Form->input('Trip.distance',array('type'=>"text",'name'=>'custom','label'=>'Distancia','required'=>false));
		echo $this->Form->input('Trip.costo',array('type'=>"text",'name'=>'custom','required'=>false));
                echo $this->Form->input('Trip.hora',array('name'=>'custom','label'=>'Hora Salida','required'=>false));
	?>
        </div>
        <button class="button" type="button" onclick="addTrip()">Agregar</button>

        <table>
            <thead>
                <tr>
                    <th>Salida</th>
                    <th>Meta</th>
                    <th>Distacia</th>
                    <th>Costo</th>
                    <th>Hora Salida</th>
                    <th>Imagenes</th>
                    <th>Acciones</th>
            <form style="display: none;"></form>
            </th>
            </tr>
            <tbody class="TripsList">
                <?php 
                $keyTrip = -1;
                foreach ($this->request->data['Trip'] as $keyTrip => $trip){ ?>
                <tr>
                    <td><?php echo $trip['start'] ?></td>
                    <td><?php echo $trip['end'] ?></td>
                    <td><?php echo $trip['distance'] ?></td>
                    <td><?php echo $trip['costo'] ?></td>
                    <td><?php echo $trip['hora'] ?></td>
                    <td>
                    <?php 
                    if (isset($trip['mapa']) and $trip['mapa'] != '')
                        echo $this->Html->image($trip['mapa'],array('style'=>'width:200px;height:auto'));
                    echo $this->Form->input('Trip.'.$keyTrip.'.mapa', array('type'=>'file'));
                    if (isset($trip['altimetria']) and $trip['altimetria'] != '')
                        echo $this->Html->image($trip['altimetria'],array('style'=>'width:200px;height:auto'));
                    echo $this->Form->input('Trip.'.$keyTrip.'.altimetria', array('type'=>'file')); ?>
                    </td>
                    <td>

                        <?php echo $this->Form->postLink(__('Eliminar'), array('controller'=>'trips','action' => 'deleteAndRedirect', $trip['id'],$currentPage), null, __('Esta seguro que deseas eliminar esta ruta?')); ?>
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][id]" value="<?php echo $trip['id'] ?>">
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][start]" value="<?php echo $trip['start'] ?>">
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][end]" value="<?php echo $trip['end'] ?>">
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][distance]" value="<?php echo $trip['distance'] ?>">
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][costo]" value="<?php echo $trip['costo'] ?>"> 
                        <input type="hidden" name="data[Trip][<?php echo $keyTrip ?>][hora]" value="<?php echo $trip['hora'] ?>"> 
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br/>
        <br/>
        <legend>Lugares de Inscripcion</legend>
        <div class="externalFields">
            <div style="float: left; width: 45%; clear: none;">

                <?php
                echo $this->Form->input('Place.place_id',array('name'=>'custom','label'=>'Lugar','required'=>false));
	?>
                <button class="button" type="button" onclick="addPlace()">Agregar</button>
            </div>
            <div style="float: left; width: 45%; clear: none;">
                <?php
                echo $this->Form->input('Place.title',array('id'=>'NewPlaceTitle','name'=>'custom','label'=>'Lugar','required'=>false));
                echo $this->Form->input('Place.telefono',array('id'=>'NewPlaceTelefono','name'=>'custom','label'=>'Telefono','required'=>false));
?>
                <button class="button" type="button" onclick="addNewPlace()">Agregar</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            <tbody class="PlaceList">
               <?php $keyPlace = -1;
               foreach ($this->request->data['Place'] as $keyPlace => $place){ ?>
                <tr>
                    <td><?php echo $place['title'] ?></td>
                    <td>
                        <?php 
                        echo $this->Form->postLink(__('Eliminar'), array('controller'=>'eventsplaces','action' => 'deleteAndRedirect', $place['EventsPlace']['id'],$currentPage), null, __('Esta seguro que deseas eliminar esta ruta?')); ?>
                        <input type="hidden" name="data[Place][<?php echo $keyPlace ?>][id]" value="<?php echo $place['EventsPlace']['id'] ?>">
                        <input type="hidden" name="data[Place][<?php echo $keyPlace ?>][place_id]" value="<?php echo $place['id'] ?>"> 
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br/>
        <br/>
        <legend>Elementos del kit</legend>
        <div class="externalFields">
            <div style="float: left; width: 45%;">
                <?php
                echo $this->Form->input('Kitelement.kitelemet_id',array('name'=>'custom','label'=>'Elemento','required'=>false));
	?>
                <button class="button" type="button" onclick="addKitElement()">Agregar</button>

            </div>
            <div style="float: left; width: 45%; clear: none;">
                <?php
                echo $this->Form->input('Kitelement.title',array('name'=>'custom','label'=>'Nombre','required'=>false));
	?>
                <button class="button" type="button" onclick="addNewKitElement()">Agregar</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Elemento</th>
                    <th>Acciones</th>
                </tr>
            <tbody class="KitelementList">
               <?php $keyKitelement = -1;
               foreach ($this->request->data['Kitelement'] as $keyKitelement => $kitElement){ ?>
                <tr>
                    <td><?php echo $kitElement['title'] ?></td>
                    <td>
                        <?php 
                        echo $this->Form->postLink(__('Eliminar'), array('controller'=>'eventskitelements','action' => 'deleteAndRedirect', $kitElement['EventsKitelement']['id'],$currentPage), null, __('Esta seguro que deseas eliminar esta Elemento?')); ?>
                        <input type="hidden" name="data[Kitelement][<?php echo $keyKitelement ?>][id]" value="<?php echo $kitElement['EventsKitelement']['id'] ?>">
                        <input type="hidden" name="data[Kitelement][<?php echo $keyKitelement ?>][kitelement_id]" value="<?php echo $kitElement['id'] ?>"> 
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br/>
        <br/>
        <br/>
        <legend>Social</legend>
        <div class="externalFields">
                <?php
                echo $this->Form->input('Social.tipo',array('name'=>'custom','label'=>'Tipos','options'=>array('web'=>'Sitio Web','facebook'=>'Facebook'),'required'=>false));
                echo $this->Form->input('Social.value',array('name'=>'custom','label'=>'URL ','required'=>false));
	?>
        </div>
        <button class="button" type="button" onclick="addSocial()">Agregar</button>

        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>URL</th>
                    <th>Acciones
            <form style="display: none;"></form>
            </th>
            </tr>
            <tbody class="SocialList">
                <?php 
                $keySocial = -1;
                foreach ($this->request->data['Social'] as $keySocial => $social){ ?>
                <tr>
                    <td><?php echo $social['tipo'] ?></td>
                    <td><?php echo $social['value'] ?></td>
                    <td>

                        <?php echo $this->Form->postLink(__('Eliminar'), array('controller'=>'socials','action' => 'deleteAndRedirect', $social['id'],$currentPage), null, __('Esta seguro que deseas eliminar este enlace social?')); ?>
                        <input type="hidden" name="data[Social][<?php echo $keySocial ?>][id]" value="<?php echo $social['id'] ?>">
                        <input type="hidden" name="data[Social][<?php echo $keySocial ?>][tipo]" value="<?php echo $social['tipo'] ?>">
                        <input type="hidden" name="data[Social][<?php echo $keySocial ?>][value]" value="<?php echo $social['value'] ?>">
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br/>
        <br/>
        <legend>Entrega de Kit</legend>
        <div class="externalFields">
                <?php
		echo $this->Form->input('Kitdeliver.place_id',array('name'=>'custom','label'=>'Lugar','required'=>false));
                echo $this->Form->input('Kitdeliver.fecha',array('name'=>'custom','label'=>'Fecha','required'=>false));
                echo $this->Form->input('Kitdeliver.start',array('name'=>'custom','label'=>'Hora Inicio','required'=>false));
                echo $this->Form->input('Kitdeliver.end',array('name'=>'custom','label'=>'Hora Final','required'=>false));
	?>
        </div>
        <button class="button" type="button" onclick="addDeliver()">Agregar</button>

        <table>
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Acciones
            <form style="display: none;"></form>
            </th>
            </tr>
            <tbody class="KitdeliverList">
                <?php 
                $keyDeliver = -1;
                foreach ($this->request->data['Kitdeliver'] as $keyDeliver => $kitdeliver){ ?>
                <tr>
                    <td><?php echo $places[$kitdeliver['place_id']]; ?></td>
                    <td><?php echo $kitdeliver['fecha'] ?></td>
                    <td><?php echo $kitdeliver['start'] ?></td>
                    <td><?php echo $kitdeliver['end'] ?></td>
                    <td>

                        <?php echo $this->Form->postLink(__('Eliminar'), array('controller'=>'kitdelivers','action' => 'deleteAndRedirect', $kitdeliver['id'],$currentPage), null, __('Esta seguro que deseas eliminar este fecha de entrega de kit?')); ?>
                        <input type="hidden" name="data[Kitdeliver][<?php echo $keyDeliver ?>][id]" value="<?php echo $kitdeliver['id'] ?>">
                        <input type="hidden" name="data[Kitdeliver][<?php echo $keyDeliver ?>][fecha]" value="<?php echo $kitdeliver['fecha'] ?>">
                        <input type="hidden" name="data[Kitdeliver][<?php echo $keyDeliver ?>][place_id]" value="<?php echo $kitdeliver['place_id'] ?>">
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br/>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Dashboard'), array('controller'=>'dashboard','action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Lista de Eventos'), array('controller' => 'events', 'action' => 'index')); ?> </li>
    </ul>
</div>

<script>
    var tripIndex = <?php echo $keyTrip +1; ?>;
    var placeIndex = <?php echo $keyPlace +1; ?>;
    var kitelementIndex = <?php echo $keyKitelement +1; ?>;
    var socialIndex = <?php echo $keySocial +1; ?>;
    var deliverIndex = <?php echo $keyDeliver +1; ?>;

    function addTrip() {
        var start = $('#TripStart');
        var costo = $('#TripCosto');
        var end = $('#TripEnd');
        //var mapa = $('#EstimateTime');
        var distance = $('#TripDistance');
        var horaSalida = '';
        var hora = parseInt($('#TripHoraHour').val());
        var minutos = $('#TripHoraMin').val();
        var zona = $('#TripHoraMeridian').val();
        if (zona == 'pm') {
            hora += 12;
        }
        horaSalida = hora + ':' + minutos + ':00';
        var fila = $('<tr/>');
        fila.append('<td>' + start.val() + '</td>');
        fila.append('<td>' + end.val() + '</td>');
        fila.append('<td>' + distance.val() + '</td>');
        fila.append('<td>' + costo.val() + '</td>');
        fila.append('<td>' + horaSalida + '</td>');
        var columna = $('<td></td>');
        var mapa = $('<div class="input file"><label>Mapa</label><input type="file" name="data[Trip][' + tripIndex + '][mapa]" ></div>');
        columna.append(mapa);
        var altimetria = $('<div class="input file"><label>Altimetria</label><input type="file" name="data[Trip][' + tripIndex + '][altimetria]" ></div>');
        columna.append(altimetria);

        fila.append(columna);
        var data = $('<span/>');
        data.append('<input type="hidden"  name="data[Trip][' + tripIndex + '][start]" value="' + start.val() + '">');
        data.append('<input type="hidden"  name="data[Trip][' + tripIndex + '][end]" value="' + end.val() + '">');
        data.append('<input type="hidden"  name="data[Trip][' + tripIndex + '][distance]" value="' + distance.val() + '">');
        data.append('<input type="hidden"  name="data[Trip][' + tripIndex + '][costo]" value="' + costo.val() + '">');
        data.append('<input type="hidden"  name="data[Trip][' + tripIndex + '][hora]" value="' + horaSalida + '">');
        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
        $('.TripsList').append(fila);
        tripIndex++;
    }

    function addSocial() {
        var tipo = $('#SocialTipo');
        tipo = tipo.find('option:selected').text();
        var value = $('#SocialValue').val();
        var fila = $('<tr/>');
        fila.append('<td>' + tipo + '</td>');
        fila.append('<td>' + value + '</td>');
        var data = $('<span/>');
        data.append('<input type="hidden"  name="data[Social][' + socialIndex + '][tipo]" value="' + $('#SocialTipo').val() + '">');
        data.append('<input type="hidden"  name="data[Social][' + socialIndex + '][value]" value="' + value + '">');
        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
        $('.SocialList').append(fila);
        socialIndex++;
    }

    function addDeliver() {
        var lugar = $('#KitdeliverPlaceId');
        var fecha = '';
        var mes = $('#EventFechaMonth').val();
        var dia = $('#EventFechaDay').val();
        var ano = $('#EventFechaYear').val();
        fecha = ano + '-' + mes + '-' + dia;

        var horaInicio = '';
        var hora = parseInt($('#KitdeliverStartHour').val());
        var minutos = $('#KitdeliverStartMin').val();
        var zona = $('#KitdeliverStartMeridian').val();
        if (zona == 'pm') {
            hora += 12;
        }
        horaInicio = hora + ':' + minutos + ':00';

        var horaFinal = '';
        hora = parseInt($('#KitdeliverEndHour').val());
        minutos = $('#KitdeliverEndMin').val();
        zona = $('#KitdeliverEndMeridian').val();
        if (zona == 'pm') {
            hora += 12;
        }
        horaFinal = hora + ':' + minutos + ':00';

        var fila = $('<tr/>');
        fila.append('<td>' + lugar.find('option:selected').text() + '</td>');
        fila.append('<td>' + fecha + '</td>');
        fila.append('<td>' + horaInicio + '</td>');
        fila.append('<td>' + horaFinal + '</td>');
        var data = $('<span/>');
        data.append('<input type="hidden"  name="data[Kitdeliver][' + deliverIndex + '][fecha]" value="' + fecha + '">');
        data.append('<input type="hidden"  name="data[Kitdeliver][' + deliverIndex + '][place_id]" value="' + lugar.val() + '">');
        data.append('<input type="hidden"  name="data[Kitdeliver][' + deliverIndex + '][start]" value="' + horaInicio + '">');
        data.append('<input type="hidden"  name="data[Kitdeliver][' + deliverIndex + '][end]" value="' + horaFinal + '">');
        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
        $('.KitdeliverList').append(fila);
        deliverIndex++;
    }

    function addPlace() {
        var place = $('#PlacePlaceId');
        var fila = $('<tr/>');
        fila.append('<td>' + place.find('option:selected').text() + '</td>');
        var data = $('<span/>');
        data.append('<input type="hidden"  name="data[Place][' + placeIndex + '][place_id]" value="' + place.val() + '"></td>');
        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
        $('.PlaceList').append(fila);
        placeIndex++;
    }

    function addNewPlace() {
        var place = $('#NewPlaceTitle');
        var telefono = $('#NewPlaceTelefono');
        place = place.val();
        telefono = telefono.val();
        if (place.length > 0) {
            $.ajax({
                type: 'POST',
                async: false,
                url: '<?php echo Router::url(array('controller'=>'places','action'=>'add')); ?>',
                data: {
                    Place: {
                        title: place,
                        telefono: telefono
                    }
                },
                dataType: 'json',
                success: function (response) {
                    if (response.store) {
                        var fila = $('<tr/>');
                        fila.append('<td>' + place + '</td>');
                        var data = $('<span/>');
                        data.append('<input type="hidden"  name="data[Place][' + placeIndex + '][place_id]" value="' + response.id + '">');
                        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
                        $('.PlaceList').append(fila);
                        placeIndex++;
                        $('#NewPlaceTitle').val('');
                        $('#NewPlaceTelefono').val('');
                        $('#PlacePlaceId').append($('<option value="' + response.id + '">' + place + '</option>'));
                        $('#EventPlaceId').append($('<option value="' + response.id + '">' + place + '</option>'));
                        $('#KitdeliverPlaceId').append($('<option value="' + response.id + '">' + place + '</option>'));
                    }
                },
                error: function () {
                    alert('Error al agregar el nuevo Lugar de inscripcion');
                }
            });
        }

    }

    function addKitElement() {
        var kitelement = $('#KitelementKitelemetId');
        var fila = $('<tr/>');
        fila.append('<td>' + kitelement.find('option:selected').text() + '</td>');
        var data = $('<span/>');
        data.append('<input type="hidden"  name="data[Kitelement][' + kitelementIndex + '][kitelement_id]" value="' + kitelement.val() + '">');
        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
        $('.KitelementList').append(fila);
        kitelementIndex++;
    }

    function addNewKitElement() {
        var kitelement = $('#KitelementTitle');
        kitelement = kitelement.val();
        if (kitelement.length > 0) {
            $.ajax({
                type: 'POST',
                async: false,
                url: '<?php echo Router::url(array('controller'=>'kitelements','action'=>'add')); ?>',
                data: {
                    Kitelement: {
                        title: kitelement
                    }
                },
                dataType: 'json',
                success: function (response) {
                    if (response.store) {
                        var fila = $('<tr/>');
                        fila.append('<td>' + kitelement + '</td>');
                        var data = $('<span/>');
                        data.append('<input type="hidden"  name="data[Kitelement][' + kitelementIndex + '][kitelement_id]" value="' + response.id + '">');
                        fila.append('<td> <a href="javascript:void(0)" onclick="removeRow(this);"> Eliminar </a> ' + data.html() + ' </td>');
                        $('.KitelementList').append(fila);
                        kitelementIndex++;
                        $('#KitelementTitle').val('');
                        $('#KitelementKitelemetId').append($('<option value="' + response.id + '">' + kitelement + '</option>'));
                    }
                },
                error: function () {
                    alert('Error al agregar el nuevo elemento');
                }
            });
        }

    }

    function removeRow(element) {
        $(element).closest('tr').remove();
    }
    $(function () {
        $('.externalFields input').keydown(function (e) {
            if (e.keyCode == 13)
                e.preventDefault();
        });
        var forms = $('#EventEditForm').find('form');
        $('body').append(forms);
        $('#EventEditForm').find('form').remove();
    });

</script>