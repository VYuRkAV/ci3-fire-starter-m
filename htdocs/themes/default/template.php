<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Default Public Template
 */
?><!DOCTYPE html>
<html lang="<?php echo $html_lang ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
	<link rel="icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
    <title><?php echo $page_title; ?></title>
    <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
    <meta name="description" content="<?php echo $this->settings->meta_description[$this->session->language]; ?>">

    <?php // CSS files ?>
    <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
                <link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->settings->site_version; ?>"><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php // Fixed navbar ?>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo lang('core button toggle_nav'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"id="base-url" href="<?php echo base_url(); ?>"><?php echo $this->settings->site_name; ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php // Nav bar left ?>
                <ul class="nav navbar-nav">
                    <li class="<?php echo (uri_string() == '') ? 'active' : ''; ?>"><a href="<?php echo base_url('/'); ?>"><?php echo lang('core button home'); ?></a></li>
                    <li class="<?php echo (uri_string() == 'contact') ? 'active' : ''; ?>"><a href="<?php echo base_url('/contact'); ?>"><?php echo lang('core button contact'); ?></a></li>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <li class="<?php echo (uri_string() == 'profile') ? 'active' : ''; ?>"><a href="<?php echo base_url('/profile'); ?>"><?php echo lang('core button profile'); ?></a></li>
                    <?php endif; ?>
                </ul>
                <?php // Nav bar right ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <?php if ($this->user['role'] == 'admin' OR $this->user['role'] == 'editor') : ?>
                            <li>
                                <a href="<?php echo base_url('admin'); ?>"><?php echo lang('core button admin'); ?></a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo base_url('logout'); ?>"><?php echo lang('core button logout'); ?></a>
                        </li>
                    <?php else : ?>
                        <li class="<?php echo (uri_string() == 'login') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('login'); ?>"><?php echo lang('core button login'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (count($this->settings->idioms) > 1) : ?>
                        <li>
                            <span class="dropdown">
                                <button id="session-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default">
                                    <span class="glyphicon glyphicon-globe"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="session-language-dropdown" class="dropdown-menu" role="menu" aria-labelledby="session-language">
                                    <?php foreach ($this->settings->idioms as $language_key => $language_name) : ?>
                                        <li>
                                            <a href="#" rel="<?php echo $language_key; ?>">
                                                <?php if ($language_key == $this->session->language) : ?>
                                                    <span class="glyphicon glyphicon-chevron-right selected-session-language"></span>
                                                <?php endif; ?>
                                                <?php echo lang(substr($language_key, 0, 2)); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php // Main body ?>
    <div class="container theme-showcase" role="main">
        <div id="container">

			<?php // Page title ?>
            <div class="page-header">
                <h1><?php echo $page_header; ?></h1>
            </div>
    
            <?php // System messages ?>
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php elseif ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php elseif (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php elseif ($this->error) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->error; ?>
                </div>
            <?php endif; ?>
    
            <?php // Main content ?>
            <?php echo $content; ?>
            
        </div>
    </div>

    <?php // Footer ?>
    <footer>
        <div class="container">
            <div class="clearfix"><hr /></div>
            <p><?php echo $this->settings->copyright; ?></p>
            <p class="text-muted">
                <?php echo lang('core text page_rendered'); ?>
                | PHP v<?php echo phpversion(); ?>
                | <?php echo strtoupper($this->db->platform()); ?> v<?php echo $this->db->version(); ?>
                | CodeIgniter v<?php echo CI_VERSION; ?>
                | <a href="http://jasonbaier.github.io/ci3-fire-starter/" target="_blank">CI3 Fire Starter</a>
                | <?php echo $this->settings->site_name; ?> v<?php echo $this->settings->site_version; ?>
                | <a href="https://github.com/VYuRkAV/ci3-fire-starter-m" target="_blank">Github.com</a>
            </p>
        </div>
    </footer>
    
    <?php // Some text ?>
    <?php echo $html_footer; ?>
    
    <?php // Javascript files ?>
    <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?>?v=<?php echo $this->settings->site_version; ?>"></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
