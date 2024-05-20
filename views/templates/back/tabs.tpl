<div class="panel">
    <h3>Configuración</h3>
    <ul class="nav nav-tabs" id="tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Vacaciones</a></li>
        <li><a href="#tab2" data-toggle="tab">Tiempos</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            {$od_deliverytime_holidays}
        </div>
        <div class="tab-pane" id="tab2">
            {$od_deliverytime_times}
        </div>
    </div>
</div>

{literal}
<script>
    $(document).ready(function(){
        $('#tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
{/literal}
