<div id="search-result-content">
    <p>
        <img src="<?php echo $data['url_imagine'] ?>" alt="Poza <?php echo $data['termen_cautat'] ?>">
        <label>Afectiuni Tratate: </label>
        <span>
            <?php $i = count($data['afectiuni_tratate']) ?>
            <?php $j = 0 ?>
            <?php foreach($data['afectiuni_tratate'] as $afectiuni_tratate): ?>
            <?php $j++ ?>
            <a href="<?php echo base_url("view/{$afectiuni_tratate}/disease") ?>"><?php echo $afectiuni_tratate ?></a><?php if ($j !== $i): ?>, <?php endif; ?>
            <?php endforeach; ?>
        </span>
    </p>
    <p>
        <label>Termen Cautat: </label>
        <span><?php echo $data['termen_cautat'] ?></span>
    </p>
    <p>
    <label>Denumire Populara: </label>
    <span><?php echo $data['denumire_populara'] ?></span>
    </p>
    <p>
        <label>Denumire Stiintifica: </label>
        <span><?php echo $data['denumire_stiintifica'] ?></span>
    </p>
    <p>
        <label>Mod de Preparare</label>
        <span><?php echo $data['mod_preparare'] ?></span>
    </p>
</div>