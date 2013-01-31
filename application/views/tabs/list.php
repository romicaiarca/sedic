<ol id="selectable-<?php echo $list_type; ?>" class="<?php echo $list_type; ?>">
    <?php foreach($items as $key => $item): ?>
        <li id="<?php echo $key ?>" class="ui-widget-content afectiuni-plante"><?php print $item ?></li>
    <?php endforeach; ?>
</ol>
<script> $('.afectiuni-plante').on('click', function(evt) {
    evt.preventDefault();
    $('#search').val($(this).text())
    $('#search-result').load(
                    'get-details/?term=' + encodeURIComponent($(this).text()) + '&where_search=' + encodeURIComponent($(this).parent().attr('class'))
                )
    
    
    return;
}) </script>