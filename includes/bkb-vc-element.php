<?php

use \BwlKbManager\Base\BaseController;


function bkb_vc_addon_function()
{

    // Knowledgebase Category Element.

    $bkb_vc_delay = array(
        '5' => '5',
        '10' => '10',
        '15' => '15',
        '20' => '20',
        '25' => '25',
        '30' => '30',
        '35' => '35',
        '40' => '40',
        '45' => '45',
        '50' => '50',
        '60' => '60',
        '100' => '100'
    );

    $bkb_vc_time = array(
        '1 Second' => '1000',
        '2 Seconds' => '2000',
        '3 Seconds' => '3000',
        '5 Seconds' => '5000',
        '10 Seconds' => '10000',
        '20 Seconds' => '20000',
        '30 Seconds' => '30000'
    );

    //@Description: Knowledgebase Category Element.
    //@Since: Version 1.0.0

    vc_map(array(
        "name" => __("KB Category", "bkb_vc"),
        "base" => "bkb_category",
        "icon" => "icon-bkb-cat-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "kb_cat",
                "value" => "",
                "heading" => __("Categories", "bkb_vc"),
                "param_name" => "categories",
                "description" => __("Just drag and drop your required categories in to right box.", "bkb_vc"),
                "group" => "Categories",
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Additional classes: bkbm-custom-layout-1, bkbm-box-shadow", 'bkb_vc'),
                "group" => "Categories",
            ),

            // add params same as with any other content element

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout Type", "bkb_vc"),
                "param_name" => "box_view",
                "value" => array(
                    __("Lists View", "bkb_vc") => 0,
                    __("Boxed View", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            // Carousel.

            array(
                "admin_label" => true,
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Carousel?", 'bkb_vc'),
                "param_name" => "carousel",
                "value" => array(__("Yes", 'bkb_vc') => "1"),
                "description" => "",
                "group" => "Settings"
            ),


            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Arrow?", 'bkb_vc'),
                "param_name" => "carousel_nav",
                "value" => array(
                    __("Yes", "bkb_vc") => 1,
                    __("No", "bkb_vc") => 0
                ),
                "description" => __("You can show/hide two arrow will display beside the carousel items.", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Dots ?", 'bkb_vc'),
                "param_name" => "carousel_dots",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "description" => __("You can show/hide bottom will display below the carousel items.", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'bkb_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => array(
                    'Select' => '',
                    '3 Seconds' => '3000',
                    '5 Seconds' => '5000',
                    '10 Seconds' => '10000',
                    '20 Seconds' => '20000',
                    '30 Seconds' => '30000'
                ),
                "group" => "Settings",
                "description" => __("Select scroll speed.", 'bkb_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            // List Style Type.

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("List Styles", "bkb_vc"),
                "param_name" => "bkb_list_type",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Rounded", "bkb_vc") => "rounded",
                    __("Rectangle", "bkb_vc") => "rectangle",
                    __("Iconized", "bkb_vc") => "iconized",
                    __("Accordion", "bkb_vc") => "accordion",
                    __("None", "bkb_vc") => "none"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show Category Title?", "bkb_vc"),
                "param_name" => "show_title",
                "value" => array(
                    __("Yes", "bkb_vc") => 1,
                    __("No", "bkb_vc") => 0
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array(
                    'element' => "box_view", 'value' => array('1'),
                    'element' => "bkb_list_type", 'value' => array('accordion')
                )
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Column Settings", "bkb_vc"),
                "param_name" => "cols",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("One Column", "bkb_vc") => 1,
                    __("Two Columns", "bkb_vc") => 2,
                    __("Three Columns", "bkb_vc")  => 3
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Category Description?", "bkb_vc"),
                "param_name" => "bkb_desc",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("No of items to display", "bkb_vc"),
                "param_name" => "limit",
                "value" => "",
                "description" => "",
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Order By Settings", "bkb_vc"),
                "param_name" => "orderby",
                "value" => array(
                    __("ID", "bkb_vc") => "ID",
                    __("Title", "bkb_vc") => "title",
                    __("Date", "bkb_vc") => "date",
                    __("Recent Modified", "bkb_vc") => "modified",
                    __("Random", "bkb_vc") => "rand",
                    __("Custom Sort", "bkb_vc") => "custom_order"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Order Type Settings", "bkb_vc"),
                "param_name" => "order",
                "value" => array(
                    __("Ascending", "bkb_vc") => "ASC",
                    __("Descending", "bkb_vc") => "DESC"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Post Count?", "bkb_vc"),
                "param_name" => "posts_count",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Post Count Info?", "bkb_vc"),
                "param_name" => "count_info",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => __("Display total number of posts below the list.", "bkb_vc"),
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),


            // New Code.

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Type", "bkb_vc"),
                "param_name" => "box_view_icon",
                "value" => array(
                    __("Font Awesome Icon", "bkb_vc") => "",
                    __("Image Icon", "bkb_vc") => 'img_icon'
                ),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Size", "bkb_vc"),
                "param_name" => "box_view_icon",
                "value" => array(
                    __("Option Panel Size", "bkb_vc") => "",
                    __("Auto Size", "bkb_vc") => 'img_icon'
                ),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Box View Extra Class", 'bkb_vc'),
                "param_name" => "box_view_class",
                "value" => "",
                "description" => __("Additional classes: box-left-align, box-right-align, no-icon, no-separator, no-view-more-link", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            // End New Code.

            // Animation.

            array(
                'type' => 'animation_style',
                'heading' => __('Animation', 'bkb_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'bkb_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )



        )
    ));


    //@Description: Knowledgebase Tags Element.
    //@Since: Version 1.0.0

    vc_map(array(
        "name" => __("KB Tags", "bkb_vc"),
        "base" => "bkb_tags",
        "icon" => "icon-bkb-tags-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "kb_tags",
                "value" => "",
                "heading" => __("Tags", "bkb_vc"),
                "param_name" => "tags",
                "description" => __("Just drag and drop your required Tags in to right box.", "bkb_vc"),
                "group" => "Tags",
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Additional class: bkbm-box-shadow", 'bkb_vc'),
                "group" => "Tags",
            ),

            // add params same as with any other content element

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout Type Settings", "bkb_vc"),
                "param_name" => "box_view",
                "value" => array(
                    __("Lists View", "bkb_vc") => 0,
                    __("Boxed View", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),



            // Carousel.

            array(
                "admin_label" => true,
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Carousel?", 'bkb_vc'),
                "param_name" => "carousel",
                "value" => array(__("Yes", 'bkb_vc') => "1"),
                "description" => "",
                "group" => "Settings"
            ),


            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Arrow?", 'bkb_vc'),
                "param_name" => "carousel_nav",
                "value" => array(
                    __("Yes", "bkb_vc") => 1,
                    __("No", "bkb_vc") => 0
                ),
                "description" => __("You can show/hide two arrow will display beside the carousel items.", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Dots ?", 'bkb_vc'),
                "param_name" => "carousel_dots",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "description" => __("You can show/hide bottom will display below the carousel items.", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'bkb_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => array(
                    'Select' => '',
                    '3 Seconds' => '3000',
                    '5 Seconds' => '5000',
                    '10 Seconds' => '10000',
                    '20 Seconds' => '20000',
                    '30 Seconds' => '30000'
                ),
                "group" => "Settings",
                "description" => __("Select scroll speed.", 'bkb_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("List Styles", "bkb_vc"),
                "param_name" => "bkb_list_type",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Rounded", "bkb_vc") => "rounded",
                    __("Rectangle", "bkb_vc") => "rectangle",
                    __("Iconized", "bkb_vc") => "iconized",
                    __("Accordion", "bkb_vc") => "accordion",
                    __("None", "bkb_vc") => "none"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show Tag Title?", "bkb_vc"),
                "param_name" => "show_title",
                "value" => array(
                    __("Yes", "bkb_vc") => 1,
                    __("No", "bkb_vc") => 0
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array(
                    'element' => "box_view", 'value' => array('1'),
                    'element' => "bkb_list_type", 'value' => array('accordion')
                )
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Column Settings", "bkb_vc"),
                "param_name" => "cols",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("One Column", "bkb_vc") => 1,
                    __("Two Columns", "bkb_vc") => 2,
                    __("Three Columns", "bkb_vc")  => 3
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Category Description?", "bkb_vc"),
                "param_name" => "bkb_desc",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("No of items to display", "bkb_vc"),
                "param_name" => "limit",
                "value" => "",
                "description" => "",
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Order By Settings", "bkb_vc"),
                "param_name" => "orderby",
                "value" => array(
                    __("ID", "bkb_vc") => "ID",
                    __("Title", "bkb_vc") => "title",
                    __("Date", "bkb_vc") => "date",
                    __("Recent Modified", "bkb_vc") => "modified",
                    __("Random", "bkb_vc") => "rand",
                    __("Custom Sort", "bkb_vc") => "custom_order"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Order Type Settings", "bkb_vc"),
                "param_name" => "order",
                "value" => array(
                    __("Ascending", "bkb_vc") => "ASC",
                    __("Descending", "bkb_vc") => "DESC"
                ),
                "group" => "Settings",
                "description" => "",
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Post Count?", "bkb_vc"),
                "param_name" => "posts_count",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Post Count Info?", "bkb_vc"),
                "param_name" => "count_info",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => __("Display total number of posts below the list.", "bkb_vc"),
                "dependency" => array('element' => "box_view", 'value' => array('0'))
            ),


            // New Code.

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Type", "bkb_vc"),
                "param_name" => "box_view_icon",
                "value" => array(
                    __("Font Awesome Icon", "bkb_vc") => "",
                    __("Image Icon", "bkb_vc") => 'img_icon'
                ),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Size", "bkb_vc"),
                "param_name" => "box_view_icon",
                "value" => array(
                    __("Option Panel Size", "bkb_vc") => "",
                    __("Auto Size", "bkb_vc") => 'img_icon'
                ),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Box View Extra Class", 'bkb_vc'),
                "param_name" => "box_view_class",
                "value" => "",
                "description" => __("Additional classes: box-left-align, box-right-align, no-icon, no-separator", 'bkb_vc'),
                "group" => "Settings",
                "dependency" => array('element' => "box_view", 'value' => array('1'))
            ),

            // End New Code.

            // Animation.

            array(
                'type' => 'animation_style',
                'heading' => __('Animation', 'bkb_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'bkb_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )

        )
    ));


    // Knowledgebase Search Element.

    vc_map(array(
        "name" => __("KB Search", "bkb_vc"),
        "base" => "bkb_search",
        "icon" => "icon-bkb-search-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(

            // add params same as with any other content element
            array(
                'admin_label' => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Placeholder Text", "bkb_vc"),
                "param_name" => "placeholder",
                "value" => __('Search Keywords ..... ', 'bkb_vc'),
                "description" => __('Text will display in search input box.', 'bkb_vc'),
                "group" => "General",
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class: bkb-sbox-layout-1, bkb-sbox-layout-1 semi-rounded-box, bkb-sbox-layout-1 rounded-box, bkb-sbox-layout-1 dark-box", 'bkb_vc'),
                "group" => "General",
            ),

            array(
                'type' => 'animation_style',
                'heading' => __('Animation', 'bkb_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'bkb_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )
        )
    ));


    // Knowledgebase Ask A Question Button Element.

    vc_map(array(
        "name" => __("Question Modal Button", "bkb_vc"),
        "base" => "bkb_ask_form",
        "icon" => "icon-bkb-btn-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(

            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Button Title", "bkb_vc"),
                "param_name" => "title",
                "value" => __('Add a Question', 'bkb_vc'),
                "description" => '',
                "group" => "General",
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Size", "bkb_vc"),
                "param_name" => "btn_size",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Large", "bkb_vc") => "bkb_btn_lg",
                    __("Medium", "bkb_vc") => "bkb_btn_md",
                    __("Small", "bkb_vc") => "bkb_btn_sm",
                    __("Full Width", "bkb_vc") => "bkb_btn_full",

                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Alignment", "bkb_vc"),
                "param_name" => "btn_align",
                "value" => array(
                    __("Center", "bkb_vc") => "",
                    __("Left", "bkb_vc") => "bkb_btn_left",
                    __("Right", "bkb_vc") => "bkb_btn_right"
                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Border Style", "bkb_vc"),
                "param_name" => "btn_border_style",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Square", "bkb_vc") => "bkb_btn_square",
                    __("Rounded", "bkb_vc") => "bkb_btn_rounded"

                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Animation", "bkb_vc"),
                "param_name" => "btn_animate",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Animation 1", "bkb_vc") => "animated-button sandy-one",
                    __("Animation 2", "bkb_vc") => "animated-button sandy-two",
                    __("Animation 3", "bkb_vc") => "animated-button sandy-three",
                    __("Animation 4", "bkb_vc") => "animated-button sandy-four",
                    __("Animation 5", "bkb_vc") => "animated-button gibson-one",
                    __("Animation 6", "bkb_vc") => "animated-button gibson-two",
                    __("Animation 7", "bkb_vc") => "animated-button gibson-three",
                    __("Animation 8", "bkb_vc") => "animated-button gibson-four",
                    __("Animation 9", "bkb_vc") => "animated-button thar-one",
                    __("Animation 10", "bkb_vc") => "animated-button thar-two",
                    __("Animation 11", "bkb_vc") => "animated-button thar-three",
                    __("Animation 12", "bkb_vc") => "animated-button thar-four",

                ),
                "group" => "Animation",
                "description" => ""
            ),

        )
    ));


    // Knowledgebase KB External Form

    vc_map(array(
        "name" => __("KB External Form", "bkb_vc"),
        "base" => "bkb_ques_form",
        "icon" => "icon-bkb-form-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "params" => array(

            // Tab Title Settings.

            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Form Headline", "bkb_vc"),
                "param_name" => "form_heading",
                "value" => __('Add A Knowledge Base Question !', 'bkb_vc'),
                "description" => __("You can set custom form heading for KB External Form .", "bkb_vc"),
                "group" => "General",
            ),

            // add params same as with any other content element


            array(

                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Form Layout", "bkb_vc"),
                "param_name" => "layout",
                "value" => array(
                    __("Layout 01", "bkb_vc") => "layout_1",
                    __("Layout 02", "bkb_vc") => "layout_2"
                ),
                "group" => "General",
                "description" =>  __("Layout 01 will display Form labels and Layout 02 will hide Form label.", "bkb_vc"),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of button.", 'bkb_vc'),
                "group" => "General",
            ),

            array(
                'type' => 'animation_style',
                'heading' => __('Animation', 'bkb_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'bkb_vc'),
                'admin_label' => false,
                'weight' => 0,
                "group" => "Animation",
            )

        )
    ));

    // Knowledgebase Tab.

    vc_map(array(
        "name" => __("KB Tabs", "bkb_vc"),
        "base" => "vc_bkb_tabs",
        "icon" => "icon-bkb-tab-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "kb_tabs",
                "value" => "",
                "heading" => __("Tab Items", "bkb_vc"),
                "param_name" => "tabs",
                "description" => __("You can use drag & drop to re-order tab position.", "bkb_vc"),
                "group" => "Tabs",
            ),


            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Tab Style", "bkb_vc"),
                "param_name" => "vertical",
                "value" => array(
                    __("Horizontal Tab", "bkb_vc") => 0,
                    __("Vertical Tab", "bkb_vc") => 1,
                ),
                "group" => "Tabs",
                "description" => ""
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Tab Item Style", "bkb_vc"),
                "param_name" => "bkb_list_type",
                "value" => array(
                    __("Rounded", "bkb_vc") => "rounded",
                    __("Rectangle", "bkb_vc") => "rectangle",
                    __("Iconized", "bkb_vc") => "iconized",
                    __("None", "bkb_vc") => "none"
                ),
                "group" => "Tabs",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("No of Items", "bkb_vc"),
                "param_name" => "limit",
                "value" => "",
                "description" => "",
                "group" => "Tabs",
            ),

            // Tab Title Settings.

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Featured Tab Title", "bkb_vc"),
                "param_name" => "feat_tab_title",
                "value" => "",
                "description" => __("Set custom title for Featured KB Tab", "bkb_vc"),
                "group" => "Tabs Title",
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Popular Tab Title", "bkb_vc"),
                "param_name" => "popular_tab_title",
                "value" => "",
                "description" => __("Set custom title for Popular KB Tab", "bkb_vc"),
                "group" => "Tabs Title",
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Recent Tab Title", "bkb_vc"),
                "param_name" => "recent_tab_title",
                "value" => "",
                "description" => __("Set custom title for Recent KB Tab", "bkb_vc"),
                "group" => "Tabs Title",
            ),

            // add params same as with any other content element

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable RTL Mode?", "bkb_vc"),
                "param_name" => "rtl",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "Settings",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of tabs.", 'bkb_vc'),
                "group" => "Settings",
            ),

        )
    ));


    // Knowledgebase Counter.

    vc_map(array(
        "name" => __("KB counter", "bkb_vc"),
        "base" => "vc_bkb_counter",
        "icon" => "icon-bkb-counter-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "kb_counter",
                "value" => "",
                "heading" => __("Elements", "bkb_vc"),
                "param_name" => "counter",
                "description" => __("You can use drag & drop to re-order tab position.", "bkb_vc"),
                "group" => "Counter",
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Counter Delay", "bkb_vc"),
                "param_name" => "counter_delay",
                "value" => $bkb_vc_delay,
                "group" => "Counter"
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Counter Time", "bkb_vc"),
                "param_name" => "counter_time",
                "value" => $bkb_vc_time,
                "group" => "Counter"
            ),

            array(
                "type" => "colorpicker",
                "heading" => __('Counter Icon Color', 'bkb_vc'),
                "param_name" => "counter_icon_color",
                "value" => "#0074A2",
                "description" => __('Set counter icon color.', 'bkb_vc'),
                "group" => "Settings"
            ),
            array(
                "type" => "textfield",
                "heading" => __('Icon Font Size', 'bkb_vc'),
                "param_name" => "counter_icon_size",
                "value" => "54",
                "description" => __('Set counter icon color.', 'bkb_vc'),
                "group" => "Settings"
            ),

            array(
                "type" => "colorpicker",
                "heading" => __('Counter Text Color', 'bkb_vc'),
                "param_name" => "counter_text_color",
                "value" => "#2C2C2C",
                "description" => __('Set counter text color.', 'bkb_vc'),
                "group" => "Settings"
            ),
            array(
                "type" => "textfield",
                "heading" => __('Text Font Size', 'bkb_vc'),
                "param_name" => "counter_text_size",
                "value" => "32",
                "description" => __('Set counter icon color.', 'bkb_vc'),
                "group" => "Settings"
            ),

            array(
                "type" => "colorpicker",
                "heading" => __('Counter Title Color', 'bkb_vc'),
                "param_name" => "counter_title_color",
                "value" => "#525252",
                "description" => __('Set counter title color.', 'bkb_vc'),
                "group" => "Settings"
            ),

            array(
                "type" => "textfield",
                "heading" => __('Title Font Size', 'bkb_vc'),
                "param_name" => "counter_title_size",
                "value" => "14",
                "description" => __('Set counter icon color.', 'bkb_vc'),
                "group" => "Settings"
            ),

            // add params same as with any other content element


            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Total Kb Title", "bkb_vc"),
                "param_name" => "title_total_kb",
                "value" => __('KB Posts', 'bkb_vc'),
                "description" => "",
                "group" => "Total KB",
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Total KB Icon', 'bkb_vc'),
                'param_name' => 'icon_total_kb',
                'settings' => array(
                    'emptyIcon' => TRUE, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Total KB",
                'description' => __('Select icon from library.', 'bkb_vc'),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Total Category Title", "bkb_vc"),
                "param_name" => "title_total_cat",
                "value" => __('KB Categories', 'bkb_vc'),
                "description" => "",
                "group" => "Total Category",
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Total Category Icon', 'bkb_vc'),
                'param_name' => 'icon_total_cat',
                'settings' => array(
                    'emptyIcon' => TRUE, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Total Category",
                'description' => __('Select icon from library.', 'bkb_vc'),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Total Tag Title", "bkb_vc"),
                "param_name" => "title_total_tag",
                "value" => __('KB Tags', 'bkb_vc'),
                "description" => "",
                "group" => "Total Tag",
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Total Tag Icon', 'bkb_vc'),
                'param_name' => 'icon_total_tag',
                'settings' => array(
                    'emptyIcon' => TRUE, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Total Tag",
                'description' => __('Select icon from library.', 'bkb_vc'),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Total Like Title", "bkb_vc"),
                "param_name" => "title_total_likes",
                "value" => __('KB Likes', 'bkb_vc'),
                "description" => "",
                "group" => "Total Like",
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Total Like Icon', 'bkb_vc'),
                'param_name' => 'icon_total_likes',
                'settings' => array(
                    'emptyIcon' => TRUE, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Total Like",
                'description' => __('Select icon from library.', 'bkb_vc'),
            ),



            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "group" => "Counter",
                "description" => __("Additional Class: bkbm-post-list-custom-layout, bkbm-posts-box-shadow", 'bkb_vc')
            ),


        )
    ));

    // Knowledgebase Posts

    vc_map(array(
        "name" => __("Knowledgebase Posts", "bkb_vc"),
        "base" => "vc_bkb_posts",
        "icon" => "icon-bkb-posts-vc-addon",
        "category" => __("BWL KB", "bkb_vc"),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(

            // add params same as with any other content element

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("KB Type", "bkb_vc"),
                "param_name" => "kb_type",
                "value" => array(
                    __("Recent KB", "bkb_vc") => "recent",
                    __("Popular KB", "bkb_vc") => "popular",
                    __("Featured KB", "bkb_vc") => "featured",
                    __("Random KB", "bkb_vc") => "random",

                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("KB Type Title", "bkb_vc"),
                "param_name" => "kb_type_title",
                "value" => '',
                "description" => '',
                "group" => "General",
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display KB Type Title?", "bkb_vc"),
                "param_name" => "kb_type_title_status",
                "value" => array(
                    __("Yes", "bkb_vc") => 1,
                    __("No", "bkb_vc") => 0
                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Pagination?", "bkb_vc"),
                "param_name" => "paginate",
                "value" => array(
                    __("No", "bkb_vc") => 0,
                    __("Yes", "bkb_vc") => 1
                ),
                "group" => "General",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Post Per Page", "bkb_vc"),
                "param_name" => "posts_per_page",
                "value" => '5',
                "description" => __("Default: 5. You can add any number. Set -1 to display all the posts.", "bkb_vc"),
                "group" => "General"
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("List Styles", "bkb_vc"),
                "param_name" => "bkb_list_type",
                "value" => array(
                    __("Select", "bkb_vc") => "",
                    __("Rounded", "bkb_vc") => "rounded",
                    __("Rectangle", "bkb_vc") => "rectangle",
                    __("Iconized", "bkb_vc") => "iconized",
                    __("None", "bkb_vc") => "none"
                ),
                "group" => "Design",
                "description" => ""
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Extra Class", 'bkb_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Additional Class: bkbm-post-list-custom-layout, bkbm-posts-box-shadow", 'bkb_vc'),
                "group" => "Design",
            ),

            array(
                'type' => 'animation_style',
                'heading' => __('Animation', 'bkb_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'bkb_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )

        )
    ));
}

/*------------------------------  Create Custom Parameters ---------------------------------*/

// Generate param type "kb_cat"

if (function_exists('vc_add_shortcode_param')) {
    // vc_add_shortcode_param('kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_cat_sort.js');
    vc_add_shortcode_param('kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR .  '/assets/scripts/admin.js');
}

// Function generate param type "number"
function cb_kb_cat_field($settings, $value)
{

    $baseController = new BaseController();

    //    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    if (!empty($value)) {

        $explode_value = explode(',', $value);
    } else {

        $explode_value = array();
    }

    $bkb_category_args = array(
        'post_type'     => $baseController->plugin_post_type,
        'taxonomy' => $baseController->plugin_cpt_tax_category,
        'hide_empty' => 1,
        'orderby' => 'title',
        'order' => 'ASC',
        'suppress_filters' => FALSE
    );

    if (defined('BKB_WP_POST')) {

        $bkb_category_args['post_type'] = 'post';
        $bkb_category_args['taxonomy'] = 'category';
    }

    $bkb_categories = get_categories($bkb_category_args);

    $parent_list = array();

    foreach ($bkb_categories as $category) :

        $parent_list[$category->slug] =  $category->name;

    endforeach;

    $selected_list = array();

    // Now we pick those array data which index is cat-1 and cat-2

    if (count($explode_value) > 0) {

        foreach ($explode_value as $key => $value) {

            if (in_array($value, array_keys($parent_list))) {
                //                echo $parent_list[$value];
                $selected_list[$value] = $parent_list[$value];
                //                echo "<br>";
                unset($parent_list[$value]);
            }
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list">';

    foreach ($parent_list as $key => $value) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';

    $selected_list_string = '<ul id="sortable2" class="connectedSortable bkb_connected list bkb_cat">';

    foreach ($selected_list as $key => $value) :
        $selected_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $selected_list_string .= '</ul>';
    $output = "";

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                        ' . $selected_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}


// Generate param type "kb_tags"

if (function_exists('vc_add_shortcode_param')) {
    // vc_add_shortcode_param('kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR.  '/admin/js/bkb_tags_sort.js');
    vc_add_shortcode_param('kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR .  '/assets/scripts/admin.js');
}

// Function generate param type "number"
function cb_kb_tags_field($settings, $value)
{

    $baseController = new BaseController();

    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    if (!empty($value)) {

        $explode_value = explode(',', $value);
    } else {

        $explode_value = array();
    }

    $bkb_tags_args = array(
        'post_type'     => $baseController->plugin_post_type,
        'taxonomy' => $baseController->plugin_cpt_tax_tags,
        'hide_empty' => 1,
        'orderby' => 'title',
        'order' => 'ASC',
        'suppress_filters' => FALSE
    );

    if (defined('BKB_WP_POST')) {

        $bkb_tags_args['post_type'] = 'post';
        $bkb_tags_args['taxonomy'] = 'post_tag';
    }

    $bkb_tags = get_categories($bkb_tags_args);

    $parent_list = array();

    foreach ($bkb_tags as $tags) :

        $parent_list[$tags->slug] =  $tags->name;

    endforeach;

    $selected_list = array();

    // Now we pick those array data which index is cat-1 and cat-2

    if (count($explode_value) > 0) {

        foreach ($explode_value as $key => $value) {

            if (in_array($value, array_keys($parent_list))) {

                $selected_list[$value] = $parent_list[$value];

                unset($parent_list[$value]);
            }
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list">';

    foreach ($parent_list as $key => $value) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';

    $selected_list_string = '<ul id="sortable2" class="connectedSortable bkb_connected list bkb_tags">';

    foreach ($selected_list as $key => $value) :
        $selected_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $selected_list_string .= '</ul>';
    $output = "";

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                        ' . $selected_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}

// Generate param type "kb_tabs"

if (function_exists('vc_add_shortcode_param')) {
    // vc_add_shortcode_param('kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_tabs_sort.js');
    vc_add_shortcode_param('kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR .  '/assets/scripts/admin.js');
}

function cb_kb_tabs_field($settings, $value)
{

    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    if (!empty($value)) {

        $explode_value = explode(',', $value);
    } else {

        $explode_value = array('featured', 'popular', 'recent');
    }


    // Now we pick those array data which index is cat-1 and cat-2
    $parent_list = array();

    if (count($explode_value) > 0) {

        foreach ($explode_value as $key => $value) {


            $parent_list[$value] = ucfirst($value);
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list bkb_tabs">';

    foreach ($parent_list as $key => $value) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';
    $output = "";

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}


// Generate param type "kb_counter"

if (function_exists('vc_add_shortcode_param')) {
    // vc_add_shortcode_param('kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_counter_sort.js');
    vc_add_shortcode_param('kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR .  '/assets/scripts/admin.js');
}

function cb_kb_counter_field($settings, $value)
{

    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    if (!empty($value)) {

        $explode_value = explode(',', $value);
    } else {

        $explode_value = array('total_kb', 'total_cat', 'total_tag', 'total_likes');
    }


    // Now we pick those array data which index is cat-1 and cat-2
    $parent_list = array();

    if (count($explode_value) > 0) {

        foreach ($explode_value as $key => $value) {


            $parent_list[$value] = ucfirst(str_replace('_', ' ', $value));
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list bkb_counter">';

    foreach ($parent_list as $key => $value) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';
    $output = "";

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}

/*----- Animation Class ----*/

// For Button.
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_BKB_VC_Animation extends WPBakeryShortCode
    {
    }
}
