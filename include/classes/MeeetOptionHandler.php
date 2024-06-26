<?php

class MeeetOptionHandler
{
    private string $token = "_meeet_options";
    private array $value = [
        'public' => [
            '_meeet_wpcontent_margin' => true,
        ],
        'elementor-settings' => [
            '_meeet_elementor_category_name' => 'دسته بندی میییت',
        ],
        'elementor-widgets' => [
            '_meeet_elementor_widget_carousel' => false,
        ],
    ];

    public function __construct()
    {
        $temporary = get_option($this->token);
        if ($temporary) {
            $this->value = $temporary;
        } else {
            add_option($this->token, $this->value, '', 'no');
        }
    }

    public function get_option($token)
    {
        $token = explode('/', $token);
        $temporary = $this->value;
        foreach ($token as $item) {
            if (isset($temporary[$item]))
                $temporary = $temporary[$item];
            else return null;
        }
        return $temporary;
    }

    /**
     * @throws Exception
     */
    public function set_option($token, $value)
    {
        $token = explode('/', $token);
        $temporary =& $this->value;
        foreach ($token as $item) {
            if (isset($temporary[$item]))
                $temporary =& $temporary[$item];
            else throw new Exception('wrong token');
        }
        $temporary = $value;
        update_option($this->token, $this->value);
    }

    public function get_value(): array
    {
        return $this->value;
    }
}