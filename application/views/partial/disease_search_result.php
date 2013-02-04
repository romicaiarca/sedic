<div id="search-result-content">
    <p>
        <label>Se trateaza cu plantele: </label>
        <span>
            <?php $i = count($data['se_trateaza']) ?>
            <?php $j = 0 ?>
            <?php foreach($data['se_trateaza'] as $se_trateaza): ?>
            <?php $j++ ?>
                <a href="<?php echo base_url("view/{$se_trateaza}/plants") ?>"><?php echo $se_trateaza ?></a><?php if ($j !== $i): ?>, <?php endif; ?> 
            <?php endforeach; ?>
        </span>
    </p>
    <p>
        <?php if (count($data['are_simptome']) > 0): ?>
            <label>Are simptomele: </label>
            <span>
                <?php $i = count($data['are_simptome']) ?>
                <?php $j = 0 ?>
                <?php foreach($data['are_simptome'] as $are_simptome): ?>
                    <?php $j++ ?>
                    <a href="<?php echo base_url("view/{$are_simptome}/disease") ?>"><?php echo $are_simptome ?></a><?php if ($j !== $i): ?>, <?php endif; ?>
                <?php endforeach; ?>
            </span>
        <?php endif; ?>
    </p>
</div>