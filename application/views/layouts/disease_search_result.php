<div id="search-result-content">
    <p>
        <label>Se trateaza cu plantele: </label>
        <span>
            <?php $i = count($data['se_trateaza']) ?>
            <?php $j = 0 ?>
            <?php foreach($data['se_trateaza'] as $se_trateaza): ?>
            <?php $j++ ?>
                <?php echo $se_trateaza ?><?php if ($j !== $i): ?>, <?php endif; ?> 
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
                    <?php echo $are_simptome ?><?php if ($j !== $i): ?>, <?php endif; ?> 
                <?php endforeach; ?>
            </span>
        <?php endif; ?>
    </p>
</div>