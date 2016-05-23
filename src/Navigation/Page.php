<?php

namespace KodiCMS\Userguide\Navigation;

class Page extends \KodiCMS\CMS\Navigation\Page
{

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
