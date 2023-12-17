<?php namespace Pager;

class Page extends \Pager {

    public function chunk(int $chunk = 1, int $part = -1, $keys = false) {
        return parent::chunk($chunk, $part, $keys);
    }

    public function current($take = false) {
        if (1 !== $this->chunk) {
            return parent::current($take);
        }
        $lot = $this->lot;
        $part = $this->part;
        if (!isset($lot[$part])) {
            return null;
        }
        if ($take) {
            unset($this->lot[$part]);
        }
        return is_array($lot[$part]) ? $this->page(null, array_replace_recursive([
            'current' => true,
            'part' => $part
        ], $lot[$part])) : $this->page($lot[$part], [
            'current' => true,
            'part' => $part
        ]);
    }

    public function first($take = false) {
        if (1 !== $this->chunk) {
            return parent::first($take);
        }
        $lot = $this->lot;
        $part = ($first = 1) - 1;
        if (!isset($lot[$part])) {
            return null;
        }
        if ($take) {
            unset($this->lot[$part]);
        }
        return is_array($lot[$part]) ? $this->page(null, array_replace_recursive([
            'current' => $first === $part + 1,
            'part' => $first
        ], $lot[$part])) : $this->page($lot[$part], [
            'current' => $first === $part + 1,
            'part' => $first
        ]);
    }

    public function last($take = false) {
        if (1 !== $this->chunk) {
            return parent::last($take);
        }
        $lot = $this->lot;
        $part = ($last = count($lot)) - 1;
        if (!isset($lot[$part])) {
            return null;
        }
        if ($take) {
            unset($this->lot[$part]);
        }
        return is_array($lot[$part]) ? $this->page(null, array_replace_recursive([
            'current' => $last === $part + 1,
            'part' => $last
        ], $lot[$part])) : $this->page($lot[$part], [
            'current' => $last === $part + 1,
            'part' => $last
        ]);
    }

    public function next($take = false) {
        if (1 !== $this->chunk) {
            return parent::next($take);
        }
        $lot = $this->lot;
        $part = $this->part;
        if (!isset($lot[$part + 1])) {
            return null;
        }
        if ($take) {
            unset($this->lot[$part + 1]);
        }
        return is_array($lot[$part + 1]) ? $this->page(null, array_replace_recursive([
            'current' => false,
            'part' => $part + 1
        ], $lot[$part + 1])) : $this->page($lot[$part + 1], [
            'current' => false,
            'part' => $part + 1
        ]);
    }

    public function prev($take = false) {
        if (1 !== $this->chunk) {
            return parent::prev($take);
        }
        $lot = $this->lot;
        $part = $this->part;
        if (!isset($lot[$part - 1])) {
            return null;
        }
        if ($take) {
            unset($this->lot[$part - 1]);
        }
        return is_array($lot[$part - 1]) ? $this->page(null, array_replace_recursive([
            'current' => false,
            'part' => $part
        ], $lot[$part - 1])) : $this->page($lot[$part - 1], [
            'current' => false,
            'part' => $part
        ]);
    }

    public function previous(...$lot) {
        return $this->prev(...$lot);
    }

    public function to(int $part) {
        if ($part < 1 || !$lot = $this->lot) {
            return null;
        }
        if (!isset($lot[$part - 1])) {
            return null;
        }
        return (is_array($lot[$part - 1]) ? $this->page(null, $lot[$part - 1]) : $this->page($lot[$part - 1]))->URL;
    }

}