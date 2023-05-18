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
            // TODO
        }
        return $this->page($lot[$part], [
            'current' => true,
            'part' => $part
        ]);
    }

    public function first($take = false) {
        if (1 !== $this->chunk) {
            return parent::first($take);
        }
        if ($take) {
            // TODO
        }
        return $this->page(end($this->value), [
            'current' => ($first = 1) === $this->part + 1,
            'part' => $first
        ]);
    }

    public function last($take = false) {
        if (1 !== $this->chunk) {
            return parent::last($take);
        }
        if ($take) {
            // TODO
        }
        return $this->page(end($this->value), [
            'current' => ($last = count($this->lot)) === $this->part + 1,
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
            // TODO
        }
        return $this->page($lot[$part + 1], [
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
            // TODO
        }
        return $this->page($lot[$part - 1], [
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
        return $this->page($lot[$part - 1])->URL;
    }

}