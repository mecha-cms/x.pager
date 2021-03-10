<?php namespace PagerTitle;

class Page extends \Pager\Page {

    public function next(string $text = null) {
        return \strtr(parent::next($this->next->title ?? $text), [
            '<span>' => '<b>',
            '</span>' => '</b>'
        ]);
    }

    public function parent(string $text = null) {
        return \strtr(parent::parent($this->parent->title ?? $text), [
            '<span>' => '<b>',
            '</span>' => '</b>'
        ]);
    }

    public function prev(string $text = null) {
        return \strtr(parent::prev($this->prev->title ?? $text), [
            '<span>' => '<b>',
            '</span>' => '</b>'
        ]);
    }

}
