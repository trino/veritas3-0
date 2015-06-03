<!-- BEGIN STYLE CUSTOMIZER -->
<div class="theme-panel hidden-xs hidden-sm">
    <?php if (strlen($is_disabled) == 0 && $param != "view") {
        echo '<div class="toggler"></div>';//doesn't work in view mode, so remove it and be done with it
    }
    ?>
    <div class="toggler-close">
    </div>

    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span><?= $strings["theme_color"]; ?></span>
            <ul>
                <li class="color-default <?php if ($settings->layout == 'default') echo "current"; ?> tooltips"
                    data-style="default" onclick="change_layout('default');" data-container="body"
                    data-original-title="<?= $strings["theme_default"]; ?>">
                </li>
                <li class="color-darkblue tooltips <?php if ($settings->layout == 'darkblue') echo "current"; ?>"
                    data-style="darkblue" onclick="change_layout('darkblue');" data-container="body"
                    data-original-title="<?= $strings["theme_darkblue"]; ?>">
                </li>
                <li class="color-blue tooltips <?php if ($settings->layout == 'blue') echo "current"; ?>"
                    data-style="blue" onclick="change_layout('blue');" data-container="body" data-original-title="<?= $strings["theme_blue"]; ?>">
                </li>
                <li class="color-grey tooltips <?php if ($settings->layout == 'grey') echo "current"; ?>"
                    data-style="grey" onclick="change_layout('grey');" data-container="body" data-original-title="<?= $strings["theme_grey"]; ?>">
                </li>
                <li class="color-light tooltips <?php if ($settings->layout == 'light') echo "current"; ?>"
                    data-style="light" onclick="change_layout('light');" data-container="body"
                    data-original-title="<?= $strings["theme_light"]; ?>">
                </li>
                <li class="color-light2 tooltips <?php if ($settings->layout == 'light2') echo "current"; ?>"
                    data-style="light2" onclick="change_layout('light2');" data-container="body" data-html="true"
                    data-original-title="<?= $strings["theme_light2"]; ?>">
                </li>
            </ul>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_style"]; ?></span>
            <select class="layout-style-option form-control input-sm">
                <option value="square" selected="selected"><?= $strings["theme_squarecorners"]; ?></option>
                <option value="rounded"><?= $strings["theme_roundcorners"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_layout"]; ?></span>
            <select class="layout-option form-control input-sm" onchange="change_box();" id="boxed">
                <option value="fluid" selected="selected"><?= $strings["theme_fluid"]; ?></option>
                <option value="boxed"><?= $strings["theme_boxed"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_header"]; ?></span>
            <select class="page-header-option form-control input-sm" onchange="change_body();">
                <option value="fixed" selected="selected"><?= $strings["theme_fixed"]; ?></option>
                <option value="default"><?= $strings["theme_default"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_dropdown"]; ?></span>
            <select class="page-header-top-dropdown-style-option form-control input-sm" onchange="change_body();">
                <option value="light" selected="selected"><?= $strings["theme_light"]; ?></option>
                <option value="dark"><?= $strings["theme_dark"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_sidebarmode"]; ?></span>
            <select class="sidebar-option form-control input-sm" onchange="change_body();">
                <option value="fixed"><?= $strings["theme_fixed"]; ?></option>
                <option value="default" selected="selected"><?= $strings["theme_default"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_sidebarmenu"]; ?></span>
            <select class="sidebar-menu-option form-control input-sm" onchange="change_body();">
                <option value="accordion" selected="selected"><?= $strings["theme_accordion"]; ?></option>
                <option value="hover"><?= $strings["theme_hover"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_sidebarstyle"]; ?></span>
            <select class="sidebar-style-option form-control input-sm" onchange="change_body();">
                <option value="default" selected="selected"><?= $strings["theme_default"]; ?></option>
                <option value="light"><?= $strings["theme_light"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_sidebarposition"]; ?></span>
            <select class="sidebar-pos-option form-control input-sm" onchange="change_body();">
                <option value="left" selected="selected"><?= $strings["theme_left"]; ?></option>
                <option value="right"><?= $strings["theme_right"]; ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $strings["theme_footer"]; ?></span>
            <select class="page-footer-option form-control input-sm" onchange="change_body();">
                <option value="fixed"><?= $strings["theme_fixed"]; ?></option>
                <option value="default" selected="selected"><?= $strings["theme_default"]; ?></option>
            </select>
        </div>
    </div>
</div>