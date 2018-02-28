<?php
/**
 * Created by PhpStorm.
 * User: rasmusmadsen
 * Date: 28/02/2018
 * Time: 20.58
 */

class Game {

    var $id;
    var $title;
    var $developer;
    var $publisher;
    var $releasedate;
    var $twitter;
    var $youtube;

    /**
     * Game constructor.
     * @param $id
     * @param $title
     * @param $developer
     * @param $publisher
     * @param $releasedate
     * @param $twitter
     * @param $youtube
     */
    public function __construct($id, $title, $developer, $publisher, $releasedate, $twitter, $youtube)
    {
        $this->id = $id;
        $this->title = $title;
        $this->developer = $developer;
        $this->publisher = $publisher;
        $this->releasedate = $releasedate;
        $this->twitter = $twitter;
        $this->youtube = $youtube;
    }


}