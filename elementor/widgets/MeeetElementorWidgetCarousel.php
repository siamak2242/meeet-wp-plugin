<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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
        $this->add_control('show-expert', [
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
                $show_expert = $settings['show-expert'];
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
                    <?php if ($show_expert): ?>
                        <div class="post__excerpt">
                            <?php echo get_the_excerpt($post) ?>
                        </div>
                    <?php endif ?>
                    <?php if ($show_meta): ?>
                        <div class="post__meta">
                            <div class="post__author">
                                <span class="label">نویسنده</span>
                                <a href="<?php echo get_author_posts_url($post->post_author) ?>" class="value">
                                    <?php $author = new WP_User($post->post_author) ?>
                                    <?php echo $author->data->user_nicename ?>
                                </a>
                            </div>
                            <div class="post__comments">
                                <span class="label">کامنت</span>
                                <span class="value"><?php echo $post->comment_count ?></span>
                            </div>
                            <div class="post__date">
                                <span class="label">تاریخ</span>
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
            echo "</div>"; // div.glider__wrapper
            ?>
            <script>
                waitForElm('<?php echo ".glider__track__$id" ?>').then(element => {
                    new Glider(element, {
                        draggable: true,
                        slidesToShow: 1,
                        arrows: {
                            next: '.glider__next__<?php echo $id ?>',
                            prev: '.glider__prev__<?php echo $id ?>',
                        }
                    })
                })
            </script>
            <?php
        }
    }
}