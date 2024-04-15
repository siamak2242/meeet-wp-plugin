<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class MeeetElementorWidgetCarousel extends Widget_Base
{
    public function get_name(): string
    {
        return 'meeet-carousel-widget';
    }

    public function get_title(): string
    {
        return 'گردونه';
    }

    public function get_icon(): string
    {
        return 'eicon-post';
    }

    public function get_categories(): array
    {
        return [_meeet_elementor_category_id];
    }

    public function get_style_depends(): array
    {
        return [
        ];
    }

    public function get_script_depends(): array
    {
        return [
        ];
    }

    protected function register_controls()
    {
        // content => query settings
        $this->start_controls_section('query-settings', [
            'label' => 'تنظیمات کوئری',
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('slide-type', [
            'label' => 'نمایش از:',
            'type' => Controls_Manager::SELECT,
            'options' => [
                'posts' => 'نوشته ها',
            ],
            'default' => 'posts',
        ]);
        $this->end_controls_section();

        // content => parts of slide
        $this->start_controls_section('slide-settings', [
            'label' => 'تنظمات اسلاید',
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('show-categories', [
            'type' => Controls_Manager::SWITCHER,
            'label' => 'نمایش دسته بندی های نوشته',
            'default' => 'yes',
        ]);
        $this->add_control('show-image', [
            'type' => Controls_Manager::SWITCHER,
            'label' => 'نمایش تصویر نوشته',
            'default' => 'yes',
        ]);
        $this->add_control('show-title', [
            'type' => Controls_Manager::SWITCHER,
            'label' => 'نمایش عنوان نوشته',
            'default' => 'yes',
        ]);
        $this->add_control('show-excerpt', [
            'type' => Controls_Manager::SWITCHER,
            'label' => 'نمایش خلاصه نوشته',
            'default' => 'yes',
        ]);
        $this->add_control('show-meta', [
            'type' => Controls_Manager::SWITCHER,
            'label' => 'نمایش اطلاعات نوشته',
            'default' => 'yes',
        ]);
        $this->end_controls_section();

        // content => carousel settings
        $this->start_controls_section('carousel-settings', [
            'label' => 'تنظیمات گردونه',
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('carousel-slides-to-show', [
            'label' => 'تعداد اسلایدهای هر صفحه',
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 10,
            'step' => 1,
            'default' => 3,
        ]);
        $this->add_control('carousel-slides-to-scroll', [
            'label' => 'تعداد اسلایدهای هر اسکرول',
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 10,
            'step' => 1,
            'default' => 3,
        ]);
        $this->add_control('carousel-duration', [
            'label' => 'مدت انیمیشن (میلی ثانیه)',
            'type' => Controls_Manager::NUMBER,
            'min' => 100,
            'max' => 5000,
            'step' => 100,
            'default' => 500,
        ]);
        $this->add_control('carousel-rewind', [
            'label' => 'حلقه',
            'type' => Controls_Manager::SWITCHER,
            'default' => 'no',
        ]);
        $this->add_control('carousel-dots-margin', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله نقطه ها',
            'default' => [
                'isLinked' => false,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .glider__dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->end_controls_section();

        // style => categories
        $this->start_controls_section('categories-style', [
            'label' => 'دسته بندی ها',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show-categories' => 'yes',
            ]
        ]);
        $this->add_control('category-position', [
            'label' => 'جهت',
            'type' => Controls_Manager::SELECT,
            'options' => [
                'top-left' => 'بالا چپ',
                'top-right' => 'بالا راست',
                'bottom-left' => 'پایین چپ',
                'bottom-right' => 'پایین راست',
            ],
            'default' => 'top-left',
        ]);
        $this->add_control('category-background', [
            'type' => Controls_Manager::COLOR,
            'label' => 'رنگ پس زمینه',
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .post__category span' => 'background-color: {{VALUE}}',
            ],
        ]);
        $this->add_control('category-color', [
            'type' => Controls_Manager::COLOR,
            'label' => 'رنگ',
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .post__category span' => 'color: {{VALUE}}',
            ],
        ]);
        $this->add_control('category-margin', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله خارجی',
            'default' => [
                'isLinked' => false,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__category span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_control('category-padding', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله داخلی',
            'default' => [
                'isLinked' => true,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__category span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_control('category-radius', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'برش گوشه ها',
            'default' => [
                'isLinked' => true,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__category span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'post-category',
            'selector' => '{{WRAPPER}} .post__category'
        ]);
        $this->end_controls_section();

        // style => image
        $this->start_controls_section('image-style', [
            'label' => 'تصویر',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show-image' => 'yes',
            ]
        ]);
        $this->add_control('image-width', [
            'type' => Controls_Manager::SLIDER,
            'label' => 'عرض تصویر',
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .post__image a' => 'width: {{SIZE}}{{UNIT}};',
            ]
        ]);
        $this->end_controls_section();

        // style => title
        $this->start_controls_section('title-style', [
            'label' => 'عنوان',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show-title' => 'yes',
            ]
        ]);
        $this->add_control('title-alignment', [
            'label' => 'جهت متن',
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'right' => [
                    'title' => 'راست',
                    'icon' => 'eicon-text-align-right',
                ],
                'center' => [
                    'title' => 'وسط',
                    'icon' => 'eicon-text-align-center',
                ],
                'left' => [
                    'title' => 'چپ',
                    'icon' => 'eicon-text-align-left',
                ],
            ],
            'default' => 'right',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .post__title' => 'text-align: {{VALUE}}',
            ],
        ]);
        $this->start_controls_tabs('title-color');
        $this->start_controls_tab('title-normal', ['label' => 'عادی']);
        $this->add_control('title-color-normal', [
            'type' => Controls_Manager::COLOR,
            'label' => 'رنگ',
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .post__title a' => 'color: {{VALUE}}',
            ],
        ]);
        $this->end_controls_tab();
        $this->start_controls_tab('title-hover', ['label' => 'شناور']);
        $this->add_control('title-color-hover', [
            'type' => Controls_Manager::COLOR,
            'label' => 'رنگ',
            'selectors' => [
                '{{WRAPPER}} .post__title a:hover' => 'color: {{VALUE}}',
            ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control('title-margin', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله',
            'default' => [
                'isLinked' => false,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'post-title',
            'selector' => '{{WRAPPER}} .post__title a'
        ]);
        $this->end_controls_section();

        // style => excerpt
        $this->start_controls_section('excerpt-style', [
            'label' => 'خلاصه نوشته',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show-excerpt' => 'yes',
            ]
        ]);
        $this->add_control('excerpt-alignment', [
            'label' => 'جهت متن',
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'right' => [
                    'title' => 'راست',
                    'icon' => 'eicon-text-align-right',
                ],
                'center' => [
                    'title' => 'وسط',
                    'icon' => 'eicon-text-align-center',
                ],
                'left' => [
                    'title' => 'چپ',
                    'icon' => 'eicon-text-align-left',
                ],
            ],
            'default' => 'right',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .post__excerpt' => 'text-align: {{VALUE}}',
            ],
        ]);
        $this->add_control('excerpt-color', [
            'type' => Controls_Manager::COLOR,
            'label' => 'رنگ',
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .post__excerpt' => 'color: {{VALUE}}',
            ],
        ]);
        $this->add_control('excerpt-margin', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله',
            'default' => [
                'isLinked' => false,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'post-excerpt',
            'selector' => '{{WRAPPER}} .post__excerpt'
        ]);
        $this->end_controls_section();

        // style => meta
        $this->start_controls_section('meta-section', [
            'label' => 'اطلاعات نوشته',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show-meta' => 'yes'
            ]
        ]);
        $this->add_control('meta-icon-size', [
            'label' => 'اندازه آیکن',
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'default' => [
                'unit' => 'px',
                'size' => 20,
            ],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 100,
                    'step' => 2,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .post__meta span.label' => 'width: {{SIZE}}{{UNIT}}',
            ]
        ]);
        $this->add_control('meta-icon-color', [
            'label' => 'رنگ آیکن',
            'type' => Controls_Manager::COLOR,
            'default' => '#aaa',
            'selectors' => [
                '{{WRAPPER}} .post__meta span.label svg' => 'fill: {{VALUE}}'
            ]
        ]);
        $this->add_control('meta-text-color', [
            'label' => 'رنگ متن',
            'type' => Controls_Manager::COLOR,
            'default' => '#aaa',
            'selectors' => [
                '{{WRAPPER}} .post__meta .value' => 'color: {{VALUE}}'
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'post-meta',
            'selector' => '{{WRAPPER}} .post__meta .value',
        ]);
        $this->add_control('meta-margin', [
            'type' => Controls_Manager::DIMENSIONS,
            'label' => 'فاصله',
            'default' => [
                'isLinked' => false,
                'top' => 0,
                'right' => 0,
                'left' => 0,
                'bottom' => 0,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .post__meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);
        $this->add_control('meta-justify-content', [
                'label' => 'چینش اطلاعات',
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => 'Start',
                        'icon' => 'eicon-align-end-h',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'space-between' => [
                        'title' => 'Space Between',
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => 'Space Around',
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly' => [
                        'title' => 'Space Evenly',
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                    'flex-end' => [
                        'title' => 'End',
                        'icon' => 'eicon-align-start-h',
                    ],
                ],
                'default' => 'space-between',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .post__meta' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control('author-icon', [
                'label' => 'نویسنده',
                'type' => Controls_Manager::ICONS,
            ]
        );
        $this->add_control('comment-icon', [
                'label' => 'نظرات',
                'type' => Controls_Manager::ICONS,
            ]
        );
        $this->add_control('date-icon', [
                'label' => 'تاریخ',
                'type' => Controls_Manager::ICONS,
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $id = $this->get_id();
        $settings = $this->get_settings_for_display();
        if ($settings['slide-type'] === 'posts') {
            echo "<div class='glider__wrapper glider__wrapper__$id'>";
            echo "<div class='glider__track glider__track__$id'>";
            $posts = get_posts([
                'posts_per_page' => 0,
            ]);
            $categories = [];
            foreach ($posts as $post) {
                $show_categories = $settings['show-categories'];
                $show_image = $settings['show-image'];
                $show_title = $settings['show-title'];
                $show_excerpt = $settings['show-excerpt'];
                $show_meta = $settings['show-meta'];
                ?>
                <div class="glider__slide">
                    <?php if ($show_categories): ?>
                        <div class="post__category <?php echo $settings['category-position'] ?>">
                            <?php
                            $cat__ids = wp_get_post_categories($post->ID);
                            $cat__names = [];
                            foreach ($cat__ids as $cat_id)
                                if (isset($categories[$cat_id]))
                                    $cat__names[] = $categories[$cat_id];
                                else
                                    $categories[$cat_id] = $cat__names[] = get_term($cat_id)->name;

                            echo "<span>" . implode("</span><span>", $cat__names) . "</span>" ?>
                        </div>
                    <?php endif ?>
                    <?php if ($show_image): ?>
                        <div class="post__image">
                            <a href="<?php echo get_permalink($post) ?>">
                                <?php echo get_the_post_thumbnail($post) ?>
                            </a>
                        </div>
                    <?php endif ?>
                    <?php if ($show_title): ?>
                        <div class="post__title">
                            <a href="<?php echo get_permalink($post) ?>">
                                <?php echo $post->post_title ?>
                            </a>
                        </div>
                    <?php endif ?>
                    <?php if ($show_excerpt): ?>
                        <div class="post__excerpt">
                            <?php echo get_the_excerpt($post) ?>
                        </div>
                    <?php endif ?>
                    <?php if ($show_meta): ?>
                        <div class="post__meta">
                            <div class="post__author">
                                <span class="label">
                                <?php Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => true], 'div') ?>
                                </span>
                                <a href="<?php echo get_author_posts_url($post->post_author) ?>" class="value">
                                    <?php $author = new WP_User($post->post_author) ?>
                                    <?php echo $author->data->user_nicename ?>
                                </a>
                            </div>
                            <div class="post__comments">
                                <span class="label">
                                <?php Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => true]) ?>
                                </span>
                                <span class="value"><?php echo $post->comment_count ?></span>
                            </div>
                            <div class="post__date">
                                <span class="label">
                                <?php Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => true]) ?>
                                </span>
                                <span class="value"><?php echo explode(' ', $post->post_date)[0] ?></span>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php
            }
            echo "</div>"; // div.glider__track
            echo "<div class='glider-next glider__next__$id'><</div>";
            echo "<div class='glider-prev glider__prev__$id'>></div>";
            echo "<div class='glider__dots glider__dots__$id'></div>";
            echo "</div>"; // div.glider__wrapper
            ?>
            <script>
                waitForElm('<?php echo ".glider__track__$id" ?>').then(element => {
                    new Glider(element, {
                        draggable: true,
                        slidesToShow: <?php echo $settings['carousel-slides-to-show'] ?>,
                        slidesToScroll: <?php echo $settings['carousel-slides-to-scroll'] ?>,
                        arrows: {
                            next: '.glider__next__<?php echo $id ?>',
                            prev: '.glider__prev__<?php echo $id ?>',
                        },
                        dots: '.glider__dots__<?php echo $id ?>',
                        duration: <?php echo ((int)$settings["carousel-duration"]) / 1000 ?>,
                        rewind: <?php echo $settings['carousel-rewind'] ? 'true' : 'false' ?>,
                    })
                })
            </script>
            <?php
        }
    }
}