<div id="content">
    <div id="content-tabs">
        <?php $this->load->view('tabs/tabs_view', array('content' => $content)) ?>
    </div>
    <div id="content-search">
        <?php $this->load->view('partial/search', array('term' => !empty($term) ? $term : '')) ?>
    </div>
    <div id="search-result"><?php echo !empty($search_result) ? $search_result : '' ?></div>
</div>