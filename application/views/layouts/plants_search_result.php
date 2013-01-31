<div id="search-result-content">
    <p>
        <img src="<?php echo $data['url_imagine'] ?>" alt="Poza <?php echo $data['termen_cautat'] ?>">
        <label>Afectiuni Tratate: </label>
        <span>
            <?php foreach($data['afectiuni_tratate'] as $afectiuni_tratate): ?>
                <?php echo $afectiuni_tratate ?>, 
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