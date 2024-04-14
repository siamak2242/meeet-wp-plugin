<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

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
            'label' => 'تنظیمات کوئری'
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
            foreach ($posts as $post) { ?>
                <div class="glider__slide">
                    <div class="post__category">
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
                    <div class="post__image">
                        <a href="<?php echo get_permalink($post) ?>">
                            <?php echo get_the_post_thumbnail($post) ?>
                        </a>
                    </div>
                    <div class="post__title">
                        <a href="<?php echo get_permalink($post) ?>">
                            <?php echo $post->post_title ?>
                        </a>
                    </div>
                    <div class="post__excerpt">
                        <?php echo get_the_excerpt($post) ?>
                    </div>
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