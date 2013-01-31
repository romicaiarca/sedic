<div id="body" class="">
    <div id="wraper" class="">
        <a href="<?php echo base_url() ?>"><div id="header" class="">
            Plante Medicinale si afectiuni tratate - sedic
        </div></a>
        <div id="menu" class="">
            <span id="menu-home" class="menu-item"><a href="<?php echo base_url() ?>">Home</a></span>
            <span id="menu-about" class="menu-item"><a href="<?php echo base_url('about') ?>">About</a></span>
            <span id="menu-contact" class="menu-item"><a href="<?php echo base_url('contact') ?>">Contact</a></span>
        </div>
        <div id="content">
            <div id="content-tabs">
                <?php $this->load->view('tabs/tabs_view', array('content' => $content)) ?>
            </div>
            <div id="content-search">
                <?php $this->load->view('layouts/search') ?>
            </div>
            <div id="search-result"></div>
        </div>
    </div>
</div>